<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\ApiController;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductImageGallery;
use App\Models\ProductPriceQuantity;
use App\Models\ProductVariation;
use App\Models\Brand;
use App\Traits\ApiResponser;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductController extends ApiController
{


    public function index()
    {
        //
        $products = Product::where('status', 1)->get();
        return $this->showAll($products);
    }


    public function create()
    {
        $category = Category::with('subcategory')->get();
        $sources = Brand::all();
        $response = [
            'categories' => $category,
            'sources' => $sources,
        ];

        return response()->json($response);
    }

    public function store(Request $request)
    {
        //
        $request->validate([
            'productName' => 'required|unique:products,productName',
            'productDescription' => 'required',
            'productPrice' => 'required|integer',
            'productQuantity' => 'required|integer',
            //'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'image_gallery.*' => 'image|mimes:jpg,jpeg,png,gif,svg|max:2048'
        ]);
        $pro = DB::transaction(function () use($request) {


                $product = Product::create([
                    'productName' => $request->productName,
                    'productSlug' => Str::slug($request->productName, '-'),
                    'productDescription' => $request->productDescription,
                    'category_id' => $request->category_id,
                    'subcategory_id' => $request->subcategory_id,
                    'brand_id' => $request->brand_id,
                ]);

                $productVariation = ProductVariation::create([
                    'variation_option_id' => 1,
                    'product_id' => $product->id,
                    'productSku' => $this->generateUniqueCode(),
                ]);

                $productPrice = ProductPriceQuantity::create([
                    'product_sku' => $productVariation->productSku,
                    'productOfferPrice' => $request->productOfferPrice,
                    'productPrice' => $request->productPrice,
                    'productQuantity' => $request->productQuantity,
                ]);
                $i = 1;
                if($request->hasfile('image')){
                    $image = $request->file('image');
                    $imageName = 'pro_'.date('YmdHi').$i.$image->getClientOriginalName();
                    $image->move(public_path('images/products'), $imageName);
                    $productImage = new ProductImage();
                    $productImage->product_id = $product->id;
                    $productImage->productImage = $imageName;
                    $productImage->save();
                }

                if($images = $request->file('image_gallery')){

                    foreach($images as $image){
                        $i = $i+1;
                        $imageName = 'pro_'.date('YmdHi').$i.$image->getClientOriginalName();
                        $image->move(public_path('images/products'), $imageName);

                        $galleryImage =  ProductImageGallery::create([
                            'product_image_id' => $productImage->id,
                            'product_id' => $product->id,
                            'productImageGallery' => $imageName,
                        ]);
                        // $galleryImage->product_image_id = $productImage->id;
                        // $galleryImage->product_id = $product->id;
                        // $galleryImage->productImageGallery = $imageName;
                        // $galleryImage->save();
                    }

                }



            });


        return $this->showAll(Product::all());
    }


    public function show($id)
    {
        //

        $product = Product::where('id', $id)->first();
        return $this->showOne($product);
    }


    public function edit($id)
    {
        //

    }


    public function update(Request $request, Product $product)
    {
        //
        $request->validate([
            'productName' => 'required|unique:products,productName,'.$product->id,
        ]);

        $product::create([
            'productName' => $request->prductName,
            'productSlug' => Str::slug($request->prductName, '-'),
            'productDescription' => $request->productDescription,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subctegory_id,
        ]);

        return $this->showOne($product);
    }


    public function destroy($id)
    {
        //
    }

    public function generateUniqueCode()
    {
        do {
            $productSku = "pro_".random_int(100000, 999999);
        } while (ProductVariation::where("productSku", $productSku)->first());

        return $productSku;
    }
}

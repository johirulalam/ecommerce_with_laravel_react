<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductPriceQuantity;
use App\Models\ProductVariation;
use App\Traits\ApiResponser;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    use ApiResponser;


    public function index()
    {
        //
        $products = Product::where('status', 1)->get();
        return $this->showAll($products);
    }


    public function create()
    {
        //

    }

    public function store(Request $request)
    {
        //
        $request->validate([
            'productName' => 'required|unique:products,productName',
            'productDescription' => 'required',
            'productPrice' => 'required|integer',
            'productQuantity' => 'required|integer',
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

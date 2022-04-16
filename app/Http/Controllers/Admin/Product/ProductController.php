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

                $productVariationData = [];
                $productPriceData = [];

                for($i = 0; $i < count($request->variation_id); $i++) {
                    $productVariationData[] = [
                        'product_id' => $product->id,
                        'variation_id' => $request->variation_id[$i],
                        'variation_option_id' => $request->variation_option_id[$i],
                        'productSku' => $this->generateUniqueCode(),
                    ];

                    $productPriceData[] = [
                        'product_sku' => $productVariationData[$i],
                        'productOfferPrice' => $request->productOfferPrice[$i],
                        'productPrice' => $request->productPrice[$i],
                        'productQuantity' => $request->productQuantity[$i],
                    ];
                }

                $productVariation = ProductVariation::create([$productVariationData]);
                $productPrice = ProductPriceQuantity::create([$productPriceData]);

            });


        return $this->showOne($pro);
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

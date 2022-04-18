<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;

class HomeController extends ApiController
{
    //

    public function homepage()
    {
        $categories = Category::with(['subcategory'])->get();
        $products = Product::with('product_variations.product_price')->get();
        $products = $this->all_products($products);

        $response = [
                'categories' => $categories,
                'products' => $products,
            ];

        return response()->json($response);

    }

    public function products()
    {
        $products = Product::with('product_variations.product_price')->get();
        return $this->showAll($this->all_products($products));
    }

    public function singleProduct($slug)
    {
        $product = Product::where('productSlug', $slug)->with('product_variations.product_price')->first();

        if(!empty($product['product_variations'][0]['product_price']['productOfferPrice'])){
            $product->productSku = $product['product_variations'][0]['product_price']['product_sku'];
        }
        if(!empty($product['product_variations'][0]['product_price']['productOfferPrice'])){
            $product->productOfferPrice = $product['product_variations'][0]['product_price']['productOfferPrice'];
        }
        if(!empty($product['product_variations'][0]['product_price']['productPrice'])){
            $product->productPrice = $product['product_variations'][0]['product_price']['productPrice'];
        }
        if(!empty($product['product_variations'][0]['product_price']['productQuantity'])){
            $product->productQuantity = $product['product_variations'][0]['product_price']['productQuantity'];
        }
        unset($product['product_variations']);
        return response()->json($product);
    }


    public function categoryProduct($slug)
    {
        $subcat = Subcategory::where('subCategorySlug', $slug)->first();
        $products = Product::where('subcategory_id', $subcat->id)->with('product_variations.product_price')->get();
        $products = $this->all_products($products);
        return $this->showAll($products);
    }






    
    public function all_products($products)
    {
        //$products = Product::with('product_variations.product_price')->get();
        foreach($products as $product) {

            if(!empty($product['product_variations'][0]['product_price']['productOfferPrice'])){
                $product->productOfferPrice = $product['product_variations'][0]['product_price']['productOfferPrice'];
            }
            if(!empty($product['product_variations'][0]['product_price']['productPrice'])){
                $product->productPrice = $product['product_variations'][0]['product_price']['productPrice'];
            }
            if(!empty($product['product_variations'][0]['product_price']['productQuantity'])){
                $product->productQuantity = $product['product_variations'][0]['product_price']['productQuantity'];
            }

            unset($product['product_variations']);
        }
        return $products;
    }
}


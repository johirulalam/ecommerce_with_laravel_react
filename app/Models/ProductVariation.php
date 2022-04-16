<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function generateUniqueCode()
    {
        do {
            $productSku = "pro_".random_int(100000, 999999);
        } while (ProductVariation::where("productSku", $productSku)->first());

        return $productSku;
    }
}

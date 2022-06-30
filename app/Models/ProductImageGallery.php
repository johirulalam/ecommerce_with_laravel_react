<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImageGallery extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'product_id', 'product_image_id', 'productImageGallery'];
}

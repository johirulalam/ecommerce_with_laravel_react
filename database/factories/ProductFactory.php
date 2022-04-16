<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
             'category_id' => \App\Models\Category::all()->random()->id,
             'subcategory_id' => \App\Models\Subcategory::all()->random()->id,
             'brand_id' => \App\Models\Brand::all()->random()->id,
             'productName' => $slug = $this->faker->unique()->word,
             'productSlug' => Str::slug($slug, '-'),
             'productDescription' => $this->faker->paragraph,

        ];
    }
}

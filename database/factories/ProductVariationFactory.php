<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductVariationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'product_id' =>  \App\Models\Product::all()->random()->id,
            'variation_option_id' => \App\Models\VariationOption::all()->random()->id,
            'productSku' => \App\Models\ProductVariation::generateUniqueCode(),
        ];
    }
}

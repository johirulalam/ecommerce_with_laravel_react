<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductPriceQuantity>
 */
class ProductPriceQuantityFactory extends Factory
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
            'product_sku' => \App\Models\ProductVariation::distinct()->select('productSku')->get()->random()->productSku,
            'productOfferPrice' => $this->faker->randomElement([150,1500, 542, 685, 638 ]),
            'productPrice' => $this->faker->numberBetween(2000, 5000),
            'productQuantity' => $this->faker->numberBetween(10, 100),

        ];
    }
}

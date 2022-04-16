<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {


        $productSku = \App\Models\ProductVariation::all()->random();
        $pro_id = $productSku->product_id;
        $sku = $productSku->productSku;

        return [
            //
            'product_id' => $pro_id,
            'order_id' => \App\Models\Order::all()->random()->id,
            'order_status_id' => \App\Models\OrderStatus::all()->random()->id,
            'productSku' => $sku,
            'orderItemPrice' => $this->faker->numberBetween(500, 2000),
            'orderItemQuantity' => $this->faker->numberBetween(1,5),
        ];
    }
}

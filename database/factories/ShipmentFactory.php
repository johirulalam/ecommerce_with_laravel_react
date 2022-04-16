<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shipment>
 */
class ShipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'order_id' => \App\Models\Order::all()->random()->id,
            'invoice_id' => \App\Models\Invoice::all()->random()->id,
            'shipmentTrackingNumber' => $this->faker->unique()->word,

        ];
    }
}

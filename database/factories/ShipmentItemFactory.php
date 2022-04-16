<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShipmentItem>
 */
class ShipmentItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $shipment  = \App\Models\Shipment::all()->random();
        return [
            'shipment_id' => $shipment->id,
            'order_item_id' => \App\Models\OrderItem::where('order_id', $shipment->order_id)->get()->random()->id,
        ];
    }
}

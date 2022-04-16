<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
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
            'order_id' => \App\Models\Order::all()->unique()->random()->id,
            'invoice_status_id' => \App\Models\InvoiceStatus::all()->random()->id,
            'invoiceDetails' => $this->faker->sentence,
        ];
    }
}

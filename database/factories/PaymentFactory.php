<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
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
            'invoice_id' => $invoice = \App\Models\Invoice::all()->random()->id,
            'payment_method_id' => \App\Models\PaymentMethod::all()->random()->id,
            'payment_amount' => $this->faker->numberBetween(100, 1000),
            'transaction_id' => $this->faker->unique()->name,
        ];
    }
}

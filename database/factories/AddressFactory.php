<?php

namespace Database\Factories;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
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
            'user_id' => User::all()->random()->id,
            'shippingAddress' => $this->faker->randomElement(['ashuganj,brammanbaria', 'panthapath,Dhaka', 'subarnachar,Noakhali', 'rampura,dhaka']),
            'phone' => $this->faker->unique()->numerify('###########'),
        ];
    }
}

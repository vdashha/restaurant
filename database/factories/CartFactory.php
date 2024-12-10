<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $clientsWithoutCart = Client::doesntHave('cart')->pluck('id')->toArray(); //клиенты без корзин

        return [
            'client_id' => fake()->randomElement($clientsWithoutCart),
        ];
    }
}

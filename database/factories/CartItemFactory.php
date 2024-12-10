<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\Dish;
use Illuminate\Database\Eloquent\Factories\Factory;
use function RectorPrefix202411\React\Promise\all;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CartItem>
 */
class CartItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cartId = Cart::find(all())->id->toArray();
        $dishId = Dish::pluck('id')->toArray();
        return [
            'cart_id' => $cartId,
            'dish_id' => $dishId,
            'quantity' => fake()->numberBetween(1, 7),
        ];
    }
}

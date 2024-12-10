<?php

namespace Database\Factories;

use App\Enums\OrderStatusEnum;
use App\Models\Cart;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Auth;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $clientId = Cart::pluck('client_id')->toArray();
        $selectedClientId = fake()->randomElement($clientId);

        $cart = Cart::with('items.dish')->where('client_id', $selectedClientId)->first();
        $totalPrice = array_sum($cart->items->map(fn($item) => $item->dish->price * $item->quantity)->toArray()); // Суммируем цены всех блюд в корзине

        return [
            'client_id' => $selectedClientId,
            'total_price' => $totalPrice,
            'status' => fake()->randomElement(OrderStatusEnum::cases()),
        ];
    }
}

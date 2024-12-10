<?php

namespace App\Services;

use App\Enums\OrderStatusEnum;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    public function addOrder(): Order
    {
        $cart = Cart::with('items.dish')->where('client_id', Auth::guard('client')->id())->first();

        if (empty($cart['items'])) {
            throw new \Exception('Ваша корзина пуста');
        }

        // Используем коллекцию напрямую, не приводя ее к массиву
        $order = Order::create([
            'client_id' => Auth::guard('client')->id(),
            'total_price' => array_sum($cart->items->map(fn($item) => $item->dish->price * $item->quantity)->toArray()),
            'status' => OrderStatusEnum::NEW
        ]);

        foreach ($cart->items as $item) {
            $order->items()->create([
                'dish_id' => $item->dish_id,
                'quantity' => $item->quantity,
                'price' => $item->dish->price,
            ]);
        }

        // Очистка корзины
        CartItem::where('cart_id', $cart->id)->delete();

        return $order;
    }

}

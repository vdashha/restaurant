<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatusEnum;
use App\Models\Order;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store()
    {
        $cart = Cart::with('items.dish')->where('client_id', Auth::guard('client')->id())->first(); // Предполагается, что корзина хранится в сессии

        if (empty($cart['items'])) {
            return redirect()->route('cart.show')->with('error', 'Ваша корзина пуста');
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

        return redirect()->route('orders.show', $order)->with('success', 'Ваш заказ успешно оформлен!');
    }

    public function show(Order $order)
    {
        return view('order', compact('order'));
    }
}


<?php

namespace App\Services\User;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartService
{
    public function index(): Cart
    {
        $cart = Cart::with('items.dish')->where('client_id', Auth::guard('client')->id())->first();

        if (!$cart) {
            // Если корзина не найдена, создайте её или передайте пустую корзину
            $cart = new Cart(['items' => collect()]);
        }
        return $cart;
    }

    public function addCart(int $dish_id)
    {
        $cart = Cart::firstOrCreate(['client_id' => Auth::guard('client')->id()]);
        $cart->items()->updateOrCreate(
            ['dish_id' => $dish_id],
            ['quantity' => Cart::raw('quantity + 1')]
        );
    }

    public function updateCart(Request $request)
    {
        $cartItem = CartItem::find($request->item_id);
        $cartItem->update(['quantity' => $request->quantity]);
    }

    public function removeCart(Request $request)
    {
        $cartItem = CartItem::find($request->item_id);
        $cartItem->delete();
    }

}

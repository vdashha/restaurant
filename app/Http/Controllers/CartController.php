<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::with('items.dish')->where('client_id', auth()->id())->first();

        if (!$cart) {
            // Если корзина не найдена, создайте её или передайте пустую корзину
            $cart = new Cart(['items' => collect()]);
        }

        return view('cart', compact('cart'));
    }

    public function add(int $dish_id)
    {
        $cart = Cart::firstOrCreate(['client_id' => auth()->id()]);
        $cart->items()->updateOrCreate(
            ['dish_id' => $dish_id],
            ['quantity' => Cart::raw('quantity + 1')]
        );
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $cartItem = CartItem::find($request->item_id);
        $cartItem->update(['quantity' => $request->quantity]);
        return redirect()->back();
    }

    public function remove(Request $request)
    {
        $cartItem = CartItem::find($request->item_id);
        $cartItem->delete();
        return redirect()->back();
    }
}


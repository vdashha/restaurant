<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use App\Services\User\CartService;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct(private readonly CartService $cartService)
    {

    }

    public function index()
    {
        $cart = $this->cartService->index();
        return view('cart', compact('cart'));
    }

    public function add(int $dish_id)
    {
        $this->cartService->addCart($dish_id);
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $this->cartService->updateCart($request);
        return redirect()->back();
    }

    public function remove(Request $request)
    {
        $this->cartService->removeCart($request);
        return redirect()->back();
    }
}


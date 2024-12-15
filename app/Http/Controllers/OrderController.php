<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatusEnum;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\OrderItem;
use App\Services\OrderService;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('client_id', Auth::guard('client')->id())->get();
        return view('orders.ordersList', compact('orders'));
    }

    public function store(OrderRequest $orderRequest ,OrderService $orderService)
    {
        try {
            $order = $orderService->addOrder($orderRequest);
        } catch (\Exception $exception) {
            return redirect()->route('orders.orderForm')->with('error', $exception->getMessage());
        }

        return redirect()->route('orders.show', $order)->with('success', 'Ваш заказ успешно оформлен!');
    }

    public function show(Order $order)
    {
        return view('orders.order', compact('order'));
    }

    public function remove(Order $order)
    {
        $order->update(['status' => OrderStatusEnum::FAILED]);
        return redirect()->back();
    }

    public function placingOrder()
    {
        $cart = Cart::with('items.dish')->where('client_id', Auth::guard('client')->id())->first();
        $totalAmount = array_sum($cart->items->map(fn($item) => $item->dish->price * $item->quantity)->toArray());

        $restaurants = ['ул. Сурганова 37/2'];
        return view('orders.orderForm', compact('restaurants', 'totalAmount'));
    }

}

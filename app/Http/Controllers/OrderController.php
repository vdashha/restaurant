<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatusEnum;
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
        return view('ordersList', compact('orders'));
    }

    public function store(OrderService $orderService)
    {
        try {
            $order = $orderService->addOrder();
        } catch (\Exception $exception) {
            return redirect()->route('cart.show')->with('error', $exception->getMessage());
        }

        return redirect()->route('orders.show', $order)->with('success', 'Ваш заказ успешно оформлен!');
    }

    public function show(Order $order)
    {
        return view('order', compact('order'));
    }

    public function remove(Order $order)
    {
        $order->update(['status' => OrderStatusEnum::FAILED]);
        return redirect()->back();
    }
}

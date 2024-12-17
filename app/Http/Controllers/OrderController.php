<?php

namespace App\Http\Controllers;

use App\Contracts\RepositoryInterface;
use App\Enums\OrderStatusEnum;
use App\Http\Requests\OrderRequest;
use App\Models\CartItem;
use App\Repositories\CartRepository;
use App\Repositories\OrderRepository;
use App\Repositories\RestaurantRepository;
use App\Services\OrderService;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{


    public function __construct(private OrderRepository $orderRepository, private CartRepository $cartRepository, private RestaurantRepository $restaurantRepository)
    {
    }

    public function index()
    {
        $orders = $this->orderRepository->getByClientId(Auth::guard('client')->id());

        return view('orders.ordersList', compact('orders'));
    }

    public function store(OrderRequest $orderRequest, OrderService $orderService)
    {
        try {
            $order = $orderService->addOrder($orderRequest);
        } catch (\Exception $exception) {
            return redirect()->route('orders.orderForm')->with('error', $exception->getMessage());
        }

        return redirect()->route('orders.show', $order)->with('success', 'Ваш заказ успешно оформлен!');
    }

    public function show(int $id)
    {
        $order = $this->orderRepository->find($id);

        return view('orders.order', compact('order'));
    }

    public function remove(int $id)
    {
        $this->orderRepository->update($id, ['status' => OrderStatusEnum::FAILED]);

        return redirect()->back();
    }

    public function placingOrder()
    {
        $cart = $this->cartRepository->setWith(['items.dish'])->findByClientId(Auth::guard('client')->id());
        $totalAmount = array_sum($cart->items->map(fn(CartItem $item) => $item->dish->price * $item->quantity)->toArray());

        $restaurants = $this->restaurantRepository->all();
        return view('orders.orderForm', compact('restaurants', 'totalAmount'));
    }

}

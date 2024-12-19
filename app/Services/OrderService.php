<?php

namespace App\Services;

use App\Contracts\RepositoryInterface;
use App\Enums\OrderStatusEnum;
use App\Events\OrderCreated;
use App\Http\Requests\OrderRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Repositories\CartRepository;
use App\Repositories\OrderRepository;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    private RepositoryInterface $cartRepository;
    private RepositoryInterface $orderRepository;

    public function __construct()
    {
        $this->cartRepository = app(CartRepository::class);
        $this->orderRepository = app(OrderRepository::class);
    }

    public function addOrder(OrderRequest $orderRequest): Order
    {
        $cart = $this->cartRepository->setWith(['items.dish'])->findByClientId(Auth::guard('client')->id());

        if ($cart->items->isEmpty()) {
            throw new \Exception('Ваша корзина пуста');
        }

        $data = [
            'client_id' => Auth::guard('client')->id(),
            'total_price' => array_sum($cart->items->map(fn($item) => $item->dish->price * $item->quantity)->toArray()),
            'status' => OrderStatusEnum::NEW,
            'name' => $orderRequest->name,
            'phone_number' => $orderRequest->phone,
            'time' => $orderRequest->ready_time,
            'adress' => $orderRequest->restaurant,
            'comment' => $orderRequest->comment,
            'payment' => $orderRequest->payment_method,
        ];

        $order = $this->orderRepository->create($data);

        $orderItemsData = [];

        /** @var CartItem $item */
        foreach ($cart->items as $item) {
            $orderItemsData[] = [
                'dish_id' => $item->dish_id,
                'quantity' => $item->quantity,
                'price' => $item->dish->price,
            ];
        }

        $this->orderRepository->createItems($order, $orderItemsData);
        $this->cartRepository->delete($cart->id);

        event(new OrderCreated($order));

        return $order;
    }

}

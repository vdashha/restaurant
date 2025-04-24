<?php

namespace App\Listeners;

use App\Enums\DeliveryStatusEnum;
use App\Enums\OrderStatusEnum;
use App\Events\ChangeDeliveryStatus;
use App\Repositories\OrderRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ChangeDeliveryStatusListener
{
    private OrderRepository $orderRepository;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        $this->orderRepository= app(OrderRepository::class);
    }

    /**
     * Handle the event.
     */
    public function handle(ChangeDeliveryStatus $event): void
    {
        if($event->delivery->status === DeliveryStatusEnum::COMPLETED)
        {
            $order = $event->delivery->order;
            $this->orderRepository->update($order->id, ['status' => OrderStatusEnum::COMPLETED]);
        }
    }
}

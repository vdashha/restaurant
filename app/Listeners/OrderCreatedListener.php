<?php

namespace App\Listeners;

use App\Contracts\RepositoryInterface;
use App\Enums\DeliveryTypeEnum;
use App\Models\Delivery;
use App\Repositories\DeliveryRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OrderCreatedListener
{
    private RepositoryInterface $deliveryRepository;

    public function __construct()
    {
        $this->deliveryRepository = app(DeliveryRepository::class);
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        if ($event->order->delivery_type == DeliveryTypeEnum::DELIVERY) {
            $data = [
                'order_id' => $event->order->id,
                'address' => $event->deliveryAddress,
                'time' => $event->order->time
            ];
            $this->deliveryRepository->create($data);
        }

    }
}

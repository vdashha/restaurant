<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderCreated
{
    use Dispatchable, SerializesModels;

    public function __construct(public Order $order, public ?string $deliveryAddress)
    {}
}

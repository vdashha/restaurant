<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChangeOrderStatus
{
    use Dispatchable, SerializesModels;

    public function __construct(public Order $order)
    {}
}

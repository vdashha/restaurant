<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class OrderRepository extends BaseRepository
{
    public function __construct()
    {
        static::setModel(Order::class);
    }

    public function getByClientId(int $clientId)
    {
        return $this->model::where('client_id', $clientId)->get();
    }

    public function createItems(Order $order, array $itemsData): Collection
    {
        return $order->items()->createMany($itemsData);
    }
}

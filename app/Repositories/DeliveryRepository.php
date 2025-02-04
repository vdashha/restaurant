<?php

namespace App\Repositories;

use App\Models\Delivery;

class DeliveryRepository extends BaseRepository
{
    public function __construct()
    {
        static::setModel(Delivery::class);
    }
}

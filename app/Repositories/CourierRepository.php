<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Client;
use App\Models\Courier;

class CourierRepository extends BaseRepository
{
    public function __construct()
    {
        static::setModel(Courier::class);
    }

    public function findByPhoneNumber(string $phone)
    {
        return $this->baseQuery()->wherePhone($phone)->firstOrFail();
    }
}

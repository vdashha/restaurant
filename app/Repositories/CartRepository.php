<?php

namespace App\Repositories;

use App\Models\Cart;

class CartRepository extends BaseRepository
{
    public function __construct()
    {
        static::setModel(Cart::class);
    }

    public function findByClientId(int $clientId)
    {
        return $this->baseQuery()->firstWhere('client_id', $clientId);
    }
}

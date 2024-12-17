<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\CartItem;

class CartItemRepository extends BaseRepository
{
    public function __construct()
    {
        static::setModel(CartItem::class);
    }

}

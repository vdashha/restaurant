<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Client;

class ClientRepository extends BaseRepository
{
    public function __construct()
    {
        static::setModel(Client::class);
    }
}

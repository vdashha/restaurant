<?php

namespace App\Repositories;

use App\Models\Promotion;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class RestaurantRepository extends BaseRepository
{
    public function __construct()
    {
        static::setModel(Restaurant::class);
    }

}

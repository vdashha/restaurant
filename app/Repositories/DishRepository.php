<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Dish;

class DishRepository extends BaseRepository
{
    public function __construct()
    {
        static::setModel(Dish::class);
    }

    public function getByCategoryId(int $id)
    {
        return $this->baseQuery()->where('category_id', $id)->get();
    }
}

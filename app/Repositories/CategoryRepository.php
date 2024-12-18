<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\Category;

class CategoryRepository extends BaseRepository
{
    public function __construct()
    {
        static::setModel(Category::class);
    }

    public function findParentCategory()
    {
        return $this->baseQuery()->whereNull('parent_id')->get();
    }
}

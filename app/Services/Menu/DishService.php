<?php

namespace App\Services\Menu;

use App\Models\Category;
use App\Models\Client;
use App\Models\Dish;
use Illuminate\Support\Facades\Auth;

class DishService
{
    public function showDishes(int $category_id): array
    {
        $dishes = Dish::where('category_id', $category_id)->get();
        $title = Category::find($category_id)->title;

        return [$dishes, $title];
    }

}

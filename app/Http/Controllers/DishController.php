<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Dish;
use App\Services\Menu\DishService;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class DishController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function showDishes(int $category_id, DishService $dishService)
    {
        [$dishes, $title] = $dishService->showDishes($category_id);
        return view('menu.dishes', compact('dishes', 'title'));
    }
}

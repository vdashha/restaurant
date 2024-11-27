<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Dish;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class DishController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public function showDishes(int $category_id)
    {
        $dishes = Dish::all();
        $title = Category::find($category_id)->title;
        return view('menu.1', compact('dishes', 'title'));
    }
}

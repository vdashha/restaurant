<?php

namespace App\Http\Controllers;

use App\Models\Сategory;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class CategoryController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public static function readCategories()
    {
        $categories = Сategory::all();
        return view('menu.categories', compact('categories'));
    }
}

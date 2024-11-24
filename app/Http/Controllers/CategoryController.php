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


    public function showCategories()
    {
        $categories = Сategory::whereNull('parent_id')->get();
        $title = 'Категории меню';
        return view('menu.categories', compact('categories', 'title'));
    }

    public function showSubCategories(int $categoryId)
    {
        $category = Сategory::with('subcategories')->findOrFail($categoryId);
        $categories = $category->subCategories; // Category::where('parent_id', $categoryId)->get();
        $title = $category->title;
        return view('menu.categories', compact('categories', 'title'));
    }
}

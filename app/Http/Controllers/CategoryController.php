<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\Menu\CategoryService;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class CategoryController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct(private readonly CategoryService $categoryService)
    {

    }

    public function showCategories(?int $categoryId = null)
    {
        [$categories, $title] = $this->categoryService->showCategories($categoryId);

        if ($categories->isEmpty()) {
            // Если нет подкатегорий, перенаправляем на список блюд
            return redirect()->route('dishes', $categoryId);
        }

        return view('menu.categories', compact('categories', 'title'));
    }

}

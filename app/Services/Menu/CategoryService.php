<?php

namespace App\Services\Menu;

use App\Models\Category;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;

class CategoryService
{
    public function showCategories(?int $categoryId = null): array
    {
        if (is_null($categoryId)) {
            // Корневые категории
            $categories = Category::whereNull('parent_id')->get();
            $title = 'Категории меню';
        } else {
            // Подкатегории
            $category = Category::with('subCategories')->findOrFail($categoryId);
            $categories = $category->subCategories;
            $title = $category->title;
        }

        return [$categories, $title];
    }

}

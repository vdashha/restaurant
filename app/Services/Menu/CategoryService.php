<?php

namespace App\Services\Menu;

use App\Models\Category;
use App\Models\Client;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Auth;

class CategoryService
{
    public function __construct(private CategoryRepository $categoryRepository)
    {

    }

    public function showCategories(?int $categoryId = null): array
    {
        if (is_null($categoryId)) {
            // Корневые категории
            $categories = $this->categoryRepository->findParentCategory();
            $title = 'Категории меню';
        } else {
            // Подкатегории
            $category = $this->categoryRepository->setWith(['subCategories'])->find($categoryId);
            $categories = $category->subCategories;
            $title = $category->title;
        }

        return [$categories, $title];
    }

}

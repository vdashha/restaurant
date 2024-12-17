<?php

namespace App\Services\Menu;

use App\Repositories\CategoryRepository;
use App\Repositories\DishRepository;
use Illuminate\Support\Facades\Auth;

class DishService
{
    public function __construct(private DishRepository $dishRepository, private CategoryRepository $categoryRepository)
    {

    }

    public function showDishes(int $category_id): array
    {
        $dishes = $this->dishRepository->getByCategoryId($category_id);
        $title = $this->categoryRepository->find($category_id)->title;

        return [$dishes, $title];
    }

}

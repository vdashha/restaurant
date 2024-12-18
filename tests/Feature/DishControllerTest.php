<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Dish;
use App\Services\Menu\DishService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class DishControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_displays_dishes_for_category(): void
    {
        // Создаем категорию и блюда
        $category = Category::factory()->create();
        $dishes = Dish::factory()->count(3)->create(['category_id' => $category->id]);

        // Проверяем данные
        $this->assertDatabaseHas('categories', ['id' => $category->id]);
        $this->assertDatabaseHas('dishes', ['category_id' => $category->id]);

        // Мокируем DishService
        $mockService = Mockery::mock(DishService::class);
        $mockService->shouldReceive('showDishes')
            ->with($category->id)
            ->once()
            ->andReturn([$dishes, $category->title]);

        $this->app->instance(DishService::class, $mockService);

        // Отправляем запрос
        $response = $this->get(route('dishes', ['category' => $category->id]));

        // Проверяем вывод
        $response->assertStatus(200);
        $response->assertViewIs('menu.dishes');
        $response->assertViewHas('dishes', $dishes);
        $response->assertViewHas('title', $category->title);
    }


    public function test_it_handles_empty_dishes_for_category(): void
    {
        // Создаем категорию без блюд
        $category = Category::factory()->create();

        // Мокируем DishService
        $mockService = Mockery::mock(DishService::class);
        $mockService->shouldReceive('showDishes')
            ->with($category->id)
            ->once()
            ->andReturn([collect(), $category->title]);

        $this->app->instance(DishService::class, $mockService);

        // Отправляем запрос
        $response = $this->get(route('dishes', ['category' => $category->id]));

        // Проверяем вывод
        $response->assertStatus(200);
        $response->assertViewIs('menu.dishes');
        $response->assertViewHas('dishes', collect());
        $response->assertViewHas('title', $category->title);
    }

}

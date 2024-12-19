<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Services\Menu\CategoryService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    //use RefreshDatabase;

    public function test_it_displays_root_categories(): void
    {
        // Мокируем CategoryService
        $categories = Category::factory(3)->create();
        $mockService = Mockery::mock(CategoryService::class);
        $mockService->shouldReceive('showCategories')
            ->once()
            ->andReturn([$categories, 'Категории меню']);

        $this->app->instance(CategoryService::class, $mockService);

        // Отправляем запрос
        $response = $this->get(route('categories'));

        // Проверяем вывод
        $response->assertStatus(200);
        $response->assertViewIs('menu.categories');
        $response->assertViewHas('categories', $categories);
        $response->assertViewHas('title', 'Категории меню');
    }

    public function test_it_redirects_to_dishes_if_no_subcategories(): void
    {
        // Мокируем CategoryService
        $mockService = Mockery::mock(CategoryService::class);
        $mockService->shouldReceive('showCategories')
            ->with(1)
            ->once()
            ->andReturn([collect(), '']);

        $this->app->instance(CategoryService::class, $mockService);

        // Отправляем запрос
        $response = $this->get(route('subcategories', ['category' => 1]));

        // Проверяем редирект
        $response->assertRedirect(route('dishes', ['category' => 1]));
    }

    public function test_it_displays_subcategories(): void
    {
        // Мокируем CategoryService
        $categories = Category::factory()->count(2)->create();
        $mockService = Mockery::mock(CategoryService::class);
        $mockService->shouldReceive('showCategories')
            ->with(1)
            ->once()
            ->andReturn([$categories, 'Напитки']);

        $this->app->instance(CategoryService::class, $mockService);

        // Отправляем запрос
        $response = $this->get(route('subcategories', ['category' => 1]));

        // Проверяем вывод
        $response->assertStatus(200);
        $response->assertViewIs('menu.categories');
        $response->assertViewHas('categories', $categories);
        $response->assertViewHas('title', 'Напитки');
    }
}

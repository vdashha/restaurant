<?php

namespace Tests\Unit\Services\Menu;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use App\Repositories\DishRepository;
use App\Services\Menu\DishService;
use Mockery;
use PHPUnit\Framework\TestCase;

class DishServiceTest extends TestCase
{
    protected $dishRepository;
    protected $categoryRepository;
    protected $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->dishRepository = Mockery::mock(DishRepository::class);
        $this->categoryRepository = Mockery::mock(CategoryRepository::class);

        $this->service = new DishService($this->dishRepository, $this->categoryRepository);
    }

    public function test_showDishes_returns_dishes_and_title()
    {
        $dishes = collect(['dish1', 'dish2']);
        $mockCategory = new Category();
        $mockCategory->title = 'Category Title';

        $this->dishRepository->shouldReceive('getByCategoryId')->with(1)->andReturn($dishes);
        $this->categoryRepository->shouldReceive('find')->with(1)->andReturn($mockCategory);

        [$resultDishes, $title] = $this->service->showDishes(1);

        $this->assertEquals($dishes, $resultDishes);
        $this->assertEquals('Category Title', $title);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}

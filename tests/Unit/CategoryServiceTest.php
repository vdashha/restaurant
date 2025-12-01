<?php

namespace Tests\Unit\Services\Menu;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use App\Services\Menu\CategoryService;
use Mockery;
use PHPUnit\Framework\TestCase;

class CategoryServiceTest extends TestCase
{
    protected $categoryRepository;
    protected $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->categoryRepository = Mockery::mock(CategoryRepository::class);
        $this->service = new CategoryService($this->categoryRepository);
    }

    public function test_showCategories_returns_root_categories()
    {
        $categories = collect(['cat1', 'cat2']);
        $this->categoryRepository->shouldReceive('findParentCategory')->once()->andReturn($categories);

        [$cats, $title] = $this->service->showCategories();

        $this->assertEquals('Категории меню', $title);
        $this->assertEquals($categories, $cats);
    }

    public function test_showCategories_returns_subcategories()
    {
        $mockCategory = new Category();
        $mockCategory->subCategories = collect(['sub1', 'sub2']);
        $mockCategory->title = 'Parent Cat';

        $this->categoryRepository->shouldReceive('setWith->find')->with(1)->andReturn($mockCategory);

        [$cats, $title] = $this->service->showCategories(1);

        $this->assertEquals('Parent Cat', $title);
        $this->assertEquals($mockCategory->subCategories, $cats);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}

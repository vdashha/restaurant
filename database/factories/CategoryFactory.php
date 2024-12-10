<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $existingCategoryIds = Category::pluck('id')->toArray(); // Получаем массив идентификаторов существующих категорий

        // Генерация изображения и сохранение в публичной директории
        $imagePath = fake()->image(public_path('images'), 640, 480, null, false); // Создание изображения

        return [
            'title' => fake()->sentence(), // Генерация случайного заголовка
            'parent_id' => fake()->randomElement(array_merge([null], $existingCategoryIds)), // Случайный идентификатор из существующих категорий или null
        ];
    }
}

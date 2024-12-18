<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dish>
 */
class DishFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $existingCategoryIds = Category::pluck('id')->toArray(); // Получаем массив идентификаторов существующих категорий
        return [
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'price' => fake()->randomFloat(2, 0, 999999.99), // 2 знака после запятой, максимум 8 цифр
            'weight' => fake()->numberBetween(1, 1000), // Вес от 1 до 1000
            'category_id' => fake()->randomElement($existingCategoryIds),
        ];
    }
}

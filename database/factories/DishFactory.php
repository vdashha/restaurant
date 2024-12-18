<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Dish;
use Illuminate\Database\Eloquent\Factories\Factory;

class DishFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Dish::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Убедимся, что хотя бы одна категория существует
        if (Category::count() === 0) {
            Category::factory()->create();
        }

        $existingCategoryIds = Category::pluck('id')->toArray();

        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 1, 9999.99),
            'weight' => $this->faker->numberBetween(50, 1000),
            'category_id' => $this->faker->randomElement($existingCategoryIds),
        ];
    }

    /**
     * Configure the factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Dish $dish) {
            // Добавляем изображение в коллекцию media
            $dish->addMediaFromUrl('https://via.placeholder.com/640x480.png') // Замените на тестовый URL
            ->toMediaCollection('default');
        });
    }
}

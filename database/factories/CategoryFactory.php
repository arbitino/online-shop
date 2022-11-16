<?php

namespace Database\Factories;

use Domain\Catalog\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Catalog\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->company(),
            'on_home_page' => $this->faker->boolean(),
            'sort' => $this->faker->numberBetween(1, 1000)
        ];
    }
}

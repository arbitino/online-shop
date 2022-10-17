<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws \Exception
     */
    public function definition()
    {
        return [
            'title' => $this->faker->company(),
            'thumbnail' => '',
            'price' => $this->faker->numberBetween(500, 20000),
            'brand_id' => Brand::query()->inRandomOrder()->value('id')

        ];
    }
}

<?php

namespace Database\Factories;

use Domain\Catalog\Models\Brand;
use Domain\Product\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
	protected $model = Product::class;

	public function definition(): array
	{
		return [
			'title' => $this->faker->company(),
			'thumbnail' => $this->faker->fixturesImage('products', 'products'),
			'price' => $this->faker->numberBetween(50000, 2000000),
			'brand_id' => Brand::query()->inRandomOrder()->value('id'),
			'on_home_page' => $this->faker->boolean(),
			'sort' => $this->faker->numberBetween(1, 1000),
			'text' => $this->faker->realText()

		];
	}
}

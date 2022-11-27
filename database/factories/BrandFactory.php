<?php

namespace Database\Factories;

use Domain\Catalog\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Brand>
 */
class BrandFactory extends Factory
{
	protected $model = Brand::class;

	public function definition(): array
	{
		return [
			'title' => $this->faker->word(),
			'thumbnail' => $this->faker->fixturesImage('brands', 'brands'),
			'on_home_page' => $this->faker->boolean(),
			'sort' => $this->faker->numberBetween(1, 1000)
		];
	}
}

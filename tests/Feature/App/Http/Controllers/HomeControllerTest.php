<?php

namespace App\Http\Controllers;

use Database\Factories\BrandFactory;
use Database\Factories\CategoryFactory;
use Database\Factories\ProductFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function it_success_response(): void
    {
        ProductFactory::new()->count(5)
            ->create([
                'on_home_page' => true,
                'sort' => 999,
            ]);

        $product = ProductFactory::new()
            ->createOne([
                'on_home_page' => true,
                'sort' => 1,
            ]);

        CategoryFactory::new()->count(5)
            ->create([
                'on_home_page' => true,
                'sort' => 999,
            ]);

        $category = CategoryFactory::new()
            ->createOne([
                'on_home_page' => true,
                'sort' => 1,
            ]);

        BrandFactory::new()->count(5)
            ->create([
                'on_home_page' => true,
                'sort' => 999,
            ]);

        $brand = BrandFactory::new()
            ->createOne([
                'on_home_page' => true,
                'sort' => 1,
            ]);

        $this->get(action([HomeController::class, 'index']))
            ->assertOk()
            ->assertViewHas('categories.0', $category)
            ->assertViewHas('brands.0', $brand)
            ->assertViewHas('products.0', $product);
    }

}
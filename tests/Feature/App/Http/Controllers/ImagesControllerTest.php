<?php

namespace App\Http\Controllers;

use Database\Factories\ProductFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ImagesControllerTest extends TestCase
{
	use RefreshDatabase;

	/**
	 * @test
	 * @return void
	 */
	public function it_generate_succes(): void
	{
		$size = '500x500';
		$method = 'resize';
		$storage = Storage::disk('images');

		config()->set('images', ['sizes' => [$size]]);

		$product = ProductFactory::new()->create();

		$response = $this->get($product->makeImage($size, $method));

		$response->assertOk();

		$storage->assertExists(
			'products/' . $method . '/' . $size . '/' . File::basename($product->thumbnail)
		);
	}


}

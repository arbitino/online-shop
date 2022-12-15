<?php

namespace App\Http\Controllers;

use Domain\Product\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;


class ProductController extends Controller
{
	public function __invoke(Product $product): Factory|View|Application
	{
		$product->load(['optionValues.option']);

		$viewedIds = session()->get('viewed');
		unset($viewedIds[$product->id]);

		if (!empty($viewedIds)) {
			$viewedProducts = Product::query()
				->whereIn('id', $viewedIds)
				->get();
		}

		session()->put('viewed.' . $product->id, $product->id);

		return view('product.show', [
			'product' => $product,
			'options' => $product->optionValues->keyValues(),
			'viewedProducts' => $viewedProducts ?? []
		]);
	}
}

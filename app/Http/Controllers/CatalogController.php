<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Domain\Catalog\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

class CatalogController extends Controller
{
	public function index(?Category $category): Factory|View|Application
	{
		$categories = Category::query()
			->select(['id', 'title', 'slug'])
			->has('products')
			->get();

		$products = Product::query()
			->select(['id', 'title', 'slug', 'price', 'thumbnail'])
			->when(request('s'), function (Builder $q) {
				return $q->whereFullText(['text', 'title'], request('s'));
			})
			->when(
				$category->exists,
				function (Builder $q) use ($category) {
					return $q->whereRelation(
						'categories',
						'categories.id',
						'=',
						$category->id
					);
				}
			)->filtered()
			->sorted()
			->paginate(6);

		return view('catalog.index', [
			'products' => $products,
			'categories' => $categories,
			'category' => $category,
		]);
	}
}

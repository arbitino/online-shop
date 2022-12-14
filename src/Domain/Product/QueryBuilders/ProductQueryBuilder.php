<?php

namespace Domain\Product\QueryBuilders;

use Domain\Catalog\Facades\Sorter;
use Domain\Catalog\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pipeline\Pipeline;

class ProductQueryBuilder extends Builder
{
	public function homePage(): ProductQueryBuilder
	{
		return $this->where('on_home_page', true)
			->orderBy('sort')
			->limit(10);
	}

	public function filtered(): ProductQueryBuilder
	{
		return app(Pipeline::class)
			->send($this)
			->through(filters())
			->thenReturn();
	}

	public function sorted(): Builder|ProductQueryBuilder
	{
		return Sorter::run($this);
	}

	public function withCategory(Category $category): mixed
	{
		return $this->when(
			$category->exists,
			function (Builder $q) use ($category) {
				return $q->whereRelation(
					'categories',
					'categories.id',
					'=',
					$category->id
				);
			}
		);
	}

	public function search(): mixed
	{
		return $this->when(request('s'), function (Builder $q) {
			return $q->whereFullText(['text', 'title'], request('s'));
		});
	}
}

<?php

namespace App\Models;

use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Pipeline\Pipeline;
use Support\Casts\PriceCast;
use Support\Traits\Models\HasImage;
use Support\Traits\Models\HasSlug;

class Product extends Model
{
	use HasFactory;
	use HasSlug;
	use HasImage;

	protected $casts = [
		'price' => PriceCast::class
	];

	protected $fillable = [
		'slug',
		'title',
		'thumbnail',
		'price',
		'brand_id',
		'sort',
		'on_home_page',
		'text'
	];

	public function scopeHomePage(Builder $query)
	{
		$query->where('on_home_page', true)
			->orderBy('sort')
			->limit(10);
	}

	public function scopeFiltered(Builder $query)
	{
		return app(Pipeline::class)
			->send($query)
			->through(filters())
			->thenReturn();
	}

	public function scopeSorted(Builder $query)
	{
		$query->when(request('sort'), function (Builder $query) {
			$column = request()->str('sort');

			if ($column->contains(['price', 'title'])) {
				$direction = $column->contains('-') ? 'DESC' : 'ASC';


				$query->orderBy($column->remove('-'), $direction);
			}
		});
	}

	public function brand(): BelongsTo
	{
		return $this->belongsTo(Brand::class);
	}

	public function categories(): BelongsToMany
	{
		return $this->belongsToMany(Category::class);
	}

	protected function imageDir(): string
	{
		return 'products';
	}
}

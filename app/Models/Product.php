<?php

namespace App\Models;

use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
		'on_home_page'
	];

	public function scopeHomePage(Builder $query)
	{
		$query->where('on_home_page', true)
			->orderBy('sort')
			->limit(10);
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

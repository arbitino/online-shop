<?php

namespace Domain\Catalog\Models;

use Domain\Catalog\Collections\BrandCollections;
use Domain\Catalog\QueryBuilders\BrandQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Support\Traits\Models\HasImage;
use Support\Traits\Models\HasSlug;

/**
 * @method static Brand|BrandQueryBuilder query()
 */
class Brand extends Model
{
	use HasFactory;
	use HasSlug;
	use HasImage;

	protected $fillable = [
		'slug',
		'title',
		'thumbnail',
		'sort',
		'on_home_page'
	];

	public function newCollection(array $models = []): BrandCollections
	{
		return new BrandCollections($models);
	}

	public function newEloquentBuilder($query): BrandQueryBuilder
	{
		return new BrandQueryBuilder($query);
	}

	public function products(): HasMany
	{
		return $this->hasMany(\Domain\Product\Models\Product::class);
	}

	protected function imageDir(): string
	{
		return 'brands';
	}
}

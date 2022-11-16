<?php

namespace Domain\Catalog\Models;

use App\Models\Product;
use Domain\Catalog\Collections\CategoryCollection;
use Domain\Catalog\QueryBuilders\BrandQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Support\Traits\Models\HasSlug;

/**
 * @method static Category|BrandQueryBuilder query()
 */
class Category extends Model
{
	use HasFactory;
	use HasSlug;

	protected $fillable = [
		'slug',
		'title',
		'sort',
		'on_home_page'
	];

	public function newEloquentBuilder($query): BrandQueryBuilder
	{
		return new BrandQueryBuilder($query);
	}

	public function newCollection(array $models = []): CategoryCollection
	{
		return new CategoryCollection($models);
	}

	public function products(): BelongsToMany
	{
		return $this->belongsToMany(Product::class);
	}
}

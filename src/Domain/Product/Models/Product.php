<?php

namespace Domain\Product\Models;

use App\Jobs\ProductJsonProperties;
use Database\Factories\ProductFactory;
use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Category;
use Domain\Product\QueryBuilders\ProductQueryBuilder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Support\Casts\PriceCast;
use Support\Traits\Models\HasImage;
use Support\Traits\Models\HasSlug;

/**
 *
 *
 * @property mixed $optionValues
 * @property mixed $properties
 * @property int $id
 */
class Product extends Model
{
	use HasFactory;
	use HasSlug;
	use HasImage;

	protected static function newFactory(): ProductFactory
	{
		return ProductFactory::new();
	}

	protected $casts = [
		'price' => PriceCast::class,
		'json_properties' => 'array',
	];

	protected $fillable = [
		'slug',
		'title',
		'thumbnail',
		'price',
		'brand_id',
		'sort',
		'on_home_page',
		'text',
		'json_properties',
	];

	public function completeProperties(): Attribute
	{
		return Attribute::make(function () {
			if (!is_null($this->json_properties) && count($this->json_properties)) {
				return $this->json_properties;
			}

			return $this->load('properties')
				->properties->keyValues();
		});
	}

	public function newEloquentBuilder($query): ProductQueryBuilder
	{
		return new ProductQueryBuilder($query);
	}

	protected static function boot()
	{
		parent::boot();

		static::created(function (Product $product) {
			ProductJsonProperties::dispatch($product)
				->delay(now()->addSeconds(10));
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

	public function properties(): BelongsToMany
	{
		return $this->belongsToMany(Property::class)
			->withPivot('value');
	}

	public function optionValues(): BelongsToMany
	{
		return $this->belongsToMany(OptionValue::class);
	}

	protected function imageDir(): string
	{
		return 'products';
	}
}

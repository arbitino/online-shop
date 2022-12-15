<?php

use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Category;
use Domain\Product\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function (Blueprint $table) {
			$table->id();
			$table->timestamps();

			$table->string('slug')->unique();
			$table->string('title');
			$table->string('thumbnail')->nullable();
			$table->unsignedInteger('price')->default(0);
			$table->boolean('on_home_page')->default(false);
			$table->unsignedInteger('sort')->default(500);

			$table->foreignIdFor(Brand::class)
				->nullable()
				->constrained()
				->cascadeOnUpdate()
				->nullOnDelete();
		});

		Schema::create('category_product', function (Blueprint $table) {
			$table->id();
			$table->timestamps();

			$table->foreignIdFor(Category::class)
				->constrained()
				->cascadeOnUpdate()
				->cascadeOnDelete();

			$table->foreignIdFor(Product::class)
				->constrained()
				->cascadeOnUpdate()
				->cascadeOnDelete();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		if (app()->isLocal()) {
			Schema::dropIfExists('category_product');
			Schema::dropIfExists('products');
		}
	}
};

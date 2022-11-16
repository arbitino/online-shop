<?php

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
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('slug')->unique();
            $table->string('title');
            $table->string('thumbnail')->nullable();
            $table->boolean('on_home_page')->default(false);
            $table->unsignedInteger('sort')->default(500);
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
            Schema::dropIfExists('brands');
        }
    }
};

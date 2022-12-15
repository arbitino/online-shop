<?php

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\CatalogController;
use App\Http\Middleware\CatalogViewMiddleware;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

final class CatalogRegistrar implements RouteRegistrar
{
	public function map(Registrar $registrar): void
	{
		Route::middleware('web')->group(function () {
			Route::get('/catalog/{category:slug?}', [CatalogController::class, 'index'])
				->middleware([CatalogViewMiddleware::class])
				->name('catalog');
		});
	}
}

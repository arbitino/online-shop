<?php

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImagesController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

final class AppRegistrar implements RouteRegistrar
{
	public function map(Registrar $registrar): void
	{
		Route::middleware('web')->group(function () {
			Route::get('/', [HomeController::class, 'index'])->name('home');

			Route::get('/storage/images/{dir}/{method}/{size}/{file}', [ImagesController::class, 'index'])
				->where('method', 'resize|crop|fit')
				->where('size', '\d+x\d+')
				->where('file', '.+\.(png|jpg|jpeg|gif|webm)')
				->name('image');
		});
	}
}

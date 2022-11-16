<?php

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Auth\ForgotPassword;
use App\Http\Controllers\Auth\ResetPassword;
use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\Auth\SignUpController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class AuthRegistrar implements RouteRegistrar
{

    public function map(Registrar $registrar): void
    {
        Route::middleware('web')->group(function () {
            Route::controller(SignInController::class)->group(function () {
                Route::get('/login', 'page')
                    ->name('login');

                Route::post('/login', 'handle')
                    ->middleware('throttle:auth')
                    ->name('login.handle');

                Route::delete('/logout', 'logout')
                    ->name('logout');
            });

            Route::controller(SignUpController::class)->group(function () {
                Route::get('/register', 'page')
                    ->name('register');

                Route::post('/register', 'handle')
                    ->middleware('throttle:auth')
                    ->name('register.handle');
            });

            Route::controller(ForgotPassword::class)->group(function () {
                Route::get('/forgot', 'page')
                    ->middleware('guest')
                    ->name('password.reset');

                Route::post('/forgot', 'handle')
                    ->middleware('guest')
                    ->name('forgot.handle');
            });

            Route::controller(ResetPassword::class)->group(function () {
                Route::get('/reset/{token}', 'page')
                    ->middleware('guest')
                    ->name('reset');

                Route::post('/reset', 'handle')
                    ->middleware('guest')
                    ->name('reset.handle');
            });
        });
    }
}

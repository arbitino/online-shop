<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'signIn')->name('signIn');

    Route::delete('/logout', 'logout')->name('logout');

    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'signUp')->name('signUp');

    Route::get('/reset/{token}', 'reset')
        ->middleware('guest')
        ->name('reset');

    Route::post('/reset', 'restore')
        ->middleware('guest')
        ->name('restore');

    Route::get('/forgot', 'forgot')
        ->middleware('guest')
        ->name('forgot');

    Route::post('/forgot', 'forgotAction')
        ->middleware('guest')
        ->name('forgotAction');
});

Route::get('/', [HomeController::class, 'index'])->name('home');


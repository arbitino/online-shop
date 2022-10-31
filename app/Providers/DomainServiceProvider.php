<?php

namespace App\Providers;

use Domain\Auth\Providers\AuthServiceProvider;
use Illuminate\Support\ServiceProvider;

class DomainServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(AuthServiceProvider::class);
    }
}

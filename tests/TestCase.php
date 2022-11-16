<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Http;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * @param \Illuminate\Foundation\Application $app
     */
    public function setApp(\Illuminate\Foundation\Application $app): void
    {
        $this->app = $app;

        Http::preventStrayRequests();
    }
}

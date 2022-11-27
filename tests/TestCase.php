<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

abstract class TestCase extends BaseTestCase
{
	use CreatesApplication;

	/**
	 * @param \Illuminate\Foundation\Application $app
	 */
	public function setApp(\Illuminate\Foundation\Application $app): void
	{
		$this->app = $app;

		Notification::fake();
		Storage::fake('images');

		Http::preventStrayRequests();
	}
}

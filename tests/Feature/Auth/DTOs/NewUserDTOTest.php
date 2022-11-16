<?php

namespace Auth\DTOs;

use Domain\Auth\DTOs\NewUserDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewUserDTOTest extends TestCase
{
	use RefreshDatabase;

	/**
	 * @test
	 * @return void
	 */
	public function it_instatce_created(): void
	{
		$dto = NewUserDTO::make(['test', 'test@test.com', '1234qwer']);

		$this->assertInstanceOf(NewUserDTO::class, $dto);
	}
}

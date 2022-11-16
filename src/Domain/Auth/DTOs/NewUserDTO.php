<?php

namespace Domain\Auth\DTOs;

use Illuminate\Http\Request;
use Support\Traits\Makeable;

class NewUserDTO
{
	use Makeable;

	public function __construct(
		public string $name,
		public string $email,
		public string $password
	) {
	}

	public static function fromRequest(Request $request): static
	{
		return self::make(
			$request->only(['name', 'email', 'password'])
		);
	}
}

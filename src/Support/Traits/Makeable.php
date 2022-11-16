<?php

namespace Support\Traits;

trait Makeable
{
	public static function make(mixed $arguments): static
	{
		if (is_array($arguments)) {
			return new static(...$arguments);
		}

		return new static($arguments);
	}
}

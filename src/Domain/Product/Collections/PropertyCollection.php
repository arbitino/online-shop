<?php

namespace Domain\Product\Collections;

use Illuminate\Database\Eloquent\Collection;

class PropertyCollection extends Collection
{
	public function keyValues()
	{
		return $this->mapWithkeys(
			fn($property) => [$property->title => $property->pivot->value]
		);
	}
}

<?php

namespace App\Traits\Models;

use Illuminate\Database\Eloquent\Model;

trait HasSlug
{
    protected static function bootHasSlug(): void
    {
        self::creating(function (Model $item) {
            $item->slug = $item->slug ?? str($item->{self::slugFrom()})->slug();
        });
    }

    public static function slugFrom(): string
    {
        return 'title';
    }
}

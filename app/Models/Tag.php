<?php

namespace App\Models;

use App\Observers\TagObserver;
use EloquentFilter\Filterable;

class Tag extends \Spatie\Tags\Tag
{
    use Filterable;

    public static function boot()
    {
        parent::boot();
        self::observe(TagObserver::class);
    }

    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }
}

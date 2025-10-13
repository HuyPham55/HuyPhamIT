<?php

namespace App\Models\Concerns;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @property $comments
 */
trait HasComments
{
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, Comment::MORPH_NAME);
    }

    public function orderedComments()
    {
        return $this->comments()->orderBy('path');
    }
}

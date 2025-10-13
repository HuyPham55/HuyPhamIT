<?php

namespace App\Observers;

use App\Models\Comment;
use Illuminate\Support\Str;

class CommentObserver
{
    /**
     * Handle the Comment "creating" event.
     */
    public function creating(Comment $comment)
    {
        // Ensure ULID exists now (HasUlids sets it, but be defensive)
        if (empty($comment->{$comment->getKeyName()})) {
            $comment->{$comment->getKeyName()} = (string)Str::ulid();
        }

        $segment = $comment->getKey(); // Use the ULID itself as the segment (26 chars)

        if ($comment->parent_id) {
            // We need parent's path/depth (1 quick lookup)
            $parent = $comment->relationLoaded('parent')
                ? $comment->parent
                : Comment::select('id', 'path', 'depth')->findOrFail($comment->parent_id);

            $comment->path = rtrim($parent->path, '/') . '/' . $segment;
            $comment->depth = $parent->depth + 1;
        } else {
            $comment->path = $segment;
            $comment->depth = 0;
        }
    }

    /**
     * Handle the Comment "created" event.
     */
    public function created(Comment $comment): void
    {
        //
    }

    /**
     * Handle the Comment "updated" event.
     */
    public function updated(Comment $comment): void
    {
        //
    }

    /**
     * Handle the Comment "deleted" event.
     */
    public function deleted(Comment $comment): void
    {
        //
    }

    /**
     * Handle the Comment "restored" event.
     */
    public function restored(Comment $comment): void
    {
        //
    }

    /**
     * Handle the Comment "force deleted" event.
     */
    public function forceDeleted(Comment $comment): void
    {
        //
    }
}

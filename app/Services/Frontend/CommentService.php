<?php

namespace App\Services\Frontend;

use App\Contracts\Services\Frontend\CommentServiceInterface;
use App\Models\Comment;
use App\Models\Contracts\Commentable;
use Illuminate\Database\Eloquent\Collection;

class CommentService implements CommentServiceInterface
{
    public function listFor(Commentable $owner): Collection
    {
        return $owner->orderedComments()->with(['author'])->get();
    }

    public function createRoot(Commentable $owner, $memberId, string $content)
    {
        return $owner->comments()->create([
            'member_id' => $memberId,
            'content' => $content,
        ]);
    }

    public function replyTo(Comment $parent, $memberId, string $content): Comment
    {
        // (Optional) verify $parent->commentable is accessible
        return $parent->commentable->comments()->create([
            'member_id' => $memberId,
            'content' => $content,
            'parent_id' => $parent->id,
        ]);
    }

    public function updateContent(Comment $comment, string $content): Comment
    {
        $comment->update(['content' => $content]);
        return $comment->refresh();
    }

    public function delete(Comment $comment): void
    {
        $comment->delete();
    }
}

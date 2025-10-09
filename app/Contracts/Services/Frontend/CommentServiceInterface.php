<?php

namespace App\Contracts\Services\Frontend;

use App\Models\Comment;
use App\Models\Contracts\Commentable;
use Illuminate\Database\Eloquent\Collection;

interface CommentServiceInterface
{
    public function listFor(Commentable $owner): Collection;             // ordered by path

    public function createRoot(Commentable $owner, int|string $memberId, string $content);

    public function replyTo(Comment $parent, int|string $memberId, string $content): Comment;

    public function updateContent(Comment $comment, string $content): Comment;

    public function delete(Comment $comment): void;
}

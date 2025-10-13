<?php

namespace Tests\Feature\Comments;

use App\Models\Comment;
use App\Models\Member;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Comments\BaseTest\CommentTestCase;

//use App\Models\Thread;

class CommentModelCommentTest extends CommentTestCase
{
    use RefreshDatabase;

    public function test_creates_root_comment_with_correct_path_and_depth_on_post(): void
    {
        $post = Post::factory()->create();
        $member = Member::factory()->create();

        $c = $post->comments()->create([
            'member_id' => $member->id,
            'content' => 'root',
        ]);

        $this->assertNull($c->parent_id);
        $this->assertSame(0, $c->depth);
        $this->assertSame($c->id, $c->path); // ULID segment as root path
    }

    public function test_creates_reply_with_correct_path_and_depth(): void
    {
        $post = Post::factory()->create();
        $m1 = Member::factory()->create();
        $m2 = Member::factory()->create();

        $root = $post->comments()->create(['member_id' => $m1->id, 'content' => 'root']);
        $reply = $post->comments()->create([
            'member_id' => $m2->id,
            'content' => 'reply',
            'parent_id' => $root->id,
        ]);

        $this->assertSame(1, $reply->depth);
        $this->assertSame($root->path . '/' . $reply->id, $reply->path);
    }

    public function test_orders_full_thread_by_path_for_fast_reads(): void
    {
        $post = Post::factory()->create();
        $m = Member::factory()->create();

        $a = $post->comments()->create(['member_id' => $m->id, 'content' => 'A']);
        $b = $post->comments()->create(['member_id' => $m->id, 'content' => 'B']);
        $a1 = $post->comments()->create(['member_id' => $m->id, 'content' => 'A1', 'parent_id' => $a->id]);
        $b1 = $post->comments()->create(['member_id' => $m->id, 'content' => 'B1', 'parent_id' => $b->id]);
        $a2 = $post->comments()->create(['member_id' => $m->id, 'content' => 'A2', 'parent_id' => $a->id]);

        $ordered = $post->comments()->orderBy('path')->pluck('content')->toArray();

        // Expected: A, A1, A2, B, B1 (ULIDs sort by time; creation order is preserved)
        $this->assertSame(['A', 'A1', 'A2', 'B', 'B1'], $ordered);
    }

    public function test_fetches_a_subtree_by_prefix(): void
    {
        $post = Post::factory()->create();
        $clonedPost = clone $post;
        $m = Member::factory()->create();

        $root = $post->comments()->create(['member_id' => $m->id, 'content' => 'R']);
        $a = $post->comments()->create(['member_id' => $m->id, 'content' => 'A', 'parent_id' => $root->id]);
        $b = $post->comments()->create(['member_id' => $m->id, 'content' => 'B', 'parent_id' => $root->id]);
        $a1 = $post->comments()->create(['member_id' => $m->id, 'content' => 'A1', 'parent_id' => $a->id]);
        $b1 = $post->comments()->create(['member_id' => $m->id, 'content' => 'B1', 'parent_id' => $b->id]);

        $prefix = rtrim($a->path, '/') . '/';
        $sub = Comment::for($post)
            ->where('path', 'like', $prefix . '%')
            ->orderBy('path')
            ->pluck('content')
            ->toArray();

        $this->assertSame(['A1'], $sub);
    }

//    public function test_polymorphism_works_for_thread(): void
//    {
//        $thread = Thread::factory()->create();
//        $m      = Member::factory()->create();
//
//        $root  = $thread->comments()->create(['member_id' => $m->id, 'content' => 'hello']);
//        $child = $thread->comments()->create(['member_id' => $m->id, 'content' => 'hi', 'parent_id' => $root->id]);
//
//        $this->assertSame('thread', $root->commentable_type);
//        $this->assertSame($thread->getKey(), $root->commentable_id);
//        $this->assertStringContainsString($root->id . '/', $child->path);
//    }

    public function test_cascade_delete_removes_descendants(): void
    {
        $post = Post::factory()->create();
        $m = Member::factory()->create();

        $root = $post->comments()->create(['member_id' => $m->id, 'content' => 'root']);
        $child = $post->comments()->create(['member_id' => $m->id, 'content' => 'child', 'parent_id' => $root->id]);

        // $root->delete();
        $root->forceDelete(); // soft delete will not trigger cascade delete

        $this->assertNull(Comment::find($root->id));
        $this->assertNull(Comment::find($child->id));
    }
}

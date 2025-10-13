<?php
namespace Tests\Feature\Comments;

use App\Models\Member;
use App\Models\Post;
use App\Services\Frontend\CommentService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Comments\BaseTest\CommentTestCase;

class CommentServiceTest extends CommentTestCase
{
    use RefreshDatabase;

    public function test_service_creates_root_and_reply(): void
    {
        $svc  = app(CommentService::class);
        $post = Post::factory()->create();
        $m    = Member::factory()->create();

        $root  = $svc->createRoot($post, $m->id, 'root via svc');
        $reply = $svc->replyTo($root, $m->id, 'reply via svc');

        $this->assertTrue($root->exists);
        $this->assertTrue($reply->exists);
        $this->assertSame($root->id, $reply->parent_id);
        $this->assertSame($root->path . '/' . $reply->id, $reply->path);
    }

    public function test_service_lists_ordered_comments(): void
    {
        $svc  = app(CommentService::class);
        $post = Post::factory()->create();
        $m    = Member::factory()->create();

        $a  = $svc->createRoot($post, $m->id, 'A');
        $a1 = $svc->replyTo($a, $m->id, 'A1');
        $b  = $svc->createRoot($post, $m->id, 'B');

        $list = $svc->listFor($post)->pluck('content')->toArray();

        $this->assertSame(['A','A1','B'], $list);
    }

//    public function test_service_works_for_thread(): void
//    {
//        $svc    = app(CommentService::class);
//        $thread = Thread::factory()->create();
//        $m      = Member::factory()->create();
//
//        $root = $svc->createRoot($thread, $m->id, 'hello thread');
//        $this->assertSame('thread', $root->commentable_type);
//        $this->assertSame($thread->getKey(), $root->commentable_id);
//    }
}

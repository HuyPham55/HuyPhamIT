<?php

namespace App\Http\Controllers\Frontend;

use App\Contracts\Services\Frontend\PostServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\Frontend\PostDetailResource;
use App\Models\Post;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class PostDetailController extends Controller
{
    use HttpResponses;

    public function __construct(
        protected PostServiceInterface $postService,
    )
    {
    }

    public function show(Request $request, string $hash)
    {
        $post = $this->postService->getByHash($hash);
        return new PostDetailResource($post);
    }

    public function preview(Request $request, Post $post)
    {
        $post->load(['author', 'tags']);
        return new PostDetailResource($post);
    }
    public function bookmark(Request $request, Post $post)
    {
        $user = $request->user();
        if ($user->bookmarkedPosts()->where('post_id', $post->id)->exists()) {
            $user->bookmarkedPosts()->detach($post->id);
            return $this->success([
                'post_hash' => $post->hash,
                'bookmark_status' => false,
            ], 'Post removed from bookmarks.');
        } else {
            $user->bookmarkedPosts()->attach($post->id);
            return $this->success([
                'post_hash' => $post->hash,
                'bookmark_status' => true,
            ], 'Post added to bookmarks.');
        }
    }
}

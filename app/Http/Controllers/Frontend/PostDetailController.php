<?php

namespace App\Http\Controllers\Frontend;

use App\Contracts\Repositories\PostRepositoryInterface;
use App\Contracts\Services\Frontend\PostServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\Frontend\PostDetailResource;
use Illuminate\Http\Request;

class PostDetailController extends Controller
{
    //
    public function __construct(
        protected PostServiceInterface $postService,
        protected PostRepositoryInterface $postRepository
    )
    {
    }

    public function show(Request $request, string $hash)
    {
        $post = $this->postService->getByHash($hash);
        return new PostDetailResource($post);
    }

    public function preview(Request $request, string $hash)
    {
        // TODO: Code refactor
        $post = $this->postRepository->query()
            ->where('hash', $hash)
            ->firstOrFail();
        return new PostDetailResource($post);
    }
}

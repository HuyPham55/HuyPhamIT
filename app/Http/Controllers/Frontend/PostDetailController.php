<?php

namespace App\Http\Controllers\Frontend;

use App\Contracts\Services\Frontend\PostServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\Frontend\PostDetailResource;
use Illuminate\Http\Request;

class PostDetailController extends Controller
{
    //
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
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Contracts\Services\Frontend\PostServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\Frontend\PostCollection;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class PostListController extends Controller
{
    //
    use HttpResponses;

    public function __construct(
        protected PostServiceInterface $postService
    )
    {

    }

    public function index(Request $request)
    {
        $posts = $this->postService->getAll(
            null,
            'publish_date',
            'desc'
        );
        return new PostCollection($posts);
    }
}

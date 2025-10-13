<?php

namespace App\Http\Controllers\Frontend;

use App\Contracts\Services\Frontend\CommentServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Comments\StoreRootRequest;
use App\Http\Resources\Frontend\CommentResource;
use App\Models\Post;
use Illuminate\Support\Facades\Request;

class CommentController extends Controller
{
    public function __construct(protected CommentServiceInterface $service)
    {
    }

    public function getComments(Request $request, $type, $id)
    {
        $owner = $this->getOwner($type, $id);
        $result = $this->service->listFor($owner);
        return response()->json(CommentResource::collection($result));
    }

    public function postComment(StoreRootRequest $request, $type, $id)
    {
        $owner = $this->getOwner($type, $id);
        $content = $request->string('content');
        $memberId = $request->user()->id;
        $comment = $this->service->createRoot(
            $owner,
            $memberId,
            $content
        );
        $comment->load(['author']);
        return response()->json(new CommentResource($comment), 201);
    }

    /**
     * @param $type
     * @param $id
     * @return mixed
     */
    protected function getOwner($type, $id)
    {
        $class = match ($type) {
            Post::BIND_TYPE => Post::class,
        };
        return $class::findOrFail($id);
    }
}

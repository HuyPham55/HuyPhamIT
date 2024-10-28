<?php

namespace App\Services\Frontend;

use App\Contracts\Repositories\PostRepositoryInterface;
use App\Contracts\Services\Frontend\PostServiceInterface;

class PostService implements PostServiceInterface
{
    public function __construct(
        public PostRepositoryInterface $repository
    )
    {
    }

    public function getAll($size = 15)
    {
        return $this->repository
            ->query()
            ->with(['author', 'tags'])
            ->simplePaginate($size);
    }

    public function getByHash(string $hash)
    {
        $post = $this->repository
            ->query()
            ->with(['author', 'tags'])
            ->where('hash', $hash)
            ->firstOrFail();

        $this->repository->update($post, [
            'view_count' => $post->view_count + 1,
        ]);
        return $post;
    }
}

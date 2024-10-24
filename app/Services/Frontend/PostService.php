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
            ->paginate($size);
    }

    public function getByHash(string $hash)
    {
        return $this->repository
            ->query()
            ->with(['author', 'tags'])
            ->where('hash', $hash)
            ->firstOrFail();
    }
}

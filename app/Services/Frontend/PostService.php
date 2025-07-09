<?php

namespace App\Services\Frontend;

use App\Contracts\Repositories\PostRepositoryInterface;
use App\Contracts\Services\Frontend\PostServiceInterface;
use App\Enums\CommonStatus;
use App\Models\Post;

class PostService implements PostServiceInterface
{
    protected array $sortableFields = [
        'id',
        'created_at',
        'updated_at',
        'view_count',
    ];
    public function __construct(
        public PostRepositoryInterface $repository
    )
    {
    }

    public function getAll($size = 15, $orderBy = null, $order = null)
    {
        $query = $this->repository
            ->query()
            ->with(['author', 'tags'])
            ->where('status', CommonStatus::Active)
            ->whereNotNull('publish_date');
        $order = in_array($order, ['asc', 'desc']) ? $order : null;
        if ($orderBy && in_array($orderBy, $this->sortableFields)) {
            $query->orderBy($orderBy, $order);
        }
        return $query->simplePaginate($size);
    }

    public function getByHash(string $hash)
    {
        $post = $this->repository
            ->query()
            ->with(['author', 'tags'])
            ->where('status', CommonStatus::Active)
            ->where('hash', $hash)
            ->firstOrFail();

        $this->repository->update($post, [
            'view_count' => $post->view_count + 1,
        ]);
        return $post;
    }
}

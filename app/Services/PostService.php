<?php

namespace App\Services;

use App\Contracts\Repositories\PostRepositoryInterface;
use App\Contracts\Services\PostServiceInterface;
use Yajra\DataTables\Facades\DataTables;

class PostService implements PostServiceInterface
{
    public function __construct(
        public PostRepositoryInterface $repository
    )
    {
    }

    public function datatables(array $filters)
    {
        $posts = $this->repository->query()
            ->filter($filters);
        $data = DataTables::eloquent($posts)
            ->editColumn('image', function ($item) {
                return either($item->image, '/images/no-image.png');
            })
            ->editColumn('title', function ($item) {
                return $item->dynamic_title;
            })
            ->editColumn('status', function ($item) {
                return view('components.buttons.datatables.bootstrapSwitch', [
                    'data' => $item,
                    'permission' => 'edit_posts',
                    'key' => $item->hash,
                ]);
            })
            ->editColumn('created_at', function ($item) {
                return $item->date_format;
            })
            ->editColumn('updated_at', function ($item) {
                return $item->formatDate('updated_at');
            })
            ->addColumn('action', function ($item) {
                return view('components.buttons.edit', ['route' => route('posts.edit', ['post' => $item])])
                    . ' ' .
                    view('components.buttons.datatables.delete', ['route' => route('posts.delete', ['post' => $item]), 'key' => $item->hash]);
            })
            ->setRowId(function ($item) {
                return 'row-id-' . $item->hash;
            });
        return $data->toJson();
    }

    public function getAll()
    {
        return $this->repository->all();
    }

    public function getByID($id)
    {
        return $this->repository->findByID($id);
    }

    public function create(array $data): bool
    {
        $userID = auth()->guard('web')->user()->id;
        $data['user_id'] = $userID;
        return $this->repository->create($data);
    }

    public function update($model, array $data): bool
    {
        $userID = auth()->guard('web')->user()->id;
        $data['updated_by'] = $userID;
        return $this->repository->update($model, $data);
    }

    public function delete($model): bool
    {
        return $this->repository->delete($model);
    }

    public function getCount()
    {
        return $this->repository->getCount();
    }

    public function getInactiveCount()
    {
        return $this->repository->getInactiveCount();
    }

    public function changeStatus($model, string $field, int $status): bool
    {
        $userID = auth()->guard('web')->user()->id;
        $data = [
            'status' => $status,
            'updated_by' => $userID,
        ];
        return $this->repository->updateByArray($model, $data);
    }

    public function changeSorting($model, string $field = 'sorting', int $sorting = 0): bool
    {
        $userID = auth()->guard('web')->user()->id;
        $data = [
            $field => $sorting,
            'updated_by' => $userID,
        ];
        return $this->repository->updateByArray($model, $data);
    }
}

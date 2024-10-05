<?php

namespace App\Repositories;

use App\Contracts\Repositories\PostCategoryRepositoryInterface;
use App\Models\PostCategory;
use Illuminate\Database\Eloquent\Collection;

class PostCategoryRepository implements PostCategoryRepositoryInterface
{
    public function __construct(
        protected PostCategory $model
    )
    {
    }

    public function all(): Collection|array
    {
        return $this->model->query()
            ->withCount(['posts'])
            ->orderBy('sorting')
            ->orderBy('id')
            ->get();
    }

    public function findByID(int $id)
    {
        return $this->model->query()->findOrFail($id);
    }

    public function create(array $data = [])
    {
        return $this->model;
    }

    public function update($model, array $data): bool
    {
        return !!$model->update($data);
    }

    public function delete($model): bool
    {
        return !!$model->delete();
    }

    public function query()
    {
        return $this->model->query();
    }
}

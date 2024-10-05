<?php

namespace App\Repositories;

use App\Contracts\Repositories\TagRepositoryInterface;
use App\Models\Tag;

class TagRepository implements TagRepositoryInterface
{
    public function __construct(
        public Tag $model
    )
    {
    }

    public function all()
    {
        return $this->model->all();
    }

    public function findByID(int $id)
    {
        return $this->model->query()->findOrFail($id);
    }

    public function findByString(string $keyword)
    {
        return $this->model->findFromString($keyword);
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

<?php

namespace App\Repositories;

use App\Contracts\Repositories\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(
        public User $model
    )
    {
    }

    public function query()
    {
        return $this->model->query();
    }

    public function all()
    {
        return $this->model->all();
    }

    public function findByID(int $id)
    {
        return $this->model->query()->findOrFail($id);
    }

    public function create(array $data = [])
    {
        return $this->model->create($data);
    }

    public function update($model, array $data): bool
    {
        return !!$model->update($data);
    }

    public function delete($model): bool
    {
        return !!$model->delete();

    }
}

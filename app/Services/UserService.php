<?php

namespace App\Services;

use App\Contracts\Repositories\UserRepositoryInterface;
use App\Contracts\Services\UserServiceInterface;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface {

    public function __construct(
        private UserRepositoryInterface $repository
    )
    {
    }

    public function getCount()
    {
        return $this->repository->getCount();
    }

    public function getByID($id)
    {
        return $this->repository->findByID($id);
    }

    public function create(array $data): bool
    {
        $data['password'] = Hash::make($data['password']);
        return $this->repository->create($data);
    }

    public function update($model, array $data): bool
    {
        $data['password'] = empty($data['password'])
            ? $model->password
            : Hash::make($data['password']);
        return $this->repository->update($model, $data);
    }

    public function delete($model): bool
    {
        return $this->repository->delete($model);
    }

    public function getAll()
    {
        return $this->repository->all();
    }

    public function updateByArray($model, array $data): bool
    {
        return $this->repository->updateByArray($model, $data);
    }

    public function changeUserPassword($model, $password): bool
    {
        return $this->repository->updateByArray($model, [
            'password' => Hash::make($password)
        ]);
    }
}

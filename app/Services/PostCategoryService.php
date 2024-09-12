<?php

namespace App\Services;

use App\Contracts\Repositories\PostCategoryRepositoryInterface;
use App\Contracts\Services\PostCategoryServiceInterface;

class PostCategoryService implements PostCategoryServiceInterface
{
    public function __construct(
        protected PostCategoryRepositoryInterface $repository
    )
    {
    }

    public function getAll()
    {
        return $this->repository->all();
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
        return $this->repository->create($data);
    }

    public function update($model, array $data): bool
    {
        return $this->repository->update($model, $data);
    }

    public function changeStatus($model, string $field, int $status): bool
    {
        $data = [
            'status' => $status,
        ];
        return $this->repository->updateByArray($model, $data);
    }

    public function changeSorting($model, string $field = 'sorting', int $sorting = 0): bool
    {
        $data = [
            $field => $sorting,
        ];
        return $this->repository->updateByArray($model, $data);
    }

    public function delete($model): bool
    {
        return $this->repository->delete($model);

    }
}

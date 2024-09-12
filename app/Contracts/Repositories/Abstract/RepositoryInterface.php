<?php

namespace App\Contracts\Repositories\Abstract;

interface RepositoryInterface
{
    public function query();

    public function getCount();

    public function all();

    public function findByID(int $id);

    public function create(array $data): bool;

    public function update($model, array $data): bool;

    public function delete($model): bool;
}

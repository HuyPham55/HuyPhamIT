<?php

namespace App\Contracts\Repositories\Abstract;

interface RepositoryInterface
{
    public function query();

    public function all();

    public function findByID(int $id);

    public function create(array $data = []);

    public function update($model, array $data): bool;

    public function delete($model): bool;
}

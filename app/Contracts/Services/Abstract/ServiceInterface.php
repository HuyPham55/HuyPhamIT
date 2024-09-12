<?php

namespace App\Contracts\Services\Abstract;

interface ServiceInterface
{
    public function getCount();

    public function getByID($id);

    public function create(array $data): bool;

    public function update($model, array $data): bool;

    public function delete($model): bool;
}

<?php

namespace App\Contracts\Services;

use App\Contracts\Services\Abstract\ServiceInterface;

interface PostServiceInterface extends ServiceInterface
{
    public function datatables(array $filters);

    public function getAll();

    public function changeStatus($model, string $field, int $status): bool;

    public function changeSorting($model, string $field, int $sorting = 0): bool;

}

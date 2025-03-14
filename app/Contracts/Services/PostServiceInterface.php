<?php

namespace App\Contracts\Services;

use App\Contracts\Services\Abstract\ServiceInterface;

interface PostServiceInterface extends ServiceInterface
{
    public function datatables(array $filters);

    public function getAll();

    public function changeStatus($model, string $field, int $status);

    public function changeSorting($model, string $field, int $sorting = 0);

}

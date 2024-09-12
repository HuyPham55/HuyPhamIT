<?php

namespace App\Contracts\Services;

use App\Contracts\Services\Abstract\ServiceInterface;

interface PostCategoryServiceInterface extends ServiceInterface
{
    public function changeStatus($model, string $field, int $status): bool;

    public function changeSorting($model, string $field, int $sorting = 0): bool;
}

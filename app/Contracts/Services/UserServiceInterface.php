<?php

namespace App\Contracts\Services;

use App\Contracts\Services\Abstract\ServiceInterface;

interface UserServiceInterface extends ServiceInterface
{
    public function getAll();

    public function updateByArray($model, array $data): bool;

    public function changeUserPassword($model, array $data): bool;
}

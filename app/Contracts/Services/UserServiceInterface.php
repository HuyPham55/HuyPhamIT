<?php

namespace App\Contracts\Services;

use App\Contracts\Services\Abstract\ServiceInterface;

interface UserServiceInterface extends ServiceInterface
{
    public function getAll();

    public function changeUserPassword($model, string $newPassword): bool;

    public function updateProfile($model, array $data): bool;
}

<?php

namespace App\Contracts\Repositories;

use App\Contracts\Repositories\Abstract\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function updateByArray($model, array $data): bool;
}

<?php

namespace App\Contracts\Repositories;

use App\Contracts\Repositories\Abstract\RepositoryInterface;

interface PostRepositoryInterface extends RepositoryInterface
{
    public function updateByArray($model, array $data): bool;
}

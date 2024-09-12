<?php

namespace App\Contracts\Repositories;

use App\Contracts\Repositories\Abstract\RepositoryInterface;

interface PostCategoryRepositoryInterface extends RepositoryInterface
{
    public function updateByArray($model, array $data): bool;
}

<?php

namespace App\Contracts\Repositories;

use App\Contracts\Repositories\Abstract\RepositoryInterface;

interface TagRepositoryInterface extends RepositoryInterface
{
    public function findByString(string $keyword);
}

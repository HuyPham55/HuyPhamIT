<?php

namespace App\Contracts\Services;

use App\Contracts\Services\Abstract\ServiceInterface;

interface TagServiceInterface extends ServiceInterface
{
    public function datatables(array $filters);

    public function getAll();
}

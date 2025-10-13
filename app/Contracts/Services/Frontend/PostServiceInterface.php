<?php

namespace App\Contracts\Services\Frontend;

interface PostServiceInterface
{
    public function getAll($size, $orderBy, $order);

    public function getByHash(string $hash);

}

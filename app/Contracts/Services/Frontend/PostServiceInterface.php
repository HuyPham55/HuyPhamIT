<?php

namespace App\Contracts\Services\Frontend;

interface PostServiceInterface
{
    public function getAll();

    public function getByHash(string $hash);

}

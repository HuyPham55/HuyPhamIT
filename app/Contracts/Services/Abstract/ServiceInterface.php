<?php

namespace App\Contracts\Services\Abstract;

interface ServiceInterface
{
    public function getCount();

    public function getByID($id);

    public function create(array $data);

    public function update($model, array $data);

    public function delete($model);
}

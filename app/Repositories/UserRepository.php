<?php

namespace App\Repositories;

use App\Contracts\Repositories\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(
        public User $model
    )
    {
    }

    public function all()
    {
        return $this->model->all();
    }

    public function findByID(int $id)
    {
        return $this->model->query()->findOrFail($id);
    }
    public function create(array $data): bool
    {
        $model = $this->model;
        DB::beginTransaction();
        try {
            $this->fillContent($data, $model);
            $model->save();
            $model->assignRole($data['role']);
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            Log::error($exception);
            DB::rollback();
            return false;
        }
    }

    public function update($model, array $data): bool
    {
        DB::beginTransaction();
        try {
            $this->fillContent($data, $model);
            $model->save();
            $model->assignRole($data['role']);
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            Log::error($exception);
            DB::rollback();
            return false;
        }
    }

    public function delete($model): bool
    {
        DB::beginTransaction();
        try {
            $result = $model->delete();
            DB::commit();
            return $result;
        } catch (\Exception $exception) {
            Log::error($exception);
            DB::rollback();
            return false;
        }
    }

    public function query()
    {
        return $this->model->query();
    }

    public function getCount()
    {
        return $this->model->count();
    }

    public function fillContent(array $data, User $model): void
    {
        $model->username = $data['username'];
        $model->name = $data['name'];
        $model->email = $data['email'];
        $model->password = $data['password'];
        $model->status = $data['status'];
    }

    public function updateByArray($model, array $data): bool
    {
        DB::beginTransaction();
        try {
            $result = $model->update($data);
            DB::commit();
            return !!$result;
        } catch (\Exception $exception) {
            Log::error($exception);
            DB::rollback();
            return false;
        }
    }
}

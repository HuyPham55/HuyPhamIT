<?php

namespace App\Services;

use App\Contracts\Repositories\UserRepositoryInterface;
use App\Contracts\Services\UserServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserService implements UserServiceInterface
{

    public function __construct(
        private readonly UserRepositoryInterface $repository
    )
    {
    }

    public function getCount()
    {
        return $this->repository->query()->count();
    }

    public function getByID($id)
    {
        return $this->repository->findByID($id);
    }

    public function create(array $data): bool
    {
        DB::beginTransaction();
        try {
            $data['password'] = Hash::make($data['password']);
            $model = $this->repository->create($data);
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
            $data['password'] = empty($data['password'])
                ? $model->password
                : Hash::make($data['password']);
            $this->repository->update($model, $data);
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
            $result = $this->repository->delete($model);
            if ($result) {
                DB::commit();
                return true;
            } else {
                return false;
            }
        } catch (\Exception $exception) {
            Log::error($exception);
            DB::rollback();
            return false;
        }
    }

    public function getAll()
    {
        return $this->repository->all();
    }

    public function changeUserPassword($model, $newPassword): bool
    {
        return $this->repository->update($model, [
            'password' => Hash::make($newPassword)
        ]);
    }


    public function updateProfile($model, array $data): bool
    {
        DB::beginTransaction();
        try {
            $this->repository->update($model, $data);
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            Log::error($exception);
            DB::rollback();
            return false;
        }
    }
}

<?php

namespace App\Repositories;

use App\Contracts\Repositories\TagRepositoryInterface;
use App\Enums\CommonStatus;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TagRepository implements TagRepositoryInterface
{
    public function __construct(
        public Tag $model
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

    public function findByString(string $keyword)
    {
        return $this->model->findFromString($keyword);
    }
    public function create(array $data): bool
    {
        $model = $this->model;
        DB::beginTransaction();
        try {
            $this->fillContent($data, $model);
            $model->save();
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
            $model->updated_by = $data['updated_by'];
            $model->save();
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

    public function getInactiveCount()
    {
        return $this->model->where('status', CommonStatus::Inactive)->count();
    }

    /**
     * @param array $data
     * @param Tag $model
     * @return void
     */
    public function fillContent(array $data, Tag $model): void
    {
        foreach (config('lang') as $langKey => $langTitle) {
            $title = $data[$langKey]["name"];
            $model->setTranslation('name', $langKey, $title);
            //$model->setTranslation('slug', $langKey, Str::slug($title)); //auto-generated
        }
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

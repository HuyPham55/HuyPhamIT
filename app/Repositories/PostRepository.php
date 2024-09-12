<?php

namespace App\Repositories;

use App\Contracts\Repositories\PostRepositoryInterface;
use App\Enums\CommonStatus;
use App\Models\Post;
use Hashids\Hashids;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PostRepository implements PostRepositoryInterface
{
    public function __construct(
        public Post $model
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
            $model->user_id = $data['user_id'];
            $hashids = new Hashids();
            $model->hash = $hashids->encode(time());
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
     * @param Post $model
     * @return void
     */
    public function fillContent(array $data, Post $model): void
    {
        foreach (config('lang') as $langKey => $langTitle) {
            $title = $data[$langKey]["title"];
            $newSlug = simple_slug($title);
            $defaultSlug = simple_slug("");
            $inputSlug = $data[$langKey]["slug"];
            if (!empty($inputSlug) && ($inputSlug !== $defaultSlug)) {
                $newSlug = simple_slug($inputSlug);
            }
            $model->setTranslation('image', $langKey, $data[$langKey]["image"]);
            $model->setTranslation('title', $langKey, $title);
            $model->setTranslation('slug', $langKey, !empty($newSlug) ? $newSlug : 'post-detail');
            $model->setTranslation('content', $langKey, $data[$langKey]["content"]);
            $model->setTranslation('short_description', $langKey, $data[$langKey]["short_description"]);

            $model->setTranslation('seo_title', $langKey, $data[$langKey]["seo_title"]);
            $model->setTranslation('seo_description', $langKey, $data[$langKey]["seo_description"]);
        }
        $model->category_id = $data['category'] | 0;

        $model->sorting = $data['sorting'] | 0;

        $model->publish_date = $data['publish_date'];

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

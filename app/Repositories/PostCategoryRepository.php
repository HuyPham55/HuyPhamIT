<?php

namespace App\Repositories;

use App\Contracts\Repositories\PostCategoryRepositoryInterface;
use App\Models\PostCategory;
use App\Services\CategoryService;
use Hashids\Hashids;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PostCategoryRepository implements PostCategoryRepositoryInterface
{
    protected CategoryService $categoryService;

    public function __construct(
        protected PostCategory $model
    )
    {
    }

    public function all(): Collection|array
    {
        return $this->model->query()
            ->withCount(['posts'])
            ->orderBy('sorting')
            ->orderBy('id')
            ->get();
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
            $model->save();
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            Log::error($exception);
            DB::rollback();
            return false;
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

    public function delete($model): bool
    {
        DB::beginTransaction();
        try {
            $this->categoryService = new CategoryService($this->model);
            $arrayChildrenID = $this->categoryService->getArrayChildrenId($model->lft, $model->rgt);
            foreach ($this->model->whereIn('id', $arrayChildrenID)->get() as $childCategory) {
                if ($childCategory->posts()->count() > 0) {
                    return false;
                }
                $childCategory->delete();
            }
            DB::commit();
            return true;
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

    protected function fillContent(array $data, PostCategory $model): void
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
            $model->setTranslation('seo_title', $langKey, $data[$langKey]["seo_title"]);
            $model->setTranslation('seo_description', $langKey, $data[$langKey]["seo_description"]);
        }
        $model->parent_id = $data['parent_category'] | 0;
        $model->sorting = $data['sorting'] | 0;
        $model->status = $data['status'];
    }
}

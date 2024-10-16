<?php

namespace App\Services;

use App\Contracts\Repositories\PostCategoryRepositoryInterface;
use App\Contracts\Services\PostCategoryServiceInterface;
use App\Models\PostCategory;
use Hashids\Hashids;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PostCategoryService implements PostCategoryServiceInterface
{
    protected CategoryService $categoryService;

    public function __construct(
        protected PostCategoryRepositoryInterface $repository
    )
    {
    }

    public function getAll()
    {
        return $this->repository->all();
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
        $hashids = new Hashids();
        try {
            $model = $this->repository->create();
            $model->hash = $hashids->encode(time());
            //Hash must have a initial value
            $this->fillContent($data, $model);
            $model->save();
            $model->hash = $hashids->encode($model->id);
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

    public function changeStatus($model, string $field, int $status): bool
    {
        DB::beginTransaction();
        try {
            $data = [
                'status' => $status,
            ];
            return !!$this->repository->update($model, $data);
        } catch (\Exception $exception) {
            Log::error($exception);
            DB::rollback();
            return false;
        }
    }

    public function changeSorting($model, string $field = 'sorting', int $sorting = 0): bool
    {
        DB::beginTransaction();
        try {
            $data = [
                $field => $sorting,
            ];
            return $this->repository->update($model, $data);
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
            $this->categoryService = new CategoryService($model);
            $arrayChildrenID = $this->categoryService->getArrayChildrenId($model->lft, $model->rgt);
            foreach ($this->repository->query()->whereIn('id', $arrayChildrenID)->get() as $childCategory) {
                if ($childCategory->posts()->count() > 0) {
                    return false;
                }
                $childCategory->delete();
            }
            return true;
        } catch (\Exception $exception) {
            Log::error($exception);
            DB::rollback();
            return false;
        }
    }

    protected function fillContent(array $data, PostCategory $model): void
    {
        foreach (config('lang') as $langKey => $langTitle) {
            $title = data_get($data, "$langKey.title");
            $newSlug = simple_slug($title);
            $defaultSlug = simple_slug("");
            $inputSlug = data_get($data, "$langKey.slug");
            if (!empty($inputSlug) && ($inputSlug !== $defaultSlug)) {
                $newSlug = simple_slug($inputSlug);
            }
            $model->setTranslation('image', $langKey, data_get($data, "$langKey.image"));
            $model->setTranslation('title', $langKey, $title);
            $model->setTranslation('slug', $langKey, !empty($newSlug) ? $newSlug : 'post-detail');
            $model->setTranslation('seo_title', $langKey, data_get($data, "$langKey.seo_title"));
            $model->setTranslation('seo_description', $langKey, data_get($data, "$langKey.seo_description"));
        }
        $model->parent_id = data_get($data, "parent_category") | 0;
        $model->sorting = data_get($data, "sorting") | 0;
        $model->status = data_get($data, "status");
    }
}

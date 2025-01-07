<?php

namespace App\Services;

use App\Contracts\Repositories\PostRepositoryInterface;
use App\Contracts\Services\PostServiceInterface;
use App\Enums\CommonStatus;
use App\Models\Post;
use Hashids\Hashids;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class PostService implements PostServiceInterface
{
    public function __construct(
        public PostRepositoryInterface $repository
    )
    {
    }

    public function datatables(array $filters)
    {
        $posts = $this->repository->query()
            ->filter($filters);
        $data = DataTables::eloquent($posts)
            ->editColumn('image', function ($item) {
                return either($item->image, '/images/no-image.png');
            })
            ->editColumn('title', function ($item) {
                return $item->dynamic_title;
            })
            ->editColumn('status', function ($item) {
                return view('components.buttons.datatables.bootstrapSwitch', [
                    'data' => $item,
                    'permission' => 'edit_posts',
                    'key' => $item->hash,
                ]);
            })
            ->editColumn('created_at', function ($item) {
                return $item->date_format;
            })
            ->editColumn('updated_at', function ($item) {
                return $item->formatDate('updated_at');
            })
            ->addColumn('action', function ($item) {
                return view('components.buttons.edit', ['route' => route('posts.edit', ['post' => $item])])
                    . ' ' .
                    view('components.buttons.datatables.delete', ['route' => route('posts.delete', ['post' => $item]), 'key' => $item->hash]);
            })
            ->setRowId(function ($item) {
                return 'row-id-' . $item->hash;
            });
        return $data->toJson();
    }

    public function getAll()
    {
        return $this->repository->all();
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
            $this->fillContent($data, $model);
            $model->user_id = auth()->guard('web')->user()->id;
            $model->category_id = data_get($data, "category") | 0;
            $model->hash = $hashids->encode(time());
            $model->save();
            $model->hash = $hashids->encode($model->id);
            $model->save();
            $model->tags()->sync($data['tags'] ?? []);
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
            $model->category_id = data_get($data, "category") | 0;
            $model->updated_by = auth()->guard('web')->user()->id;
            $model->save();
            $model->tags()->sync($data['tags'] ?? []);
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
            $this->repository->delete($model);
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            Log::error($exception);
            DB::rollback();
            return false;
        }
    }

    public function getCount()
    {
        return $this->repository->query()->count();
    }

    public function getInactiveCount()
    {
        return $this->repository->query()->where('status', CommonStatus::Inactive)->count();
    }

    public function changeStatus($model, string $field, int $status): bool
    {
        DB::beginTransaction();
        try {
            $userID = auth()->guard('web')->user()->id;
            $data = [
                'status' => $status,
                'updated_by' => $userID,
            ];
            $result = $model->update($data);
            DB::commit();
            return !!$result;
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
            $userID = auth()->guard('web')->user()->id;
            $data = [
                $field => $sorting,
                'updated_by' => $userID,
            ];
            $result = $model->update($data);
            DB::commit();
            return !!$result;
        } catch (\Exception $exception) {
            Log::error($exception);
            DB::rollback();
            return false;
        }
    }


    /**
     * @param array $data
     * @param Post $model
     * @return void
     */
    public function fillContent(array $data, Post $model): void
    {
        $readingTime = 0;
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
            $content = data_get($data, "$langKey.content");
            $model->setTranslation('content', $langKey, $content);
            $temp = $this->calculateReadingTime(strip_tags($content));
            if ($temp > $readingTime) {
                $readingTime = $temp;
            }
            $model->setTranslation('short_description', $langKey, data_get($data, "$langKey.short_description"));
            $model->setTranslation('seo_title', $langKey, data_get($data, "$langKey.seo_title"));
            $model->setTranslation('seo_description', $langKey, data_get($data, "$langKey.seo_description"));
        }

        $model->sorting = data_get($data, "sorting") | 0;

        $model->publish_date = data_get($data, "publish_date");

        $model->status = data_get($data, "status") | 0;

        $model->reading_time = $readingTime;
    }

    protected function calculateReadingTime(string $string): int
    {
        $readingSpeed = 200;
        $wordCount = str_word_count($string);
        return round($wordCount / $readingSpeed); //minute
    }
}

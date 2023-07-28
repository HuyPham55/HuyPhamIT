<?php

namespace App\Models;

use App\Observers\PostCategoryObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Translatable\HasTranslations;

/**
 * @property mixed $parent_id
 * @property int|mixed $sorting
 * @property bool|mixed $status
 */
class PostCategory extends BaseModel
{
    use HasFactory;
    use HasTranslations;

    public array $translatable = [
        'image',
        'title',
        'slug',
        'seo_title',
        'seo_description',
    ];

    public static function boot()
    {
        parent::boot();
        self::observe(PostCategoryObserver::class);
    }

    public function chidlren(): HasMany
    {
        return $this
            ->hasMany(PostCategory::class, 'parent_id')
            ->orderBy('sorting');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(PostCategory::class, 'parent_id');
    }

    public static function saveModel(self $model, Request $request)
    {
        DB::beginTransaction();
        try {
            foreach (config('lang') as $langKey => $langTitle) {
                $title = trim($request->input("$langKey.title"));
                $newSlug = simple_slug($title);
                $defaultSlug = simple_slug("");
                $inputSlug = $request->input("$langKey.slug");
                if (!empty($inputSlug) && ($inputSlug !== $defaultSlug)) {
                    $newSlug = simple_slug($inputSlug);
                }
                $model->setTranslation('image', $langKey, $request->input("$langKey.image"));
                $model->setTranslation('title', $langKey, $title);
                $model->setTranslation('slug', $langKey, !empty($newSlug) ? $newSlug : 'post-detail');
                $model->setTranslation('seo_title', $langKey, $request->input("$langKey.seo_title"));
                $model->setTranslation('seo_description', $langKey, $request->input("$langKey.seo_description"));
            }
            $model->parent_id = $request->input('parent_category', 0);
            $model->sorting = $request->input('sorting') | 0;
            $model->status = $request->boolean('status', true);
            $model->save();
            DB::commit();
            return $model;
        } catch (\Exception $exception) {
            DB::rollback();
            return $exception;
        }
    }

    public function posts(): HasMany
    {
        return $this
            ->hasMany(Post::class, 'category_id')
            ->orderBy('sorting')
            ->orderBy('id');
    }
}

<?php

namespace App\Models;

use App\Observers\PostCategoryObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Translatable\HasTranslations;

/**
 * @property mixed $parent_id
 * @property int|mixed $sorting
 * @property bool|mixed $status
 * @property mixed|string $hash
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

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();
        self::observe(PostCategoryObserver::class);
    }

    public function children(): HasMany
    {
        return $this
            ->hasMany(PostCategory::class, 'parent_id')
            ->orderBy('sorting');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(PostCategory::class, 'parent_id');
    }
    public function posts(): HasMany
    {
        return $this
            ->hasMany(Post::class, 'category_id')
            ->orderBy('sorting')
            ->orderBy('id');
    }

    public function nestedPosts(): HasManyThrough
    {
        return $this->hasManyThrough(
            Post::class,
            PostCategory::class,
            'parent_id',
            'category_id'
        );
    }
}

<?php

namespace App\Models;

use App\Enums\CommonStatus;
use App\Observers\PostObserver;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Spatie\Tags\HasTags;
use Spatie\Translatable\HasTranslations;

/**
 * @property mixed $category_id
 * @property int|mixed $sorting
 * @property bool|mixed $is_popular
 * @property bool|mixed $status
 * @property mixed $created_at
 * @property \Illuminate\Support\Carbon|mixed|null $publish_date
 * @property \Illuminate\Support\Carbon|mixed|null $date_format
 * @property mixed $updated_by
 * @property mixed $user_id
 * @property mixed $id
 * @property int|null $reading_time
 * @property string $hash
 * @property int $view_count
 * @property string $title
 * @property string $short_description
 */
class Post extends BaseModel
{
    use HasFactory;
    use HasTranslations;
    use Filterable;
    use HasTags;

    public array $translatable = [
        'image',
        'title',
        'slug',
        'content',
        'short_description',
        'seo_title',
        'seo_description',
    ];

    protected $guarded = [];

    protected $casts = [
        'publish_date' => 'datetime',
        'view_count' => 'integer',
    ];

    public static function boot()
    {
        parent::boot(); //
        self::observe(PostObserver::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(PostCategory::class, 'category_id');
    }

    public function author() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function bookmarkedByMembers()
    {
        return $this->belongsToMany(Member::class, 'bookmark_post_member')
            ->withTimestamps()
            ->withPivot([
                'bookmarked_at',
            ]); // Optional: retrieve bookmarked date
    }

    public function getDateFormatAttribute()
    {
        return $this->created_at ? date_format($this->created_at, 'Y-m-d') : null;
    }

    public function getPublishFormatAttribute()
    {
        return $this->publish_date ? date_format(Carbon::parse($this->publish_date), 'Y-m-d') : null;
    }

    public static function getTagClassName(): string
    {
        return Tag::class;
    }

    public function next()
    {
        return static
            ::where('id', '>', $this->id)
            ->where('status', CommonStatus::Active)
            ->orderBy('id')
            ->first();
    }

    public function previous()
    {
        return static
            ::where('id', '<', $this->id)
            ->where('status', CommonStatus::Active)
            ->orderBy('id', 'DESC')
            ->first();
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'hash';
    }
}

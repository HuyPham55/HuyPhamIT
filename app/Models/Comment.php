<?php

namespace App\Models;

use App\Observers\CommentObserver;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method Comment for ()
 * @property MorphTo $commentable
 * @property int $member_id
 * @property int|null $parent_id
 * @property Comment $parent
 * @property Collection $children
 * @property Member $author
 * @property string $path
 * @property int $depth
 */
class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    /** Disable auto increment - Laravel's Eloquent ORM attempts to cast the ULID string to an integer */
    public $incrementing = false;
    const MORPH_NAME = 'commentable';

    protected $fillable = [
        'member_id',
        'content',
        'parent_id',
        // 'path','depth' are computed automatically
    ];

    protected static function booted(): void
    {
        static::observe(CommentObserver::class);
    }

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function author()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    /**
     * @Description Scope to any commentable model instance
     * @param Model $query
     * @param Model $commentable
     * @return mixed
     */
    public function scopeFor(Model $query, Model $commentable)
    {
        return $query->where('commentable_type', $commentable->getMorphClass())
            ->where('commentable_id', $commentable->getKey());
    }
}

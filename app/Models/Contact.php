<?php

namespace App\Models;

use App\Observers\ContactObserver;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $created_at
 */
class Contact extends Model
{
    use HasFactory;
    use Filterable;

    protected $guarded = [];

    public static string $backendCacheKey = 'unread_contact_count';

    protected static function boot()
    {
        parent::boot();
        self::observe(ContactObserver::class);
    }
    public function getDateFormatAttribute()
    {
        return $this->created_at ? date_format($this->created_at, 'Y-m-d') : null;
    }

}

<?php

namespace App\Traits;

use App\Models\StaticPage;
use Illuminate\Support\Facades\Cache;

/**
 * pieces of code to be reused for front-end
 * Usually used in AppServiceProvider and Frontend controllers
 */
trait FrontendTrait
{
    protected function getStaticPage($key)
    {
        return Cache::remember($key, rand(5, 60), function () use ($key) {
            return StaticPage::firstOrCreate(['key' => $key]);
        });
    }
}

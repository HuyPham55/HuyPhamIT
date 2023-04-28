<?php

namespace App\Observers;

use App\Enums\CacheName;
use App\Models\PostCategory;
use App\Services\NestedSetService;
use Illuminate\Support\Facades\Cache;

class PostCategoryObserver
{
    /**
     * Handle the PostCategory "created" event.
     *
     * @param  \App\Models\PostCategory  $postCategory
     * @return void
     */
    public function created(PostCategory $postCategory)
    {
        //
        $this->doNestedCategories($postCategory->getTable());
        $this->forgetCache();
    }

    /**
     * Handle the PostCategory "updated" event.
     *
     * @param  \App\Models\PostCategory  $postCategory
     * @return void
     */
    public function updated(PostCategory $postCategory)
    {
        //
        $this->doNestedCategories($postCategory->getTable());
        $this->forgetCache();
    }

    /**
     * Handle the PostCategory "deleted" event.
     *
     * @param  \App\Models\PostCategory  $postCategory
     * @return void
     */
    public function deleted(PostCategory $postCategory)
    {
        //
        $this->doNestedCategories($postCategory->getTable());
        $this->forgetCache();
    }

    /**
     * Handle the PostCategory "restored" event.
     *
     * @param  \App\Models\PostCategory  $postCategory
     * @return void
     */
    public function restored(PostCategory $postCategory)
    {
        //
    }

    /**
     * Handle the PostCategory "force deleted" event.
     *
     * @param  \App\Models\PostCategory  $postCategory
     * @return void
     */
    public function forceDeleted(PostCategory $postCategory)
    {
        //
    }
    private function forgetCache(): void
    {

    }

    private function doNestedCategories($tableName)
    {
        $nestedSet = new NestedSetService($tableName);
        $nestedSet->doNested();
    }
}

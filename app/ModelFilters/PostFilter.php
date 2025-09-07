<?php

namespace App\ModelFilters;

use App\Models\Post;
use App\Models\PostCategory;
use App\Services\CategoryService;
use EloquentFilter\ModelFilter;

class PostFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function keyword($keyword)
    {
        $languages = array_keys(config('lang'));
        foreach ($languages as $langKey) {
            $this->orWhere("title->{$langKey}", 'LIKE', "%$keyword%");
        }
        return $this;
    }

    public function status($status)
    {
        return $this->where('status', $status);
    }

    public function categories($id)
    {
        $category = PostCategory::findOrfail($id);
        $array_children = (new CategoryService($category))->getArrayChildrenId($category->lft, $category->rgt);
        return $this->whereIn('category_id', $array_children);
    }

    public function category($id)
    {
        return $this->where('category_id', $id);
    }

    public function tags($tags)
    {
        foreach ($tags as $tag) {
            $this->whereHas('tags', function ($query) use ($tag) {
                return $query->where('tags.id', $tag);
            });
        }
    }
}

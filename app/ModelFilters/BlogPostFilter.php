<?php

namespace App\ModelFilters;

use App\Models\BlogCategory;
use App\Services\CategoryService;
use EloquentFilter\ModelFilter;

class BlogPostFilter extends ModelFilter
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

    public function categories($id) {
        $category = BlogCategory::findOrfail($id);
        $array_children = (new CategoryService($category))->getArrayChildrenId($category->lft, $category->rgt);
        return $this->whereIn('category_id', $array_children);
    }

    public function category($id) {
        return $this->where('category_id', $id);
    }
}

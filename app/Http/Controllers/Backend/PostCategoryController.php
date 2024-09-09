<?php

namespace App\Http\Controllers\Backend;

use App\Models\PostCategory;
use App\Services\CategoryService;
use App\Services\NestedSetService;
use App\Traits\BackendTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostCategoryController extends BaseController
{
    //
    use BackendTrait;

    private CategoryService $categoryService;

    public function __construct(
        protected PostCategory $model,
        protected string       $routeList = 'post_categories.list',
        protected string       $pathView = 'admin.posts.categories',
    )
    {
        parent::__construct();
        $this->categoryService = new CategoryService(new PostCategory());
    }

    public function index()
    {
        session(['url.intended' => url()->full()]);
        $categories = $this->model
            ->withCount('posts')
            ->orderBy('sorting')
            ->orderBy('id')
            ->get();
        $total_count = $this->model->count();
        $categories = $this->categoryService->nestedMenu($categories);
        return view("{$this->pathView}.list", compact('categories', 'total_count'));
    }

    public function getAdd()
    {
        $category = $this->model;
        $categories = $this->categoryService->dropdown(trans('label.root_category'));

        return view("{$this->pathView}.add", compact('categories', 'category'));
    }

    public function getEdit(int $id)
    {
        $category = $this->model->findOrFail($id);
        $categories = $this->categoryService->dropdown(trans('label.root_category'), $id);

        return view("{$this->pathView}.edit", compact('category', 'categories'));
    }

    public function delete(Request $request)
    {
        $id = $request->post('item_id');
        DB::beginTransaction();
        try {
            $category = $this->model->findOrFail($id);
            $subCategories = $this->categoryService->getArrayChildrenId($category->lft, $category->rgt);

            //delete all categories where id in $subCategories
            foreach ($this->model->whereIn('id', $subCategories)->get() as $category) {
                $category->delete();
            }

            //delete translations

            //Nested model again
            $nestedSetService = new NestedSetService($this->model->getTable());
            $nestedSetService->doNested();

            // delete all posts where category_id in $subCategories

            DB::commit();

            return response()->json([
                'status' => 'success',
                'title' => trans('label.deleted'),
                'message' => trans('label.notification.success')
            ]);
        } catch (\Exception $exception) {
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'title' => trans('label.error'),
                'message' => trans('label.something_went_wrong')
            ]);
        }
    }
}

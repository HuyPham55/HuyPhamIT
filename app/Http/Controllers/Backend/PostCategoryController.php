<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
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
    private string $pathView;
    protected string $routeList;
    protected PostCategory $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new PostCategory();
        $this->categoryService = new CategoryService(new PostCategory());
        $this->routeList = 'post_categories.list';
        $this->pathView = 'admin.posts.categories';
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

            /*
             * Nested model again - not necessary because it's done in PostCategoryObserver
             */
            //$nestedSetService = new NestedSetService($this->model->getTable());
            //$nestedSetService->doNested();

            DB::commit();

            return $this->success(trans('label.deleted'));
        } catch (\Exception $exception) {
            DB::rollback();
            return $this->error();
        }
    }
}

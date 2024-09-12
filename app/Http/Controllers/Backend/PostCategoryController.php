<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\Services\PostCategoryServiceInterface;
use App\Models\PostCategory;
use App\Services\CategoryService;
use App\Traits\HttpBackendResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PostCategoryController extends BaseController
{
    //
    use HttpBackendResponses;

    protected CategoryService $categoryService;

    public function __construct(
        protected PostCategoryServiceInterface $service,
        protected PostCategory                 $model,
        protected string                       $routeList = 'post_categories.list',
        protected string                       $pathView = 'admin.posts.categories',
    )
    {
        parent::__construct();
        $this->categoryService = new CategoryService(new PostCategory());
    }

    public function index()
    {
        session(['url.intended' => url()->full()]);
        $categories = $this->service->getAll();
        $total_count = $this->service->getCount();
        $categories = $this->categoryService->nestedMenu($categories);
        return view("{$this->pathView}.list", compact('categories', 'total_count'));
    }

    public function getAdd()
    {
        $category = $this->model;
        $categories = $this->categoryService->dropdown(trans('label.root_category'));
        return view("{$this->pathView}.add", compact('categories', 'category'));
    }

    public function postAdd(Request $request): RedirectResponse
    {
        $begin = microtime(true);
        $result = $this->service->create($request->all());
        $duration = microtime(true) - $begin;
        $ms = round($duration * 1000, 1);
        if ($result) {
            $this->forgetCache();
            return redirect()->route($this->routeList)->with([
                'status' => 'success',
                'flash_message' => trans('label.notification.success') . " ({$ms}ms)"
            ]);
        }
        return redirect()
            ->back()
            ->withInput()
            ->with([
                'status' => 'danger',
                'flash_message' => trans('label.something_went_wrong')
            ]);
    }

    public function getEdit(int $id)
    {
        $category = $this->service->getByID($id);
        $categories = $this->categoryService->dropdown(trans('label.root_category'), $id);
        return view("{$this->pathView}.edit", compact('category', 'categories'));
    }

    public function putEdit(Request $request, int $id): RedirectResponse
    {
        $begin = microtime(true);
        $model = $this->service->getByID($id);
        $result = $this->service->update($model, $request->all());
        $duration = microtime(true) - $begin;
        $ms = round($duration * 1000, 1);
        if ($result) {
            $this->forgetCache();
            return redirect()->route($this->routeList)->with([
                'status' => 'success',
                'flash_message' => trans('label.notification.success') . " ({$ms}ms)"
            ]);
        }
        return redirect()
            ->back()
            ->withInput()
            ->with([
                'status' => 'danger',
                'flash_message' => trans('label.something_went_wrong')
            ]);
    }

    public function changeStatus(Request $request): JsonResponse
    {
        $this->validate($request, [
            'field' => 'required|in:status',
            'status' => 'required|integer|in:0,1',
        ]);

        $field = $request->post('field');
        $itemId = $request->post('item_id');
        $status = $request->post('status');

        $model = $this->service->getByID($itemId);
        $result = $this->service->changeStatus($model, $field, $status);
        if ($result) {
            $this->forgetCache();
            return $this->success();
        }
        return $this->error();
    }

    public function changeSorting(Request $request): JsonResponse
    {
        $this->validate($request, [
            'item_id' => 'required|integer',
            'sorting' => 'required|integer|min:0|integer',
        ]);
        $itemId = $request->post('item_id');
        $model = $this->service->getByID($itemId);
        $result = $this->service->changeSorting(model: $model, sorting: $request->integer('sorting'));
        if ($result) {
            $this->forgetCache();
            return $this->success();
        }
        return $this->error();
    }

    public function delete(Request $request)
    {
        $id = $request->post('item_id');
        $category = $this->service->getByID($id);
        $result = $this->service->delete($category);
        return $result
            ? $this->success(trans('label.deleted'))
            : $this->error(trans('label.something_went_wrong'));
    }

    private function forgetCache()
    {
    }
}

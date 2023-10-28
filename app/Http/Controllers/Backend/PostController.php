<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PostCategory;
use App\Models\Post;
use App\Services\CategoryService;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PostController extends BaseController
{
    //
    private Post $model;
    private string $routeList;
    private string $pathView;
    private string $cacheName;

    public function __construct()
    {
        parent::__construct();

        $this->model = new Post();
        $this->routeList = 'posts.list';
        $this->pathView = 'admin.posts.posts';
        $this->cacheName = '';
    }

    public function index()
    {
        session(['url.intended' => url()->full()]);

        $categories = (new CategoryService(new PostCategory()))->dropdown();
        $total_count = $this->model->count();

        return view("{$this->pathView}.list", compact('categories', 'total_count'));
    }

    public function datatables(Request $request)
    {
        $posts = $this->model
            ->filter(request()->all());
        $data = DataTables::eloquent($posts)
            ->editColumn('image', function ($item) {
                return either($item->image, '/images/no-image.png');
            })
            ->editColumn('title', function ($item) {
                return $item->dynamic_title;
            })
            ->editColumn('status', function ($item) {
                return view('components.buttons.bootstrapSwitch', [
                    'data' => $item,
                    'permission' => 'edit_posts',
                ]);
            })
            ->editColumn('created_at', function ($item) {
                return $item->date_format;
            })
            ->editColumn('updated_at', function ($item) {
                return $item->formatDate('updated_at');
            })
            ->addColumn('action', function ($item) {
                return view('components.buttons.edit', ['route' => route('posts.edit', ['id' => $item->id])])
                    . ' ' .
                    view('components.buttons.delete', ['route' => route('posts.delete'), 'id' => $item->id]);
            })
            ->setRowId(function ($item) {
                return 'row-id-' . $item->id;
            });
        return $data->toJson();
    }


    public function getAdd()
    {
        $post = $this->model;
        $categories = (new CategoryService(new PostCategory()))->dropdown();
        return view("{$this->pathView}.add", compact('post', 'categories'));
    }

    public function postAdd(Request $request)
    {
        $begin = microtime(true);
        $flag = $this->model::saveModel($this->model, $request);
        $duration = microtime(true) - $begin;
        $ms = round($duration * 1000, 1);
        if ($flag instanceof \Exception) {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'status' => 'danger',
                    'flash_message' => env("APP_DEBUG") ? $flag->getMessage() : trans('label.something_went_wrong')
                ]);
        }
        $this->forgetCache();
        return redirect()->route($this->routeList)->with([
            'status' => 'success',
            'flash_message' => trans('label.notification.success')." ({$ms}ms)"
        ]);
    }

    public function getEdit(int $id)
    {
        $post = $this->model::with(['author', 'updater'])->findOrFail($id);
        $categories = (new CategoryService(new PostCategory()))->dropdown();

        return view("{$this->pathView}.edit", compact('post', 'categories'));
    }

    public function putEdit(Request $request, int $id)
    {
        $begin = microtime(true);
        $post = $this->model::findOrFail($id);
        $flag = $this->model::saveModel($post, $request);
        $duration = microtime(true) - $begin;
        $ms = round($duration * 1000, 1);  if ($flag instanceof \Exception) {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                'status' => 'danger',
                'flash_message' => env("APP_DEBUG") ? $flag->getMessage() : trans('label.something_went_wrong')
            ]);
        }
        $this->forgetCache();
        return redirect()->intended(route($this->routeList))->with([
            'status' => 'success',
            'flash_message' => trans('label.notification.success')." ({$ms}ms)"
        ]);
    }

    public function delete(Request $request)
    {
        $post = $this->model::findOrFail($request->post('item_id'));
        $flag = $post->delete();
        if ($flag) {
            $this->forgetCache();
            return response()->json([
                'status' => 'success',
                'title' => trans('label.deleted'),
                'message' => trans('label.notification.success')
            ]);
        }

        return response()->json([
            'status' => 'error',
            'title' => trans('label.error'),
            'message' => trans('label.something_went_wrong')
        ]);
    }

    public function changeStatus(Request $request)
    {
        $this->validate($request, [
            'field' => 'required|in:status',
            'item_id' => 'required|integer',
            'status' => 'required|integer',
        ]);

        $field = $request->post('field');
        $itemId = $request->post('item_id');
        $status = $request->post('status');

        if (in_array($status, [0, 1])) {
            $model = $this->model->findOrFail($itemId);
            $model->{$field} = $status;
            $model->save();
            $this->forgetCache();

            return response()->json([
                'status' => 'success',
                'message' => __('label.notification.success')
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => trans('label.something_went_wrong')
        ]);
    }

    public function changePopular(Request $request)
    {
        $this->validate($request, [
            'field' => 'required|in:is_popular',
            'item_id' => 'required|integer',
            'is_popular' => 'required|integer',
        ]);

        $field = $request->post('field');
        $itemId = $request->post('item_id');
        $is_popular = $request->post('is_popular');

        if (in_array($is_popular, [0, 1])) {
            $model = $this->model->findOrFail($itemId);
            $model->{$field} = $is_popular;
            $model->save();
            $this->forgetCache();

            return response()->json([
                'status' => 'success',
                'message' => __('label.notification.success')
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => trans('label.something_went_wrong')
        ]);
    }

    public function changeSorting(Request $request)
    {
        $this->validate($request, [
            'item_id' => 'required|integer',
            'sorting' => 'required|integer',
        ]);

        try {
            $model = $this->model->findOrFail($request->item_id);
            $model->sorting = $request->sorting;
            $model->save();
            $this->forgetCache();

            return response()->json([
                'status' => 'success',
                'message' => __('label.notification.success')
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => 'error',
                'message' => trans('label.something_went_wrong')
            ]);
        }
    }

    private function forgetCache(): void
    {
        Cache::forget($this->cacheName);
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\Services\PostServiceInterface;
use App\Contracts\Services\TagServiceInterface;
use App\Models\Post;
use App\Models\PostCategory;
use App\Services\CategoryService;
use App\Services\TagService;
use App\Traits\HttpBackendResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class PostController extends BaseController
{
    //
    use HttpBackendResponses;

    protected string $cacheName;

    public function __construct(
        protected PostServiceInterface $service,
        protected TagServiceInterface  $tagService,
        protected Post                 $model,
        protected string               $routeList = 'posts.list',
        protected string               $pathView = 'admin.posts.posts',
    )
    {
        parent::__construct();
        $this->cacheName = '';
    }

    public function index()
    {
        session(['url.intended' => url()->full()]);
        $categories = (new CategoryService(new PostCategory()))->dropdown();
        $total_count = $this->service->getCount();
        if (!session()->has('flash_message') && $inactiveCount = $this->service->getInactiveCount()) {
            session()->flash('flash_message', $inactiveCount . " inactive items(s)");
            session()->flash('status', 'warning');
        }
        $tags = $this->tagService->getAll();
        return view("{$this->pathView}.list", compact('categories', 'tags', 'total_count'));
    }

    public function datatables(Request $request)
    {
        return $this->service->datatables($request->all());
    }

    public function getAdd(TagService $tagService)
    {
        $post = $this->model;
        $categories = (new CategoryService(new PostCategory()))->dropdown();
        $tags = $this->tagService->getAll();
        return view("{$this->pathView}.add", compact('post', 'categories', 'tags'));
    }

    public function postAdd(Request $request): RedirectResponse
    {
        $begin = microtime(true);
        try {
            $result = $this->service->create($request->all());
            $duration = microtime(true) - $begin;
            $ms = round($duration * 1000, 1);
            $this->forgetCache();
            if ($result) {
                return redirect()->route($this->routeList)->with([
                    'status' => 'success',
                    'flash_message' => trans('label.notification.success') . " ({$ms}ms)"
                ]);
            }
            throw new \Exception("Failed to create");
        } catch (\Exception $exception) {
            Log::error($exception);
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'status' => 'danger',
                    'flash_message' => trans('label.something_went_wrong')
                ]);
        }
    }

    public function getEdit(Request $request, Post $post, TagService $tagService)
    {
        $categories = (new CategoryService(new PostCategory()))->dropdown();
        $tags = $this->tagService->getAll();
        return view("{$this->pathView}.edit", compact('post', 'categories', 'tags'));
    }

    public function putEdit(Request $request, Post $post): RedirectResponse
    {
        $begin = microtime(true);
        try {
            $model = $this->service->update($post, $request->all());
            $duration = microtime(true) - $begin;
            $ms = round($duration * 1000, 1);
            if ($model) {
                $this->forgetCache();
                return redirect()->intended(route($this->routeList))->with([
                    'status' => 'success',
                    'flash_message' => trans('label.notification.success') . " ({$ms}ms)"
                ]);
            }
            throw new \Exception("Failed to update");
        } catch (\Exception $exception) {
            Log::error($exception);
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'status' => 'danger',
                    'flash_message' => trans('label.something_went_wrong')
                ]);
        }
    }

    public function publish(Request $request, Post $post)
    {
        try {
            $this->service->publish($post);
            return $this->success();
        } catch (\Exception $exception) {
            Log::error($exception);
            return $this->error($exception->getMessage());
        }
    }

    public function changeStatus(Request $request, Post $post = null): JsonResponse
    {
        $this->validate($request, [
            'field' => 'required|in:status',
            'status' => 'required|integer|in:0,1',
        ]);

        $field = $request->post('field');
        //$itemId = $request->post('item_id');
        $status = $request->post('status');
        try {
            $result = $this->service->changeStatus($post, $field, $status);
            if ($result) {
                $this->forgetCache();
                return $this->success();
            }
            throw new \Exception("Failed to change status");
        } catch (\Exception $exception) {
            Log::error($exception);
            return $this->error();
        }
    }

    public function changeSorting(Request $request, Post $post = null): JsonResponse
    {
        $this->validate($request, [
            //'item_id' => 'required|integer',
            'sorting' => 'required|integer|min:0|integer',
        ]);
        try {
            $result = $this->service->changeSorting(model: $post, sorting: $request->integer('sorting'));
            if ($result) {
                $this->forgetCache();
                return $this->success();
            }
        } catch (\Exception $exception) {
            Log::error($exception);
            return $this->error();
        }
    }

    public function delete(Request $request, Post $post)
    {
        try {
            $result = $this->service->delete($post);
            if ($result)
                return $this->success(trans('label.deleted'));
            throw new \Exception("Failed to delete");
        } catch (\Exception $exception) {
            Log::error($exception);
            return $this->error(trans('label.something_went_wrong'));
        }
    }

    protected function forgetCache(): void
    {
        Cache::forget($this->cacheName);
    }

    public function updateStaticPage(Request $request)
    {
        try {
            $multiLangKeys = [
                'post_add_template',
            ];
            foreach (config('lang') as $langKey => $langTitle) {
                foreach ($multiLangKeys as $optionKey) {
                    $key = $optionKey . "_" . $langKey;
                    option([$key => $request->input($key)]);
                }
            }
            return redirect()->back()->with(['status' => 'success', 'flash_message' => trans('label.notification.success')]);
        } catch (\Exception $exception) {
            Log::error($exception);
            return redirect()->back()->with([
                'status' => 'danger',
                'flash_message' => trans('label.something_went_wrong')
            ]);
        }
    }
}

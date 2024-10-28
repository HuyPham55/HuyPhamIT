<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\Services\TagServiceInterface;
use App\Http\Requests\TagAddRequest;
use App\Http\Requests\TagEditRequest;
use App\Models\Tag;
use App\Traits\HttpBackendResponses;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TagController extends BaseController
{
    use HttpBackendResponses;
    public function __construct(
        protected TagServiceInterface $service,
        protected Tag                 $model,
        protected string              $routeList = 'tags.list',
        protected string              $pathView = 'admin.tags',
    )
    {
        parent::__construct();
    }

    public function index() {
        $total_count = $this->service->getCount();
        return view("{$this->pathView}.list", compact( 'total_count'));
    }

    public function datatables(Request $request)
    {
        return $this->service->datatables($request->all());
    }

    public function getAdd()
    {
        $model = $this->model;
        return view("{$this->pathView}.add", compact('model'));
    }

    public function postAdd(TagAddRequest $request): RedirectResponse
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

    public function getEdit(Request $request, Tag $tag)
    {
        return view("{$this->pathView}.edit", ['model' => $tag]);
    }

    public function putEdit(TagEditRequest $request, Tag $tag): RedirectResponse
    {
        $begin = microtime(true);
        $result = $this->service->update($tag, $request->all());
        $duration = microtime(true) - $begin;
        $ms = round($duration * 1000, 1);
        if ($result) {
            $this->forgetCache();
            return redirect()->intended(route($this->routeList))->with([
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

    public function delete(Request $request, Tag $model)
    {
        $result = $this->service->delete($model);
        return $result
            ? $this->success(trans('label.deleted'))
            : $this->error(trans('label.something_went_wrong'));
    }

    private function forgetCache()
    {
    }

}

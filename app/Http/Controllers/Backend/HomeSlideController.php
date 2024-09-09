<?php

namespace App\Http\Controllers\Backend;

use App\Models\Slide;
use App\Traits\BackendTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeSlideController extends BaseController
{
    //
    use BackendTrait;
    const CACHE_NAME = '';
    public function __construct(
        protected Slide  $model,
        protected string $routeList = 'home_slides.list',
        protected string $pathView = 'admin.home_slides',
        protected string $key = 'HOME',
    )
    {
        parent::__construct();
    }

    public function index()
    {
        session(['url.intended' => url()->full()]);
        $data = $this->model
            ->where('key', $this->key)
            ->orderBy('sorting')
            ->orderBy('id')
            ->paginate();

        return view("{$this->pathView}.list", compact('data'));
    }

    public function getAdd()
    {
        return view("{$this->pathView}.add", ['slide' => $this->model]);
    }

    public function postAdd(Request $request)
    {
        $flag = $this->model->saveModel($this->model, $this->key, $request);
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
        return redirect()->route($this->routeList)->with(['status' => 'success', 'flash_message' => trans('label.notification.success')]);
    }

    public function getEdit(int $id)
    {
        $slide = $this->model->findOrFail($id);

        return view("{$this->pathView}.edit", compact('slide'));
    }

    public function putEdit(Request $request, int $id)
    {
        $model = $this->model->findOrFail($id);
        $flag = $this->model->saveModel($model, $this->key, $request);
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
        return redirect()->intended(route($this->routeList))->with(['status' => 'success', 'flash_message' => trans('label.notification.success')]);
    }

    protected function forgetCache()
    {
        Cache::forget(self::CACHE_NAME);
    }
}

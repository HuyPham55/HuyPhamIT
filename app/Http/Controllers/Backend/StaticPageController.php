<?php

namespace App\Http\Controllers\Backend;

use App\Models\StaticPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class StaticPageController extends BaseController
{
    //
    private StaticPage $model;

    public function __construct()
    {
        parent::__construct();

        $this->model = new StaticPage();
    }

    public function getEdit($key = '')
    {
        $page = StaticPage::firstOrCreate(['key' => $key]);
        return view('admin.static_pages.edit', compact('page'));
    }

    public function getEditSeoPage($key = '')
    {
        $page = StaticPage::firstOrCreate(['key' => $key]);
        return view('admin.static_pages.edit_seo_page', compact('page'));
    }

    public function putEdit(Request $request, $key)
    {
        $page = StaticPage::firstOrCreate(['key' => $key]);
        $flag = $this->model->saveModel($page, $request);
        if ($flag) {
            $this->forgetCache($key);
            return redirect()->back()->with(['status' => 'success', 'flash_message' => trans('label.notification.success')]);
        }
        return redirect()->back()->with([
            'status' => 'danger',
            'flash_message' => trans('label.something_went_wrong')
        ]);
    }

    private function forgetCache($key)
    {
        if ($key) {
            Cache::forget($key);
        }
    }


}

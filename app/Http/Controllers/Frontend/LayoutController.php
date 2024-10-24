<?php

namespace App\Http\Controllers\Frontend;

use App\Traits\HttpResponses;

class LayoutController extends BaseController
{
    //
    use HttpResponses;
    public function index() {
        $locale = app()->getLocale();
        return $this->success([
            'app_name' => config('app.name'),
            'logo' => cachedOption('site_logo'),
            'site_seo_image' => cachedOption('site_seo_image'),
            'site_title' => cachedOption('site_title_' . $locale),
            'site_seo_title' => cachedOption('site_seo_title_' . $locale),
            'site_description' => cachedOption('site_description_' . $locale),
        ]);
    }
}

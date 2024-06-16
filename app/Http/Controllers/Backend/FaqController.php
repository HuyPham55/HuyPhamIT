<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends BaseController
{
    //
    protected string $pathView;
    protected string $routeList;
    protected Faq $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new Faq();
        $this->routeList = 'faqs.list';
        $this->pathView = 'admin.faqs';
    }

    public function index(Request $request)
    {
        session(['url.intended' => url()->full()]);
        $posts = $this->model
            ::filter($request->all())
            ->orderBy('sorting')
            ->orderBy('id')
            ->paginate();

        return view("{$this->pathView}.list", compact('posts'));
    }

    public function getAdd()
    {
        return view("{$this->pathView}.add", ['post' => $this->model]);
    }

    public function getEdit(int $id)
    {
        $post = $this->model::findOrFail($id);

        return view("{$this->pathView}.edit", ['post' => $post]);
    }
}

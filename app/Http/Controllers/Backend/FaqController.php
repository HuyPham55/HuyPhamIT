<?php

namespace App\Http\Controllers\Backend;

use App\Models\Faq;
use App\Traits\BackendTrait;
use Illuminate\Http\Request;

class FaqController extends BaseController
{
    //
    use BackendTrait;

    public function __construct(
        protected Faq    $model,
        protected string $routeList = 'faqs.list',
        protected string $pathView = 'admin.faqs',
    )
    {
        parent::__construct();
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

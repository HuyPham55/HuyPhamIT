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
    protected Post $model;
    protected string $routeList;
    protected string $pathView;
    protected string $cacheName;

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
        if (!session()->has('flash_message')) {
            $inactiveCount = $this->model->where('status', 0)->count();
            if ($inactiveCount) {
                session()->flash('flash_message', $inactiveCount . " inactive items(s)");
                session()->flash('status', 'warning');
            }
        }
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

    public function getEdit(int $id)
    {
        $post = $this->model::with(['author', 'updater'])->findOrFail($id);
        $categories = (new CategoryService(new PostCategory()))->dropdown();

        return view("{$this->pathView}.edit", compact('post', 'categories'));
    }

    protected function forgetCache(): void
    {
        Cache::forget($this->cacheName);
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\MemberAddRequest;
use App\Http\Requests\MemberEditRequest;
use App\Models\Member;
use App\Traits\BackendTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class MemberController extends BaseController
{
    //
    use BackendTrait;
    protected Member $model;
    protected string $routeList;
    protected string $pathView;

    public function __construct()
    {
        parent::__construct();
        $this->model = new Member();
        $this->pathView = 'admin.members';
        $this->routeList = 'members.list';
        $genders = [
            '1' => __("label.gender.male"),
            '0' => __("label.gender.female"),
        ];
        View::share([
            'genders' => $genders
        ]);

    }

    public function index(Request $request)
    {
        $data = $this->model
            ->filter($request->all())
            ->orderby('created_at', 'DESC')
            ->orderBy('id')
            ->paginate();
        return view("{$this->pathView}.list", compact('data'));
    }

    public function getAdd()
    {
        $member = $this->model;
        return view("{$this->pathView}.add", compact('member'));
    }

    public function postAdd(MemberAddRequest $request)
    {
        $flag = $this->model->saveModel($this->model, $request);
        if ($flag instanceof \Exception) {
            return redirect()->back()->with([
                'status' => 'danger',
                'flash_message' => env("APP_DEBUG") ? $flag->getMessage() : trans('label.something_went_wrong')
            ]);
        }
        return redirect()->route($this->routeList)->with(['status' => 'success', 'flash_message' => trans('label.notification.success')]);
    }

    public function getEdit($id)
    {
        $member = $this->model->findOrFail($id);
        return view("{$this->pathView}.edit", compact('member'));
    }

    public function putEdit(MemberEditRequest $request, int $id = 0)
    {
        $model = $this->model->findOrFail($id);
        $flag = $this->model::saveModel($model, $request);

        if ($flag instanceof \Exception) {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                'status' => 'danger',
                'flash_message' => env("APP_DEBUG") ? $flag->getMessage() : trans('label.something_went_wrong')
            ]);
        }
        return redirect()->intended(route($this->routeList))->with(['status' => 'success', 'flash_message' => trans('label.notification.success')]);
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PermissionGroup;
use Illuminate\Http\Request;

class PermissionGroupController extends BaseController
{
    //
    private string $pathView;
    public string $routeList;
    private PermissionGroup $groupModel;

    public function __construct()
    {
        parent::__construct();
        $this->pathView = 'admin.permission_groups';
        $this->routeList = 'permission_groups.list';
        $this->groupModel = new PermissionGroup();
    }

    public function getList()
    {
        $data = PermissionGroup::orderBy('name')->get();

        return view("{$this->pathView}.list", compact('data'));
    }


    public function getAdd()
    {
        $data = $this->groupModel;
        return view("{$this->pathView}.add", compact('data'));
    }

    public function postAdd(Request $request)
    {
        $this->__validate($request);
        $this->validate($request, [
            'name' => 'required|string|unique:permission_groups,name'
        ]);
        $this->groupModel->saveModel($this->groupModel, $request);

        return redirect()->route($this->routeList)
            ->with(['status' => 'success', 'flash_message' => trans('label.notification.success')]);
    }

    public function getEdit($id)
    {
        $data = PermissionGroup::findOrFail($id);

        return view("{$this->pathView}.edit", compact('data'));
    }

    public function putEdit(Request $request, $id)
    {
        $this->__validate($request);

        $group = PermissionGroup::findOrFail($id);

        $this->groupModel->saveModel($group, $request);

        return redirect()->route($this->routeList)
            ->with(['status' => 'success', 'flash_message' => trans('label.notification.success')]);
    }

    public function __validate($request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
    }

    public function delete(Request $request)
    {
        $id = $request->post('item_id');

        $group = $this->groupModel->findOrFail($id);
        $flag = $group->delete();
        if ($flag) {
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
}

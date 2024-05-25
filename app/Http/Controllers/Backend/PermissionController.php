<?php

namespace App\Http\Controllers\Backend;

use App\Models\PermissionGroup;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends BaseController
{
    //
    private $roles;
    private Permission $permissionModel;
    private PermissionGroup $groupModel;
    private string $pathView;
    public string $routeList;

    public function __construct()
    {
        parent::__construct();

        $this->groupModel = new PermissionGroup();
        $this->permissionModel = new Permission();
        $this->pathView = 'admin.permissions';
        $this->routeList = 'permissions.list';


        $this->roles = Role::where('name', '<>', 'Admin')->get();
    }

    public function getList()
    {
        $data = $this->groupModel
            ->where('status', true)
            ->with(['permissions' => function ($query) {
                return $query->where('status', true);
            }])
            ->orderBy('name')->get();
        return view("{$this->pathView}.list", compact('data'));
    }

    public function getAdd()
    {

        $permissionGroups = $this->groupModel->get();
        $roles = $this->roles;
        $data = $this->permissionModel;
        return view("{$this->pathView}.add", compact('data', 'permissionGroups', 'roles'));
    }

    public function postAdd(Request $request)
    {
        //Not possible due to getAvailablePermissions
        $this->__validate($request);

        $name = $request->input('name');
        $exist = $this->checkExist($name);
        if ($exist) {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'status' => 'danger',
                    'flash_message' => trans('label.something_went_wrong')
                ]);
        }
        Permission::create([
            'name' => $name,
            'title' => $request->input('title'),
            'permission_group_id' => $request->integer('group'),
        ]);
        return redirect()->route($this->routeList)->with(['status' => 'success', 'flash_message' => trans('label.notification.success')]);
    }

    public function getEdit($id)
    {
        $permissionGroups = $this->groupModel->get();
        $data = $this->permissionModel->findOrFail($id);
        $roles = $this->roles;

        return view("{$this->pathView}.edit", compact('permissionGroups', 'data', 'roles'));
    }

    public function putEdit(Request $request, $id)
    {
        $this->__validate($request);

        $name = $request->input('name');
        $permission = $this->permissionModel->findOrFail($id);
        $exist = $this->checkExist($name);
        if ($permission->name !== $name && $exist) {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'status' => 'danger',
                    'flash_message' => trans('label.something_went_wrong')
                ]);
        }

        $permission->name = $name;
        $permission->title = $request->input('title');
        $permission->permission_group_id = $request->input('group');
        $permission->save();

        //sync permission to roles
        //$roles = $request->post('roles');
        //if (is_array($roles)) {
        //    $permission->syncRoles($roles);
        //}

        return redirect()->route($this->routeList)->with(['status' => 'success', 'flash_message' => trans('label.notification.success')]);
    }

    public function delete(Request $request)
    {
        $id = $request->post('item_id');

        $permission = Permission::findOrFail($id);

        $permission->roles()->detach();

        $flag = $permission->delete();

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

    public function __validate($request)
    {
        $this->validate($request, [
            'name' => 'nullable|required',
            'title' => 'required',
            'group' => 'required',
        ]);
    }

    /**
     * @param mixed $name
     * @return mixed
     */
    public function checkExist(mixed $name)
    {
        return $this->permissionModel->where([
            ['name', '=', $name],
            ['guard_name', '=', 'web'],
        ])->first();
    }
}

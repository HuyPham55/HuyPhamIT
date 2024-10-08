<?php

namespace App\Http\Controllers\Backend;

use App\Enums\RoleEnum;
use App\Models\PermissionGroup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleController extends BaseController
{
    //
    public function index()
    {
        $data = Role::orderBy('name')->get();
        return view('admin.role.list', compact('data'));
    }

    public function getAdd()
    {
        $data = new Role();
        $permissionGroups = $this->getPermissionGroups();
        return view('admin.role.add', compact('permissionGroups', 'data'));
    }

    public function postAdd(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $roleName = $request->input('name');

        if ($this->isExistRole($roleName, 'web')) {
            return redirect()->back()->withInput()->with(['status' => 'danger', 'flash_message' => trans('label.something_went_wrong')]);
        }

        DB::transaction(function () use ($request, $roleName) {
            $role = Role::create([
                'name' => $roleName,
            ]);
            /*
             * Default guard name: web
             * Guard::getDefaultName(static::class)
             * */
            $permissions = $request->input('permissions');
            if (is_array($permissions) && count($permissions)) {
                $role->syncPermissions($permissions);
            }
        });
        return redirect()->route('roles.list')->with(['status' => 'success', 'flash_message' => trans('label.notification.success')]);
    }

    private function isExistRole(mixed $roleName, string $string): bool
    {
        return (bool)Role::where([
            ['name', $roleName],
            ['guard_name', $string],

        ])->first();
    }

    public function getEdit($id)
    {
        $data = Role::findOrFail($id);
        if ($data->name == RoleEnum::Admin) {
            return redirect()->back()->with(['status' => 'danger', 'flash_message' => trans('label.something_went_wrong')]);
        }

        $permissionGroups = $this->getPermissionGroups();
        return view('admin.role.edit', compact('data', 'permissionGroups'));
    }

    public function postEdit(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $roleName = $request->input('name');
        $role = Role::findOrFail($id);

        if ($role->name == RoleEnum::Admin) {
            return redirect()->back()->with(['status' => 'danger', 'flash_message' => trans('label.something_went_wrong')]);
        }

        if ($role->name <> $roleName && $this->isExistRole($roleName, 'web')) {
            return redirect()->back()->with(['status' => 'danger', 'flash_message' => trans('label.something_went_wrong')]);
        }

        DB::transaction(function () use ($request, $role) {
            $role->name = $request->input('name');
            $role->save();

            $permissions = $request->input('permissions');
            if (is_array($permissions) && count($permissions)) {
                $role->syncPermissions($permissions);
            }
        });
        return redirect()->route('roles.list')->with(['status' => 'success', 'flash_message' => trans('label.notification.success')]);
    }

    public function delete(Request $request)
    {
        $id = $request->post('item_id') | 0;

        $role = Role::findOrFail($id);
        //        remove Role from user
        $users = User::role($id)->get(); // Returns all users with the role = $id
        foreach ($users as $user) {
            $user->removeRole($id);
        }
        //delete role has permissions
        $role->syncPermissions([]);
        //delete role
        $flag = $role->delete();
        if ($flag) {
            return response()->json([
                'status' => 'success',
                'title' => trans('label.deleted'),
                'message' => trans('label.notification.success'),
                'reload' => true
            ]);
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getPermissionGroups(): array|\Illuminate\Database\Eloquent\Collection
    {
        return PermissionGroup::with(['permissions' => function ($query) {
            $query->where('status', true)
                ->orderBy('sorting')
                ->get();
        }])
            ->where('status', true)
            ->orderBy('sorting')
            ->orderBy('name')
            ->get();
    }
}

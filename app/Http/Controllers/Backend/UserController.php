<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\Services\UserServiceInterface;
use App\Http\Requests\User\UserAddRequest;
use App\Http\Requests\User\UserEditProfileRequest;
use App\Http\Requests\User\UserEditRequest;
use App\Http\Requests\UserChangePasswordRequest;
use App\Models\User;
use App\Traits\BackendTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends BaseController
{
    //
    use BackendTrait;

    public function __construct(
        protected UserServiceInterface $service,
        protected User                 $model,
        protected string               $routeList = 'users.list',
        protected string               $pathView = 'admin.user',
    )
    {
        parent::__construct();
    }

    public function getList(Request $request)
    {
        $data = User::orderBy('created_at', 'DESC')
            ->filter($request->only(['keyword', 'status']))
            ->paginate();
        return view('admin.user.list', compact('data'));
    }

    public function getAdd()
    {
        $roles = Role::orderBy('name')->get();
        $data = $this->model;
        return view('admin.user.add', compact('roles', 'data'));
    }

    public function postAdd(UserAddRequest $request)
    {
        $result = $this->service->create($request->validated());

        if ($result) {
            $this->forgetCache();
            if ($request->wantsJson()) {
                return $this->success($result);
            }
            return redirect()->route($this->routeList)->with([
                'status' => 'success',
                'flash_message' => trans('label.notification.success')
            ]);
        }
        return redirect()
            ->back()
            ->withInput()
            ->with([
                'status' => 'danger',
                'flash_message' => trans('label.something_went_wrong')
            ]);
    }

    public function getEdit(Request $request, User $user)
    {
        $roles = Role::orderBy('name')->get();
        return view('admin.user.edit', array_merge(compact('roles'), [
            'data' => $user
        ]));
    }

    public function postEdit(UserEditRequest $request, User $user)
    {
        if ($user->id === Auth::id()) {
            return redirect()->back()->with(['status' => 'danger', 'flash_message' => trans('label.something_went_wrong')]);
        }
        //Update data
        if (!empty($request->input('password'))) {
            $user->password = Hash::make($request->input('password'));
        }
        $result = $this->service->update($user, $request->validated());
        if ($result) {
            return redirect()->route($this->routeList)->with(['status' => 'success', 'flash_message' => trans('label.notification.success')]);
        }
        return redirect()
            ->back()
            ->withInput()
            ->with([
                'status' => 'danger',
                'flash_message' => trans('label.something_went_wrong')
            ]);
    }

    //Edit profile
    public function getEditProfile()
    {
        $data = Auth::guard('web')->user();
        return view('admin.user.edit_profile', compact('data'));
    }

    public function postEditProfile(UserEditProfileRequest $request): RedirectResponse
    {
        $user = Auth::guard('web')->user();
        $oldPassword = $request->input('old_password');

        //check password
        if (!Hash::check($oldPassword, $user->password)) {
            return redirect()->back()->with(['status' => 'danger', 'flash_message' => trans('validation.current_password')]);
        }
        $result = $this->service->updateByArray($user, $request->validated());
        if ($result) {
            return redirect()->back()->with(['status' => 'success', 'flash_message' => trans('label.notification.success')]);
        }
        return redirect()
            ->back()
            ->withInput()
            ->with([
                'status' => 'danger',
                'flash_message' => trans('label.something_went_wrong')
            ]);
    }

    public function delete(Request $request)
    {
        $user = User::findOrFail($request->post('item_id') | 0);
        if ($user->id == Auth::id()) {
            return response()->json([
                'status' => 'error',
                'title' => trans('label.error'),
                'message' => trans('label.something_went_wrong')
            ]);
        }
        $flag = $user->delete();
        if ($flag) {
            return response()->json([
                'status' => 'success',
                'title' => trans('label.deleted'),
                'message' => trans('label.notification.success'),
                'reload' => true
            ]);
        }
        return response()->json([
            'status' => 'error',
            'title' => trans('label.error'),
            'message' => trans('label.something_went_wrong')
        ]);
    }


    public function getChangePassword()
    {
        return view('admin.user.change_password');
    }

    public function postChangePassword(UserChangePasswordRequest $request): RedirectResponse
    {
        $user = Auth::guard('web')->user();
        $oldPassword = $request->input('old_password');
        //check password
        if (!Hash::check($oldPassword, $user->password)) {
            return redirect()->back()->with(['status' => 'danger', 'flash_message' => trans('validation.current_password')]);
        }
        $result = $this->service->changeUserPassword($user, $request->input('password'));
        if ($result) {
            return redirect()->back()->with(['status' => 'success', 'flash_message' => trans('label.notification.success')]);
        }
        return redirect()->back()->with(['status' => 'danger', 'flash_message' => trans('label.something_went_wrong')]);
    }

}

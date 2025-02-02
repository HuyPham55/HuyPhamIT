<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Laravel\Fortify\Actions\ConfirmTwoFactorAuthentication;
use Laravel\Fortify\Actions\EnableTwoFactorAuthentication;

class TwoFactorAuthenticationController extends BaseController
{

    /**
     * Enable two-factor authentication for the user.
     * \Laravel\Fortify\Http\Controllers\TwoFactorAuthenticationController::store
     */
    public function enable(Request $request, EnableTwoFactorAuthentication $enable)
    {
        $enable($request->user(), $request->boolean('force', false));
        return view('admin.user.2fa.setup');
    }

    /**
     * Enable two factor authentication for the user.
     * \Laravel\Fortify\Http\Controllers\ConfirmedTwoFactorAuthenticationController::store
     */
    public function confirmed(Request $request, ConfirmTwoFactorAuthentication $confirm)
    {
        $confirm($request->user(), $request->input('code'));
        return view('admin.user.2fa.recovery')
            ->with([
                'status' => 'success',
                'flash_message' => trans('label.notification.success')
            ]);
    }

    public function showRecoveryCodeForm()
    {
        return view('admin.user.2fa.recovery');
    }

    public function remove(Request $request)
    {

    }
}

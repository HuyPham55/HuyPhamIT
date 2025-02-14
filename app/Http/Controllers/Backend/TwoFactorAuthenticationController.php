<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Fortify\Actions\DisableTwoFactorAuthentication;
use Laravel\Fortify\Actions\EnableTwoFactorAuthentication;
use Laravel\Fortify\Contracts\TwoFactorDisabledResponse;

class TwoFactorAuthenticationController extends BaseController
{

    /**
     * Enable two-factor authentication for the user.
     * \Laravel\Fortify\Http\Controllers\TwoFactorAuthenticationController::store
     */
    public function enable(Request $request, EnableTwoFactorAuthentication $enable)
    {
        /** @var User $user */
        $user = $request->user();
        if ($user->hasEnabledTwoFactorAuthentication()) {
            return view('admin.user.2fa.recovery');
        } else {
            $enable($user, $request->boolean('force', false));
            return view('admin.user.2fa.setup');
        }
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

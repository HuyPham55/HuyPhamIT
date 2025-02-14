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
     * Disable two factor authentication for the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Laravel\Fortify\Actions\DisableTwoFactorAuthentication  $disable
     * @return \Laravel\Fortify\Contracts\TwoFactorDisabledResponse
     */
    public function destroy(Request $request, DisableTwoFactorAuthentication $disable)
    {
        $disable($request->user());

        return app(TwoFactorDisabledResponse::class);
    }
}

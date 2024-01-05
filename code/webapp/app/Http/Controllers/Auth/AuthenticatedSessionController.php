<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

use Laravel\Fortify\Contracts\FailedTwoFactorLoginResponse;
use Laravel\Fortify\Contracts\TwoFactorChallengeViewResponse;
use Laravel\Fortify\Contracts\TwoFactorLoginResponse;
use Laravel\Fortify\Events\RecoveryCodeReplaced;
use Laravel\Fortify\Http\Requests\TwoFactorLoginRequest;
use Laravel\Fortify\TwoFactorAuthenticationProvider;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view("auth.login");
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): View | RedirectResponse
    {
        $request->authenticate();
        // Handle request without 2FA
        if (!$request->user()->two_factor_secret) {
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::HOME);
        }
        // 2FA enabled
        return view('auth.two-factor-challenge');        
    }

    private function hasValidCode(String $code)
    {

        return $code && tap(app(TwoFactorAuthenticationProvider::class)->verify(decrypt(auth()->user()->two_factor_secret), $code), function ($valid) {
            if ($valid) {
                return true;
            }
            return false;
        });
    }

    private function validRecoveryCode(String $recovery_code)
    {
        if (!$recovery_code) {
            return;
        }
        // dd(decrypt(auth()->user()->two_factor_recovery_codes))->first();
        return tap(collect(decrypt(auth()->user()->two_factor_recovery_codes))->first(function ($code) use ($recovery_code) {

            $code = json_decode($code, true);
            if (in_array($recovery_code, $code)) {
                // Code found in the array
                return true;
            } else {
                // Code not found in the array
                return false;
            }
            return hash_equals($code, $recovery_code) ? $code : null;
        }), function ($code) {
            if ($code) {
                return true;
            }
        });
    }

    /**
     * Handle 2fa requests
     */
    public function twoFactorCheck(TwoFactorLoginRequest $request)
    {
        $user = auth()->user();
        $code = $request->code;


        if ($this->validRecoveryCode($code)) {

            $user->replaceRecoveryCode($code);
            // generate a new recovery code

            // $this->guard->login($user, $request->remember());

            // return app(TwoFactorLoginResponse::class);
        }
        elseif (!$this->hasValidCode($code)) {  // This always return false
            error_log('THIS CODE IS INVALID!');
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard("web")->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect("/");
    }
}

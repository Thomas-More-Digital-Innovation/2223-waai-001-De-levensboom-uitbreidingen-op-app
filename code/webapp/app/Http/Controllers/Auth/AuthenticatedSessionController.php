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

        // send user to auth.two-factor-challenge if correctly filled in then send to home
        if ($request->user()->two_factor_secret) {
            return view('auth.two-factor-challenge');
        }

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    private function hasValidCode(String $code)
    {

        return $code && tap(app(TwoFactorAuthenticationProvider::class)->verify(decrypt(auth()->user()->two_factor_secret), $code), function ($valid) {
            if ($valid) {
                return true;
            }
        });
    }

    public function validRecoveryCode(String $recovery_code)
    {
        if (!$recovery_code) {
            return;
        }
        // dd(auth()->user()->two_factor_recovery_codes);
        return tap(collect(auth()->user()->two_factor_recovery_codes)->first(function ($code) use ($recovery_code) {
            dd(hash_equals($code, $recovery_code));
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


        if (!$this->validRecoveryCode($code)) {
            dd("False recovery code");
        }
        elseif (!$this->hasValidCode($code)) {  // This always return false
            // return app(FailedTwoFactorLoginResponse::class);
            dd("False Code");
        }


        // $user->replaceRecoveryCode($code);
        // generate a new recovery code

        // $this->guard->login($user, $request->remember());

        // return app(TwoFactorLoginResponse::class);
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

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

        $request->session()->regenerate();

        // dd($request->user());

        // send user to auth.two-factor-challenge if correctly filled in then send to home
        if ($request->user()->two_factor_secret) {
            return view('auth.two-factor-challenge');
        }
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    private function hasValidCode(String $code)
    {
        return $code && decrypt(auth()->user()->two_factor_secret) == $code;
    }
    public function validRecoveryCode(String $recovery_code)
    {
        if (! $recovery_code) {
            return;
        }

        return auth()->user()->recoveryCodes()->first(function ($code) {
                return hash_equals($code, $recovery_code) ? true : false;
            });

        // return tap(collect($this->challengedUser()->recoveryCodes())->first(function ($code) {
        //     return hash_equals($code, $recovery_code) ? $code : null;
        // }), function ($code) {
        //     if ($code) {
        //         $this->session()->forget('login.id');
        //     }
        // });
    }

    /**
     * Handle 2fa requests
     */
    public function twoFactorCheck(TwoFactorLoginRequest $request){
        $user = auth()->user();
        $code = $request->code;

        if ($this->validRecoveryCode($code)) {
            // $user->replaceRecoveryCode($code);
            // generate a new recovery code
            dd("CORRECT CODE");
            
        } elseif (! $this->hasValidCode($code)) {  // This always return false
            // return app(FailedTwoFactorLoginResponse::class);
            dd("False Code");
        }

        // $this->guard->login($user, $request->remember());

        // return app(TwoFactorLoginResponse::class);
        return view("/");
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

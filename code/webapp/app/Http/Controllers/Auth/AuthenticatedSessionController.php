<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;
use App\Models\User;

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
        $email = $request->email;
        $password = $request->password;
        if(!Auth::attempt(['email'=>$email, 'password'=>$password],false,false)) {
            throw ValidationException::withMessages([
                    "email" => trans("auth.failed"),
                    ]);
        }
        
        $user = User::where('email', $email)->first();
        // 2FA Enabled
        if ($user->two_factor_secret) {
            if($request->code) {
                if($this->twoFactorCheck($user, $request->code)){
                    $request->authenticate();
                    $request->session()->regenerate();
                    return redirect()->intended(RouteServiceProvider::HOME);
                } else{
                    // Redirect to login page
                    return redirect()->intended(RouteServiceProvider::HOME);
                }
            } else{
                return view('auth.two-factor-challenge', compact('email', 'password'));
            } 
        } else {
            $request->authenticate();
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        // 2FA Disabled
             
    }

    private function hasValidCode(String $code, User $user)
    {

        return $code && tap(app(TwoFactorAuthenticationProvider::class)->verify(decrypt($user->two_factor_secret), $code), function ($valid) {
            if ($valid) {
                return true;
            }
            return false;
        });
    }

    private function validRecoveryCode(String $recovery_code, User $user)
    {
        if (!$recovery_code) {
            return;
        }
        // dd(decrypt(auth()->user()->two_factor_recovery_codes))->first();
        return tap(collect(decrypt($user->two_factor_recovery_codes))->first(function ($code) use ($recovery_code) {

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
    public function twoFactorCheck(User $user, String $code)
    {

        if ($this->validRecoveryCode($code, $user)) {

            $user->replaceRecoveryCode($code);
            // generate a new recovery code

            // $this->guard->login($user, $request->remember());

            // return app(TwoFactorLoginResponse::class);
        }
        elseif (!$this->hasValidCode($code, $user)) {  // This always return false
            error_log('THIS CODE IS INVALID!');
            return false;
        }

        return true;
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

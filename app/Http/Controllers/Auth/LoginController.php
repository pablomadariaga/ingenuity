<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Traits\Auth\LoginHelpers;
use App\Http\Traits\Auth\ThrottleUserLogin;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\View\View;

class LoginController extends Controller
{
    use ThrottleUserLogin, LoginHelpers;

    /**
     * Create a new login controller instance
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm() : View
    {
        return view('auth.login');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\Response|Illuminate\Http\RedirectResponse
     */
    public function authenticate(LoginRequest $request) : Response|RedirectResponse
    {
        //throttle login
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }
        //Attempt login
        if ($this->attemptLogin($request)) {
            $this->removeLoginAttempts($request);
            return $this->loginRedirect($request);
        }
        // If the login attempt was unsuccessful we will increment the number of attempts
        $this->incrementLoginAttempts($request);

        return $this->failedLogin($request);

    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

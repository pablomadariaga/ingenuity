<?php

namespace App\Http\Traits\Auth;

use App\Http\Requests\LoginRequest;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

trait LoginHelpers
{
    /**
     * Attempt to log the user into the application.
     *
     * @param  \App\Http\Requests\LoginRequest  $request
     * @return bool
     */
    protected function attemptLogin(LoginRequest $request)
    {
        return $this->guard()->attempt(
            [
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ]
        );
    }

    /**
     * User was authenticated.
     *
     * @param  \App\Http\Requests\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function loginRedirect(LoginRequest $request)
    {
        $request->session()->regenerate();

        return  redirect()->intended();
    }

    /**
     * failed login.
     *
     * @param \App\Http\Requests\LoginRequest
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedLogin(LoginRequest $request)
    {
        throw ValidationException::withMessages([
            'email' => [__('auth.failed')],
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }
}

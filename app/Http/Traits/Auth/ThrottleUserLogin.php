<?php

namespace App\Http\Traits\Auth;

use App\Http\Requests\LoginRequest;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

trait ThrottleUserLogin
{
    /**
     * check if user has too many failed login attempts.
     *
     * @param  \App\Http\Requests\LoginRequest  $request
     * @return bool
     */
    protected function hasTooManyLoginAttempts(LoginRequest $request)
    {
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey($request),
            5 //the maximum number of attempts to allow
        );
    }

    /**
     * increase login attempts for the user.
     *
     * @param  \App\Http\Requests\LoginRequest  $request
     * @return void
     */
    protected function incrementLoginAttempts(LoginRequest $request)
    {
        $this->limiter()->hit(
            $this->throttleKey($request),
            1 * 60  //number of minutes to throttle for
        );
    }

    /**
     * Redirect the user after determining they are locked out.
     *
     * @param  \App\Http\Requests\LoginRequest $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendLockoutResponse(LoginRequest $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );

        throw ValidationException::withMessages([
            'email' => [__('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ])],
        ])->status(Response::HTTP_TOO_MANY_REQUESTS);
    }

    /**
     * Remove login lockout for user with these credentials.
     *
     * @param  \App\Http\Requests\LoginRequest $request
     * @return void
     */
    protected function removeLoginAttempts(LoginRequest $request)
    {
        $this->limiter()->clear($this->throttleKey($request));
    }

    /**
     * Fire an event when a lockout occurs.
     *
     * @param  \App\Http\Requests\LoginRequest $request
     * @return void
     */
    protected function fireLockoutEvent(LoginRequest $request)
    {
        event(new Lockout($request));
    }

    /**
     * Get the throttle email for the given login request.
     *
     * @param  \App\Http\Requests\LoginRequest  $request
     * @return string
     */
    protected function throttleKey(LoginRequest $request)
    {
        return str($request->input('email'))->lower()->__toString() . '|' . $request->ip();
    }

    /**
     * Get the rate limiter app instance.
     *
     * @return \Illuminate\Cache\RateLimiter
     */
    protected function limiter()
    {
        return app(RateLimiter::class);
    }
}

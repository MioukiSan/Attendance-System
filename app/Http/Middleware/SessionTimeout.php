<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class SessionTimeout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check if the 'session_expires_at' exists in the session
        if (Session::has('session_expires_at')) {
            $sessionExpiresAt = Carbon::parse(Session::get('session_expires_at'));
            
            // Check if current time is past the session expiration time
            if (Carbon::now()->greaterThanOrEqualTo($sessionExpiresAt)) {
                // Destroy session and log the user out
                Session::forget('pinEncrypt');
                Session::forget('login_time');
                Session::forget('session_expires_at');

                return redirect()->route('index')->withErrors(['session' => 'Your session has expired. Please log in again.']);
            }
        }

        return $next($request);
    }
}
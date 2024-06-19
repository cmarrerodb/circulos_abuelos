<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserLogController;

class LogSessionExpired
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && session()->has('expire_on_close')) {
            $timeout = config('session.lifetime') * 60;
            if (time() - session('last_activity') > $timeout) {
                (new UserLogController)->logSessionExpired();
                Auth::logout();
                session()->invalidate();
                return redirect()->route('login')->with('message', 'Tu sesión ha expirado.');
            }
            session(['last_activity' => time()]);
        }

        return $next($request);
    }
    
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * UserLoginChecker
 * Check if the user is already logged and prevent them to go into login
 * @since 2022.08.29
 */
class UserLoginChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $iUserId = session()->get('user_id');
        if (empty($iUserId) === false || $iUserId > 0) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}

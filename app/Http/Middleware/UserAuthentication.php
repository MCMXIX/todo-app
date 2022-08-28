<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * UserAuthentication
 * Prevents the user to access the main page without logging in
 * @since 2022.08.29
 */
class UserAuthentication
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
        if (empty($iUserId) === true || $iUserId < 1) {
            return redirect()->route('login');
        }
        
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Check if the user has the 'user' role
            if (Auth::user()->role === 'user') {
                return $next($request); // Allow access to the requested route
            }
        }

        // If the user is not authenticated or has the 'admin' role,
        // redirect them to a specific page (e.g., home page or login page)
        return redirect('/home')->with('error', 'You do not have access to this page.');
    }
}

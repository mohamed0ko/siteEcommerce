<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'user' || Auth::user()->role === 'admin' || Auth::user()->role === 'editor') {
                return $next($request);
            } else {

                return redirect()->back()->with('error', 'You must be logged in to access this page.');
            }
        } else {
            return redirect()->route('login');
        }
    }
}

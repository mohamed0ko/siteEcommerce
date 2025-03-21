<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                return $next($request);
            } else {

                return redirect()->back()->with('error', 'You must be logged in to access this page. Role=> admin');
            }
        } else {

            return redirect()->route('login');
        }
    }
}

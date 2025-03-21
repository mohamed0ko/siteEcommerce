<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EditorMiddleware
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
            // Check if the user has the correct role (editor or admin)
            if (Auth::user()->role === 'editor' || Auth::user()->role === 'admin') {
                return $next($request);
            } else {

                return redirect()->back()->with('error', 'You do not have permission to access this page.');
            }
        } else {

            return redirect()->route('login');
        }
    }
}

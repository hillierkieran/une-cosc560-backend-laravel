<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            // Redirect unauthenticated users to the login page with a flash message
            return redirect()->route('login')->with('error', 'Please log in to access the admin area.');
        }

        if (Auth::user()->role !== 'admin') {
            // If authenticated but not an admin, show a 403 error with a flash message
            abort(403, 'You do not have the necessary permissions to access this area.');
        }

        return $next($request);
    }
}

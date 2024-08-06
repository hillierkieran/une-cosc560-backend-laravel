<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // If admin or author logged in, allow access
        if(Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'author')){
            return $next($request);
        }

        // Otherwise, abort with 403 Forbidden
        abort(403);
    }
}

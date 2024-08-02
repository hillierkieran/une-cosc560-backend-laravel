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
        // If user is not logged in, redirect to login page
        if(!Auth::check()){
            return redirect()->route('auth.login');
        }

        // If author logged in, allow access
        if(Auth::user()->role === 'author'){
            return $next($request);
        }

        // If user is logged in but not author, return unauthorised message
        return redirect()->back()->with('unauthorised', 'You are
        unauthorised to access this page');
    }
}

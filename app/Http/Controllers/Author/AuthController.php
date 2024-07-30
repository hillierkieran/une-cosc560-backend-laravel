<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('author.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'author',
        ]);

        Auth::login($user);

        return redirect()->route('author.dashboard');
    }

    public function showLoginForm()
    {
        return view('author.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role === 'author') {
                return redirect()->route('author.dashboard');
            } else {
                Auth::logout();
                return redirect()->route('author.login')->withErrors(['email' => 'Access denied.']);
            }
        }

        return redirect()->route('author.login')->withErrors(['email' => 'Invalid credentials.']);
    }
}

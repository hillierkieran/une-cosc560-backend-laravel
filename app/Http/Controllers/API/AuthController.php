<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validate the request
        $credentials = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6'
        ]);

        // Get the user from database by email
        $user = User::where('email', $credentials['email'])->first();

        // Check if the user exists and the password is correct
        if(!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                'data' => null,
                'message' => 'Wrong Credentials'
            ], 401);
        }

        // Create token for the user
        $token = $user->createToken('auth_token')->plainTextToken;

        // Return the response
        return response()->json([
            'user' => $user,
            'data' => $token,
            'message' => 'Success'
        ], 200);
    }
}

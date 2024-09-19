<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    // Helper function to format user data
    private function formatUser($user)
    {
        return [
            'id' => $user->_id, // Change Mongo's `_id` to more common `id`
            'role' => $user->role,
            'name' => $user->name,
            'email' => $user->email,
            // 'email_verified_at' => $user->email_verified_at,
            // 'updated_at' => $user->updated_at,
            // 'created_at' => $user->created_at,
        ];
    }

    // Fetch all blog users
    public function index()
    {
        $users = User::all()->map(function ($user) {
            return $this->formatUser($user);
        });

        return response()->json([
            'data' => $users,
            'message' => 'All users fetched successfully'
        ], 200);
    }

    // Fetch a single blog user by ID
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'error' => 'User not found'
            ], 404);
        }

        // Format the user using the helper function
        $formatedUser = $this->formatUser($user);

        return response()->json([
            'data' => $this->formatUser($user),
            'message' => 'User fetched successfully'
        ], 200);
    }
}

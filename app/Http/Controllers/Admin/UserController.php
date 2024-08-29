<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'role' => 'required|in:admin,author,user',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ], [
            'role.required' => 'A role is required.',
            'role.in' => 'The role must be one of: admin, author, user.',
            'name.required' => 'A name is required.',
            'email.required' => 'An email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email is already registered.',
            'password.required' => 'A password is required.',
            'password.confirmed' => 'The password confirmation does not match.',
        ]);

        User::create([
            'role' => $request->role,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,author,user',
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|confirmed',
        ], [
            'role.required' => 'A role is required.',
            'role.in' => 'The role must be one of: admin, author, user.',
            'name.required' => 'A name is required.',
            'email.required' => 'An email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'password.confirmed' => 'The password confirmation does not match.',
        ]);

        $user->update([
            'role' => $request->role,
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->filled('password') ? bcrypt($request->password) : $user->password,
        ]);

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        $user->posts()->delete(); // Soft delete all posts by the user
        $user->delete(); // Soft delete the user
        return redirect()->route('admin.users.index');
    }

    /**
     * Restore the specified user from storage.
     */
    public function restore($id)
    {
        $user = User::withTrashed()->find($id);
        $user->restore(); // Restore the user
        $user->posts()->restore(); // Restore the user's posts
    }
}

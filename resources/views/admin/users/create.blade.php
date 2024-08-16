@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="my-3">Create New User</h1>

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <!-- Role Input -->
        <div class="form-group">
            <label for="role">Role</label>
            <select name="role" class="form-control" required>
                <option value="admin">Admin</option>
                <option value="Author" selected>Author</option>
                <option value="user">User</option>
            </select>
        </div>

        <!-- Name Input -->
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <!-- Email Input -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <!-- Password Input -->
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <!-- Password Confirmation Input -->
        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary mt-2">Submit</button>
    </form>
</div>
@endsection
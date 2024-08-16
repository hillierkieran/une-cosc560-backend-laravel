@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="my-3">Edit User</h1>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Role Input -->
        <div class="form-group">
            <label for="role">Role</label>
            <select name="role" id="role" class="form-control" required>
                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="author" {{ $user->role === 'author' ? 'selected' : '' }}>Author</option>
                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
            </select>
        </div>

        <!-- Name Input -->
        <div class="form-group">
            <label for="name">Name</label>
            <input id="name" type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
        </div>

        <!-- Email Input -->
        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>

        <!-- Password Input -->
        <div class="form-group">
            <label for="password">Password (optional)</label>
            <input id="password" type="password" name="password" id="password" class="form-control">
        </div>

        <!-- Password Confirmation Input -->
        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary mt-2">Update</button>
    </form>
</div>
@endsection

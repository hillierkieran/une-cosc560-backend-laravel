@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="my-3">User Details</h1>

    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning"><i class="bi bi-pencil-fill"></i> Edit</a>
    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i> Delete</button>
    </form>

    <table class="table w-auto mt-3">
        <tbody>
            <tr>
                <th>ID</th>
                <td>{{ $user->id }}</td>
            </tr>
            <tr>
                <th>Role</th>
                <td>{{ Str::title($user->role) }}</td>
            </tr>
            <tr>
                <th>Name</th>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $user->email }}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
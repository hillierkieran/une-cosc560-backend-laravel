@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="my-3">User Management</h1>
    <a href="{{ route('admin.users.create') }}" class="btn btn-outline-primary"><i class="bi bi-person-plus-fill"></i> Create New User</a>
    <table class="table table-hover mt-3">
        <thead>
            <tr>
                <th>Role</th>
                <th>Name</th>
                <th>Email</th>
                <th>Quick Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr data-url="{{ route('admin.users.show', $user->id) }}" style="cursor: pointer;">
                    <td>
                        @if ($user->role === 'admin')
                            <i class="bi bi-person-fill-gear"></i>
                        @elseif ($user->role === 'author')
                            <i class="bi bi-person-up"></i>
                        @else
                            <i class="bi bi-person"></i>
                        @endif
                        {{ Str::title($user->role) }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        {{-- <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-primary"><i class="bi bi-search"></i> View</a> --}}
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning"><i class="bi bi-pencil-fill"></i></a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this user?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const rows = document.querySelectorAll('table.table-hover tbody tr');
        rows.forEach(row => {
            row.addEventListener('click', function (event) {
                // Prevent the row click event if the click is on a button inside the row
                if (event.target.closest('button')) {
                    event.stopPropagation();
                    return;
                }
                window.location.href = this.dataset.url;
            });
        });
    });
</script>
@endsection
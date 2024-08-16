@extends('layouts.admin')
@section('content')
<div class="container">
    <h1 class="my-3">Post Management</h1>

    <div class="row justify-content-start">
        <!-- Create New Post Button -->
        <div class="col-auto">
            <a href="{{ route('admin.posts.create') }}" class="btn btn-outline-primary mb-1"><i class="bi bi-file-earmark-plus"></i> Create New Post</a>
        </div>
        <!-- Filter Form (for admins only) -->
        @if (Auth::user()->role === 'admin')
            <div class="col-auto">
                <form action="{{ route('admin.posts.index') }}" method="GET">
                    <div class="input-group">
                        <select name="author_id" class="form-control">
                            <option value="">All Users</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ request('author_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </form>
            </div>
        @endif
    </div>

    <!-- Posts Table -->
    <table class="table table-hover mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Author</th>
                <th>Title</th>
                <th>Sumamary</th>
                <th>Quick Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr data-url="{{ route('admin.posts.show', $post->id) }}" style="cursor: pointer;">
                    <td>...{{ substr($post->id, -4) }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($post->user->name, 20) }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($post->title, 40) }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($post->content, 30) }}</td>
                    <td>
                        {{-- <a href="{{ route('admin.posts.show', $post->id) }}" class="btn btn-primary"><i class="bi bi-search"></i> View</a> --}}
                        <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-warning"><i class="bi bi-pencil-fill"></i></a>
                        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this post?');">
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
            row.addEventListener('click', function () {
                window.location.href = this.dataset.url;
            });
        });
    });
</script>
@endsection
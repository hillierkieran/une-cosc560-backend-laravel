@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="my-3">Post Details</h1>

    <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-warning"><i class="bi bi-pencil-fill"></i> Edit</a>
    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i> Delete</button>
    </form>

    <table class="table w-auto mt-3">
        <tbody>
            <tr>
                <th>ID</th>
                <td>{{ $post->id }}</td>
            </tr>
            <tr>
                <th>Title</th>
                <td>{{ $post->title }}</td>
            </tr>
            <tr>
                <th>Author</th>
                <td>
                    @if (!$post->user)
                        <span class="text-danger">Deleted User</span>
                    @elseif (Auth::user()->role === 'admin')
                        <a href="{{ route('admin.users.show', $post->user->id) }}" class="link-offset-2-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                            {{ $post->user->name }}
                        </a>
                    @else
                        {{ $post->user->name }}
                    @endif
                </td>
            </tr>
            <tr>
                <th>Content</th>
                <td>{{ $post->content }}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
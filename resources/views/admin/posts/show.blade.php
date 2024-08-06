@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Blog Post Details</h1>
    <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">&#8634; Back</a>
    <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-primary">&#9998; Edit</a>
    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">&#128465; Delete</button>
    </form>
    <table class="table mt-3">
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
                <td>{{ $post->user->name }}</td>
            </tr>
            <tr>
                <th>Content</th>
                <td>{{ $post->content }}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
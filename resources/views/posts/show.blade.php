@extends('layouts.app')

@section('content')
    <h1>Blog Post Details</h1>
    <a href="{{ url('/posts') }}" class="btn btn-primary">&#8634; Back</a>
    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">&#9998; Edit</a>
    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">&#128465; Delete</button>
    </form>
    <ul>
        <li><b>ID:</b> {{ $post->id }}</li>
        <li><b>Title:</b> {{ $post->title }}</li>
        <li><b>Content:</b> {{ $post->content }}</li>
    </ul>
@endsection
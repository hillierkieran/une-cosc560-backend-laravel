@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="my-3">Edit Post</h1>

    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Title Input -->
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $post->title }}" required>
        </div>

        <!-- Author Input -->
        <div class="form-group">
            <label for="user_id">Author</label>
            @if (Auth::user()->role === 'admin')
                <select name="user_id" id="user_id" class="form-control" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $post->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
            @else
                <input type="text" class="form-control" value="{{ $users->name }}" readonly>
                <input type="hidden" name="user_id" value="{{ $users->id }}">
            @endif
        </div>

        <!-- Content Input -->
        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" id="content" class="form-control" required>{{ $post->content }}</textarea>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary mt-2">Update</button>
    </form>
</div>
@endsection

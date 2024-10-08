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
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $post->title) }}" required>
            @if ($errors->has('title'))
                <span class="text-danger">{{ $errors->first('title') }}</span>
            @endif
        </div>

        <!-- Author Input -->
        <div class="form-group">
            <label for="user_id">Author</label>
            @if (Auth::user()->role === 'admin')
                <select name="user_id" id="user_id" class="form-control" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id', $post->user_id) == $user->id ? 'selected' : '' }}>{{ $user->name }}{{ !$post->user && $post->user_id == $user->id ? ' (!!! Deleted User !!!)' : '' }}</option>
                    @endforeach
                </select>
                @if ($errors->has('user_id'))
                    <span class="text-danger">{{ $errors->first('user_id') }}</span>
                @endif
            @else
                <input type="text" class="form-control" value="{{ $users->name }}" readonly>
                <input type="hidden" name="user_id" value="{{ $users->id }}">
            @endif
        </div>

        <!-- Content Input -->
        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" id="content" class="form-control" required>{{ old('content', $post->content) }}</textarea>
            @if ($errors->has('content'))
                <span class="text-danger">{{ $errors->first('content') }}</span>
            @endif
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary mt-2">Update</button>
    </form>
</div>
@endsection

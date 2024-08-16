@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="my-3">Create New Post</h1>

    <form action="{{ route('admin.posts.store') }}" method="POST">
        @csrf

        <!-- Title Input -->
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <!-- Author Input -->
        <div class="form-group">
            <label for="author">Author</label>
            @if (Auth::user()->role === 'admin')
                <select name="user_id" class="form-control" required>
                    <option selected disabled>Select Author</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            @else
                <input type="text" name="author" class="form-control" value="{{ $users->name }}" required readonly>
            @endif
        </div>

        <!-- Content Input -->
        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" class="form-control" required></textarea>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary mt-2">Submit</button>
    </form>
</div>
@endsection
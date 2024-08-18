@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ Str::title(Auth::user()->role)}} {{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{{ route('posts.index') }}" class="btn btn-primary">View Blog Posts</a>

                    @if (Auth::user()->role === 'admin')
                        <a href={{ route('admin.users.index') }} class="btn btn-primary">User Management</a>
                    @endif

                    @if (Auth::user()->role === 'admin' || Auth::user()->role === 'author')
                        <a href={{ route('admin.posts.index') }} class="btn btn-primary">Post Management</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

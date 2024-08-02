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
                    @auth
                        @if (Auth::user()->role === 'admin')
                            <a href=# class="btn btn-primary">User Managment</a>
                            <a href=# class="btn btn-primary">Post Managment</a>
                        @endif
                        @if (Auth::user()->role === 'author')
                            <a href=# class="btn btn-primary">Post Managment</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

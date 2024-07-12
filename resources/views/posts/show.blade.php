@extends('layouts.app')

@section('content')
    <h1>Blog Post Details</h1>
    <a href="{{ url()->previous() }}">&#8634; Back</a>
    <ul>
        <li><b>ID:</b> {{ $post->id }}</li>
        <li><b>Title:</b> {{ $post->title }}</li>
        <li><b>Content:</b> {{ $post->content }}</li>
    </ul>
@endsection
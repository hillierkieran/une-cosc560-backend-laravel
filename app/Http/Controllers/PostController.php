<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Only show the user's posts
        $posts = Auth::user()->posts;
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content'=> 'required'
        ]);

        Post::create($request->all());
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $this->checkOwnership($post);

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->checkOwnership($post);

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->checkOwnership($post);

        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $post->update($request->all());
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->checkOwnership($post);

        $post->delete();
        return redirect()->route('posts.index');
    }

    /**
     * Check if the user is the owner of the post.
     */
    private function checkOwnership(Post $post)
    {
        // If user is not the owner of the post, return 403 Forbidden.
        if(Auth::id() != $post->user_id) {
            abort(403);
        }
    }
}
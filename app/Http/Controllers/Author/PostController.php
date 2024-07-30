<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Auth::user()->posts;
        return view('author.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('author.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post = new Post($request->all());
        $post->user_id = Auth::id();
        $post->save();

        return redirect()->route('author.posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        if (Auth::id() != $post->user_id) {
            abort(403);
        }
        return view('author.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if (Auth::id() != $post->user_id) {
            abort(403);
        }
        return view('author.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        if (Auth::id() != $post->user_id) {
            abort(403);
        }

        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post->update($request->all());

        return redirect()->route('author.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (Auth::id() != $post->user_id) {
            abort(403);
        }
        $post->delete();
        return redirect()->route('author.posts.index');
    }
}

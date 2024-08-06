<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the posts.
     */
    public function index()
    {
        $posts = $this->getPosts();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new post.
     */
    public function create()
    {
        $this->checkPrivileges();
        return view('admin.posts.create');
    }

    /**
     * Store a newly created post in storage.
     */
    public function store(Request $request)
    {
        $this->checkPrivileges();
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        Post::create($request->all());
        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified post.
     */
    public function show(Post $post)
    {
        $this->checkPrivileges($post);
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified post.
     */
    public function edit(Post $post)
    {
        $this->checkPrivileges($post);
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified post in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->checkPrivileges($post);
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        $post->update($request->all());
        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified post from storage.
     */
    public function destroy(Post $post)
    {
        $this->checkPrivileges($post);
        $post->delete();
        return redirect()->route('admin.posts.index');
    }

    private function checkPrivileges(Post $post = null)
    {
        if (Auth::user()->role === 'admin') {
            // If admin, allow access
            return;
        } elseif (Auth::user()->role === 'author' && (!$post || Auth::user()->id === $post->user_id)) {
            // If author and post is either not provided or author is the owner of the post, allow access
            return;
        } else {
            // If anyone else, show 403 Forbidden error
            abort(403);
        }
    }

    private function getPosts()
    {
        if (Auth::user()->role === 'admin') {
            // If admin, show all posts
            return Post::all();
        } elseif (Auth::user()->role === 'author') {
            // If author, show only own posts
            return Auth::user()->posts;
        } else {
            // If anyone else, show 403 Forbidden error
            abort(403);
        }
    }
}

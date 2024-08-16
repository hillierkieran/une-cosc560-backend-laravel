<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the posts.
     */
    public function index(Request $request)
    {
        $author_id = $request->input('author_id');
        $posts = $this->getPosts($author_id);
        $users = User::all();
        return view('admin.posts.index', compact('posts', 'users'));
    }

    /**
     * Show the form for creating a new post.
     */
    public function create()
    {
        $this->checkPrivileges();

        // If user is admin, they can create posts for any users
        if (Auth::user()->role === 'admin') {
            $users = User::all();
        }
        // If user is author, they can only create posts for themselves
        else {
            $users = User::where('_id', Auth::id())->first();
        }

        return view('admin.posts.create', compact('users'));
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

        // If user is admin, they can credit posts to any users
        if (Auth::user()->role === 'admin') {
            $users = User::all();
        }
        // If user is author, they can only credit posts to themselves
        else {
            $users = User::where('_id', Auth::id())->first();
        }

        return view('admin.posts.edit', compact('post', 'users'));
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

    private function getPosts($author_id = null)
    {
        if ($author_id) {
            // If author_id is provided, show only posts by that author
            return Post::where('user_id', $author_id)->get();
        } elseif (Auth::user()->role === 'admin') {
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

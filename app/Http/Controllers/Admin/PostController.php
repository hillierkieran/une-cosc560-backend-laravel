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
        $includeTrashed = $request->input('trashed', false); // Optional: Filter for trashed posts
        $posts = $this->getPosts($author_id, $includeTrashed);
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
            'user_id' => 'required|exists:users,_id',
            'content' => 'required',
        ], [
            'title.required' => 'A title is required.',
            'user_id.required' => 'An author must be selected.',
            'user_id.exists' => 'The selected author is invalid.',
            'content.required' => 'Content is required.',
        ]);
        Post::create([
            'title' => $request->input('title'),
            'user_id' => $request->input('user_id'),
            'content' => $request->input('content'),
        ]);
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

        $query = User::query()->withTrashed();

        // If user is admin, they can credit posts to any users
        if (Auth::user()->role === 'admin') {
            $users = $query->get();
        }
        // If user is author, they can only credit posts to themselves
        else {
            $users = $query->where('_id', Auth::id())->first();
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
            'user_id' => 'required|exists:users,_id',
            'content' => 'required',
        ], [
            'title.required' => 'A title is required.',
            'user_id.required' => 'An author must be selected.',
            'user_id.exists' => 'The selected author is invalid.',
            'content.required' => 'Content is required.',
        ]);
        $post->update([
            'title' => $request->input('title'),
            'user_id' => $request->input('user_id'),
            'content' => $request->input('content'),
        ]);
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
        $user = Auth::user();

        if ($user->role === 'admin') {
            // Admin can access any post
            return;
        }

        if ($user->role === 'author') {
            if (!$post) {
                // Authors can create new posts
                return;
            }

            if ($post->user_id === $user->id) {
                // Authors can only access their own posts
                return;
            }
        }

        // If none of the above conditions are met, deny access
        abort(403, 'You do not have permission to access this resource.');
    }

    private function getPosts($author_id = null, $includeTrashed = false)
    {
        $query = Post::query();

        if ($includeTrashed) {
            $query->withTrashed(); // Include soft-deleted posts in the results
        }

        if (Auth::user()->role === 'admin' && $author_id) {
            // If admin and author_id is provided, show only that author's posts
            return $query->where('user_id', $author_id)->get();
        } elseif (Auth::user()->role === 'admin') {
            // If admin, show all posts
            return $query->get();
        } elseif (Auth::user()->role === 'author') {
            // If author, show only own posts
            return Auth::user()->posts()->withTrashed($includeTrashed)->get();
        } else {
            // If anyone else, show 403 Forbidden error
            abort(403);
        }
    }
}

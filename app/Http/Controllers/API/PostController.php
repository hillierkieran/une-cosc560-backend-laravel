<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;

class PostController extends Controller
{
    // Fetch all blog posts
    public function index()
    {
        $posts = Post::all();
        return response()->json([
            'data' => $posts,
            'message' => 'All posts fetched successfully'
        ], 200);
    }

    // Fetch a single blog post by ID
    public function show($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'error' => 'Post not found'
            ], 404);
        }

        return response()->json([
            'data' => $post,
            'message' => 'Post fetched successfully'
        ], 200);
    }
}

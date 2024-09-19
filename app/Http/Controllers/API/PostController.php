<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;

class PostController extends Controller
{
    // Helper function to format post data
    private function formatPost($post)
    {
        return [
            'id' => $post->_id, // Change Mongo's `_id` to more common `id`
            'title' => $post->title,
            'content' => $post->content,
            'user_id' => $post->user_id,
            'author' => $post->user->name,
            // 'created_at' => $post->created_at,
            // 'updated_at' => $post->updated_at,
        ];
    }

    // Fetch all blog posts
    public function index()
    {
        $posts = Post::all()->map(function ($post) {
            return $this->formatPost($post);
        });

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

        // Format the post using the helper function
        $formatedPost = $this->formatPost($post);

        return response()->json([
            'data' => $this->formatPost($post),
            'message' => 'Post fetched successfully'
        ], 200);
    }
}

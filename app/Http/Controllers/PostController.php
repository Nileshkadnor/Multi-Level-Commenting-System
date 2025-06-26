<?php

namespace App\Http\Controllers;

// Import necessary classes
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    // Display a single post and its comments
    public function show(Post $post)
    {
        // Eager load the comments with their nested replies
        $post->load('comments.replies');

        // Return the 'posts.show' view with the post data
        return view('posts.show', compact('post'));
    }

    // Show the form to create a new post
    public function create()
    {
        // Return the 'posts.create' Blade view
        return view('posts.create');
    }

    // Store the newly created post in the database
    public function store(Request $request)
    {
        // Validate incoming request data (title and content are required)
        $validated = $request->validate([
            'title' => 'required|string|max:255',    // max 255 chars for title
            'content' => 'required|string',          // content must be a string
        ]);

        // Create the post using mass assignment
        $post = Post::create($validated);

        // Redirect to the post's comment page with a success message
        return redirect()->route('posts.show', $post->id)
            ->with('success', 'Post created successfully!');
    }
}

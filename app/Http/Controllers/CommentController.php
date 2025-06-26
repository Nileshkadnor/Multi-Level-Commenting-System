<?php

namespace App\Http\Controllers;

// Import necessary classes
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    // This method handles storing a new comment (either top-level or a reply)
    public function store(Request $request, Post $post)
    {
        // Validate the incoming request to ensure 'content' is present,
        // and 'parent_id' (if provided) exists in the comments table
        $request->validate([
            'content' => 'required',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        // Default depth is 1 (top-level comment)
        $depth = 1;
        $parentId = $request->parent_id;

        // If it's a reply (i.e., a parent comment ID is provided)
        if ($parentId) {
            // Fetch the parent comment
            $parent = Comment::find($parentId);

            // Check if the parent comment is already at the maximum depth (3)
            if ($parent->depth >= 3) {
                // If max depth is reached, redirect back with an error
                return back()->with('error', 'Maximum depth reached.');
            }

            // Otherwise, set this comment's depth to parent's depth + 1
            $depth = $parent->depth + 1;
        }

        // Create and save the new comment in the database
        Comment::create([
            'content' => $request->content,         // The text of the comment
            'post_id' => $post->id,                 // Associated post ID
            'parent_comment_id' => $parentId,       // Parent comment ID (null for top-level)
            'depth' => $depth,                      // Depth level (1 to 3)
        ]);

        // Redirect back to the post page with a success message
        return back()->with('success', 'Comment added!');
    }
}

<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{

    /**
     * Add the comment.
     */
     public function store(Request $request, $id)
    {
        // Validating our input data
        $request->validate([
            'body' => 'required|string|max:500',
        ]);
        $post = Post::findOrFail($id);
        $comment = new Comment();
        $comment->body = $request->body;
        $comment->user_id = auth()->user()?Auth::id():null; 
        $comment->post_id = $post->id;
        $comment->save();
        return redirect()->route('posts.show', $id)->with('success', 'Comment added successfully!');
    }

     /**
     * Delete the comment.
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return redirect()->back()->with('success', 'Comment deleted successfully!');
    }
}

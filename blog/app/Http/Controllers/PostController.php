<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Inertia\Inertia;

class PostController extends Controller
{
    //
    public function index()
{
    $posts = Post::all();
    return Inertia::render('Post/Index', ['posts' => $posts]);
}
public function show($id)
{
    $post = Post::with('comments.user')->findOrFail($id);
    return Inertia::render('Post/Show', ['post' => $post]);
}

// public function destroy(Post $post)
// {
//     $this->authorize('delete', $post);

//     $post->delete();

//     return redirect('/posts');
// }

}

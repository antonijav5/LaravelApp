<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class PostController extends Controller
{

     /**
     * Show all the posts.
     */
    public function index()
{
    $posts = Post::all();
    return Inertia::render('Post/Index', ['posts' => $posts]);
}

     /**
     * Show the post with given id.
     */
public function show($id)
{
    $post = Post::with('comments.user')->findOrFail($id);
    $user=auth()->user();
    return Inertia::render('Post/Show', ['post' => $post, 'user'=>$user]);
}

     /**
     * Return the view for post creating
     */
public function create()
{
    if (!auth()->user()) {
        return redirect()->back()->with('error', 'You do not have permission to add this post.');
    }
    return Inertia::render('Post/Create');
}

     /**
     * Create a post
     */
public function store(Request $request)
{
    // Validating our input data
    $validated = $request->validate([
        'title' => 'required|max:255',
        'content' => 'required',
    ]);

    if (!auth()->user()) {
        return redirect()->back()->with('error', 'You do not have permission to add this post.');
    }
    $post = Auth::user()->posts()->create($validated);

    return redirect('/posts')->with('success', 'Post was successfully created!');
}

    /**
     * Return the view for editing a post
     */
public function edit(Post $post)
{

    return view('posts.edit', compact('post'));
}

   /**
     * Edit the post
     */
public function update(Request $request, Post $post)
{

   $post = Post::findOrFail($post->id);
   // Validating our input data
   $validatedData = $request->validate([
    'title' => 'required|string|max:255',
    'content' => 'required|string', 
]);
   $post->update($validatedData);
   return response()->json(['message' => 'Post updated successfully.']);

}
   /**
     * Delete the post
     */
public function destroy(Post $post)
{
    $post->delete();
    return response()->json(['message' => 'Post deleted successfully.']);
}

}

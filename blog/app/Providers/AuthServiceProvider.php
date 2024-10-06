<?php

namespace App\Providers;


use App\Models\Post;
use App\Models\Comment;
use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Post::class => PostPolicy::class,
        Comment::class => CommentPolicy::class
    ];

    public function boot()
    {
        $this->registerPolicies();


    Gate::define('view-posts', function ($user = null) {
        return true;
    });


    Gate::define('create-post', function ($user) {
        return $user !== null; 
    });

   
    Gate::define('view-post', function ($user = null, Post $post) {
        return true; 
    });


    Gate::define('update-post', function ($user, Post $post) {
        return $user->id === $post->user_id;
    });

    Gate::define('delete-post', function ($user, Post $post) {
        return $user->id === $post->user_id;
    });


    Gate::define('add-comment', function ($user = null) {
        return true;
    });

    
    Gate::define('delete-comment', function ($user, Comment $comment) {
        return $user->id === $comment->user_id || $user->id === $comment->post->user_id;
    });

    }
}

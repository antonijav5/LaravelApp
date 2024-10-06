<?php

namespace App\Policies;
use Illuminate\Auth\Access\HandlesAuthorization;
use Post;
use App\Models\User;

class PostPolicy
{
  
    use HandlesAuthorization;

     /**
      * Can user update the post
      */
     public function update(User $user, Post $post)
     {
        //Admin has full access 
        if ($user->isAdmin()) {
            return true;
        }
        // If the user is owner of the post
         return $user->id === $post->user_id; 
     }
 
     /**
      * Can user delete the post
      */
     public function delete(User $user, Post $post)
     {
           //Admin has full access 
           if ($user->isAdmin()) {
            return true;
        }
        //  If the user is owner of the post
         return $user->id === $post->user_id; 
         
     }
}

<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Comment;
class CommentPolicy
{
    /*
    * Can user delete the comments
    */
    public function delete(User $user, Comment $comment)
    {
        // Only the comment owner/post owner can delete the comment
        return $user->id === $comment->user_id || $user->id === $comment->post->user_id;
    }
    
}

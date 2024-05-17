<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Post $post)
    {
        return $user->id === $post->user_id || $user->roles[0]->alias === 'moderator';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post): bool
    {
        return $user->id === $post->user_id || $user->roles[0]->alias === 'moderator';
    }
}

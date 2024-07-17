<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Post $post): Response
    {
        // Anybody can view a published post
        if ($post->is_published) {
            return Response::allow();
        }

        // If a post has not yet been published, only the owner
        // of the post can view it
        return $user?->id === $post->user_id
        ? Response::allow()
        : Response::deny("Cannot view post that has not yet been published");
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Post $post, string $responseMsg = null): Response
    {
        return $user->id === $post->user_id
        ? Response::allow()
        : Response::deny($responseMsg ?? "Cannot update post that you do not own");
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post): Response
    {
        return $user->id === $post->user_id
        ? Response::allow()
        : Response::deny("Cannot delete post that you do not own");
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Post $post): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Post $post): bool
    {
        return false;
    }
}

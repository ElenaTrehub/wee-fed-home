<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create(User $user){
        return $user->hasStatus(3) && $user->hasRole(1);
        //});
    }

    public function delete(User $user, Comment $comment){
        return $user->id == $comment->idUser;

    }
}

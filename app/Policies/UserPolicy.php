<?php

namespace App\Policies;

use App\Models\Message;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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

    public function personal(User $user){
        return $user->hasStatus(3) && $user->hasRole(1) || $user->hasStatus(3) && $user->hasRole(3);
        //});
    }
    public function sendMessageAdmin(User $user){
        return $user->hasStatus(3) && $user->hasRole(1) || $user->hasStatus(3) && $user->hasRole(3);
        //});
    }
}

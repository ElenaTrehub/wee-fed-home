<?php

namespace App\Policies;

use App\Models\DoctorInfo;
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
        return $user->hasStatus(3) && $user->hasRole(1);
        //});
    }
    public function sendMessageAdmin(User $user){
        return $user->hasStatus(3) && $user->hasRole(1) || $user->hasStatus(2) && $user->hasRole(1);
        //});
    }

    public function createDoctor(User $user){
        return $user->hasStatus(3) && $user->hasRole(1);
        //});
    }
    public function doctorList(User $user){
        return $user->hasStatus(3) && $user->hasRole(1) || $user->hasStatus(3) && $user->hasRole(3);
        //});
    }

    public function admin(User $user){
        return $user->hasStatus(3) && $user->hasRole(3);
        //});
    }

    public function pay(User $user){
        return $user->hasStatus(3) && $user->hasRole(2);
        //});
    }


}

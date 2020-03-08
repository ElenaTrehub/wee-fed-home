<?php

namespace App\Policies;

use App\Models\DoctorInfo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DoctorInfoPolicy
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
    public function likeDoctor(User $user, DoctorInfo $doctor){
        return $user->isLikeDoctor($doctor->idDoctorInfo) === false;

    }
    public function dislikeDoctor(User $user, DoctorInfo $doctor){
        return $user->isDislikeDoctor($doctor->idDoctorInfo) === false;

    }
}

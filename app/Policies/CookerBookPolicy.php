<?php

namespace App\Policies;

use App\Models\CookerBook;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CookerBookPolicy
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
    public function addRecipe(User $user){
        return $user->hasStatus(3) && $user->hasRole(1);
        //});
    }
    public function show(User $user){
        return $user->hasStatus(3) && $user->hasRole(1);
        //});
    }

}

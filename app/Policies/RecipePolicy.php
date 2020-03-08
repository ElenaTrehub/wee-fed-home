<?php

namespace App\Policies;

use App\Models\DoctorInfo;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;

class RecipePolicy
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
    public function like(User $user, Recipe $resipe){
        return $user->hasStatus(3) && $user->hasRole(1)&&($user->isLikeRecipe($resipe->idRecipe)===false);
        //});
    }
    public function dislike(User $user, Recipe $resipe){
        return $user->hasStatus(3) && $user->hasRole(1)&&($user->isDislikeRecipe($resipe->idRecipe)===false);
        //});
    }

    public function delete(User $user, Recipe $recipe){
        return ($user->id == $recipe->idUser);
    }
    public function edit(User $user, Recipe $recipe){
        return ($user->id == $recipe->idUser);
    }


}

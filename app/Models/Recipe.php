<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';

    protected $primaryKey = 'idRecipe';

    protected $table = 'recipes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idUser', 'recipeTitle', 'recipeIngredients', 'recipePhoto', 'recipeDescription', 'idCategory',
        'timePrepare', 'calory', 'like', 'dislike', 'createdAt', 'updatedAt', 'createdAt', 'updatedAt',
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'idCategory', 'idCategory');
    }

    public function owner(){
        return $this->belongsTo(User::class, 'id', 'idUser');
    }

    public function steps(){
        return $this->hasMany(recipeStep::class, 'idRecipe', 'idRecipe');
    }
    public function comments(){
        return $this->hasMany(Comment::class, 'idRecipe', 'idRecipe');
    }
    public function usersWhoLike(){
        return $this->belongsToMany(User::class, 'user_recipe_like', 'idRecipe', 'idUser');
    }
    public function usersWhoDislike(){
        return $this->belongsToMany(User::class, 'user_recipe_dislike', 'idRecipe', 'idUser');
    }

    public function cookerBooks(){
        return $this->belongsToMany(CookerBook::class, 'cookerbook_recipes', 'idRecipe', 'idCookerBook');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class recipeStep extends Model
{
    protected $primaryKey = 'id';

    protected $table = 'recipe_steps';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idRecipe', 'stepPhoto', 'stepNumber', 'stepDescription',];

    public $timestamps = false;

    public function recipe(){
        return $this->belongsTo(Recipe::class, 'idRecipe', 'idRecipe');
    }
}

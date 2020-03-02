<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{

    protected $primaryKey = 'idIngredient';

    protected $table = 'ingredients';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titleIngredient', 'count', 'idRecipe', 'idUnit'];

    public $timestamps = false;

    public function recipe(){
        return $this->belongsTo(Recipe::class, 'idRecipe', 'idRecipe');
    }
    public function unit(){
        return $this->belongsTo(Unit::class, 'idUnit', 'idUnit');
    }
}

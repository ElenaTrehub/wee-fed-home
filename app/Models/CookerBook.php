<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CookerBook extends Model
{
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
    protected $primaryKey = 'idCookerBook';

    protected $table = 'cooker_books';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idUser'];

    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class, 'id',  'idUser');
    }

    public function recipes(){
        return $this->belongsToMany(Recipe::class, 'cookerbook_recipes', 'idCookerBook', 'idRecipe');
    }

    public function hasRecipe($idRecipe){
        return $this->recipes()->where('recipes.idRecipe', $idRecipe)->count() == 1;
    }
}

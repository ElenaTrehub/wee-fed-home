<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = 'idCategory';

    protected $table = 'categories';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'categoryTitle'];

    public $timestamps = false;

    public function recipies(){
        return $this->hasMany(Recipe::class, 'idCategory', 'idCategory');
    }
}

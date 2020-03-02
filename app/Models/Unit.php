<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{

    protected $primaryKey = 'idUnit';

    protected $table = 'units';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titleUnit'];

    public $timestamps = false;

    public function ingredients(){
        return $this->hasMany(Ingredient::class, 'idUnit', 'idUnit');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{

    protected $primaryKey = 'idSpecialty';

    protected $table = 'specialty';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idUser', 'titleSpecialty', 'urlDiplom'];

    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class, 'id', 'idUser');
    }
}

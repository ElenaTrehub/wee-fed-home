<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $primaryKey = 'idRole';

    protected $table = 'roles';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titleRole'];

    public $timestamps = false;

    public function users(){
        return $this->belongsToMany(User::class, 'roles_user', 'idRole', 'idUser');
    }
}

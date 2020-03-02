<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{

    protected $primaryKey = 'idService';

    protected $table = 'services';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titleService'];

    public $timestamps = false;

    public function users(){
        return $this->belongsToMany(User::class, 'services_users', 'idService', 'idUser')->withPivot('sum');;
    }
}

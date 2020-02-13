<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $primaryKey = 'idStatus';

    protected $table = 'statuses';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titleStatus'];

    public $timestamps = false;

    public function users(){
        return $this->hasMany(User::class, 'idStatus', 'idStatus');
    }

}

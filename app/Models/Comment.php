<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';

    protected $primaryKey = 'idComment';

    protected $table = 'comments';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idUser', 'idRecipe', 'commentText',  'createdAt', 'updatedAt',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'idUser', 'id');
    }

    public function recipe(){
        return $this->belongsTo(Recipe::class, 'idRecipe', 'idRecipe');
    }
}

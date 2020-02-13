<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';

    protected $primaryKey = 'idMessage';

    protected $table = 'messages';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idSender', 'idTaker', 'textMessage', 'isRead', 'createdAt', 'updatedAt',
    ];

    public function sender(){
        return $this->belongsTo(User::class, 'id', 'idSender');
    }
    public function taker(){
        return $this->belongsTo(User::class, 'id', 'idTaker');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorInfo extends Model
{
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';

    protected $primaryKey = 'idDoctorInfo';

    protected $table = 'doctor_info';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idUser', 'surname', 'name', 'second_name', 'birth', 'phone',
        'private_practice', 'med_practice', 'description', 'passport', 'rating', 'isConfirmed', 'dayPay' , 'sumPay', 'createdAt', 'updatedAt',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'idUser');
    }

    public function usersWhoLike(){
        return $this->belongsToMany(User::class, 'user_doctor_like', 'idDoctorInfo', 'idUser');
    }
    public function usersWhoDislike(){
        return $this->belongsToMany(User::class, 'user_doctor_dislike', 'idDoctorInfo', 'idUser');
    }
}

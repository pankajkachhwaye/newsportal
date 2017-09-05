<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppUser extends Model
{
    protected $table = 'app_users';

//    protected $fillable = [
//        'full_name', 'email', 'mobile_no','password'
//    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeCheckUser($query,$email,$mobile){
        return $query->where('email', $email)
            ->orWhere('mobile_no', $mobile);
    }

    public function scopeGetAppUserByMobOrEmail($query,$value){

        return $query->where('email', $value)
            ->orWhere('mobile_no', $value);
    }

    public function getUpdatedAtAttribute($value)
    {
        return ($value == null ? '':$value);
    }

    public function userFavourite(){
       return $this->hasMany('App\Models\Favourite','user_id');
    }
}

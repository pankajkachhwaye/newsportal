<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class DeviceInfo extends Model
{
    use Notifiable;
   protected $table = 'device_info';

    public function userInfo(){
        return $this->belongsTo('App\Models\AppUser','app_user_id');
    }

    public function getUpdatedAtAttribute($value)
    {
        return ($value == null ? '':$value);
    }

    public function getAppUserIdAttribute($value)
    {
        return ($value == null ? '':$value);
    }
}

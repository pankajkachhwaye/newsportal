<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
  protected $table = 'language';

    protected $fillable = [
        'language_name'
    ];

    public function category(){
        return $this->hasMany('App\Models\Category','language_id');
    }

    public function getUpdatedAtAttribute($value)
    {
        return ($value == null ? '':$value);
    }
}

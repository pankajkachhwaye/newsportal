<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    protected $table = 'favourite';

    public function scopeUserFavourite($query,$user_id){
        return $query->where('user_id',$user_id);
    }
    public function scopeNewsFavourite($query,$news_id){
        return $query->where('news_id',$news_id);
    }
}

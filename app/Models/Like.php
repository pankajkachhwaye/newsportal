<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';

    public function scopeUserLike($query,$user_id){
        return $query->where('user_id',$user_id);
    }
    public function scopeNewsLike($query,$news_id){
        return $query->where('news_id',$news_id);
    }
}

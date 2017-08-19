<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    public function newsImage(){
        return $this->hasMany('App\Models\NewsImage','news_id');
    }

    public function scopeGetNewsByCat($query,$cat_id){
        return $query->where('cat_id',$cat_id);
    }

    public function scopeGetNewsByCreatedAt($query,$language){
        return $query->where('lang_id',$language);
    }

    public function scopeGetNewsByLike($query,$language){
        return $query->where('lang_id',$language);
    }
}

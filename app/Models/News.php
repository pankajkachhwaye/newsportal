<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    public function category(){
        return $this->belongsTo('App\Models\Category','cat_id');
    }

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

    public function scopeGetSearchedNews($query,$value){
        return $query->where('news_title','like','%'.$value.'%')->orwhere('news_description','like','%'.$value.'%');
    }


    public function getUpdatedAtAttribute($value)
    {
        return ($value == null ? '':$value);
    }
//    public function scopeGetSearchNewsByDiscription($query,$value){
//        return $query;
//    }
//    public function scopeGetRelatedNews($query,$language){
//        return $query->where('lang_id',$language); where('news_title','like','%'.$value.'%')->
//    }

}

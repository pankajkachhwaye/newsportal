<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $table = 'categories';

  public function scopeGetCategoryByLang($query,$lang_id){
      return $query->where('language_id',$lang_id);
  }

  public function language(){
      return $this->belongsTo('App\Models\Language','language_id');
  }

  public function news(){
      return $this->hasMany('App\Models\News','cat_id');
  }
}

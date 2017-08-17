<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $table = 'categories';

  public function scopeGetCategoryByLang($query,$lang_id){
      return $query->where('language_id',$lang_id);
  }

}

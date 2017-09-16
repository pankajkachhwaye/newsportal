<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsImage extends Model
{
  protected $table = 'news_image';

    public function getUpdatedAtAttribute($value)
    {
        return ($value == null ? '':$value);
    }
}

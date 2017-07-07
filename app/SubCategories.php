<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class SubCategories extends Model
{

    public function scopeGetSubCategoriesName($query){
        return $query->select('id', 'cat_id');

    }
//

    public function scopeGetSubCatByCatId($query,$id)
    {
        return $query->where('cat_id',$id);
    }

}

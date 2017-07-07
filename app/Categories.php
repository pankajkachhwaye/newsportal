<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $Categories='categories';


    public function scopeGetCategoriesName($query){
        return $query->select('id', 'categories_name');

    }
    public function scopeGetCatBytId($query,$id)
    {
        return $query->where('id',$id);
    }

    public function subCategories()
    {
        return $this->hasMany('App\SubCategories','cat_id');
    }

}


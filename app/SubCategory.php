<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    function get_category(){
        // return $this->belongsTo('App\Category','category_id');
        return $this->belongsTo(Category::class,'category_id');
    }
    function product(){

        return $this->hasMany(Product::class,'subcategory_id');

    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{


    function Attribute(){
        return $this->hasMany(Attribute::class, 'color_id');
    }
    function product(){

        return $this->hasMany(Product::class,'color_id');

    }
}

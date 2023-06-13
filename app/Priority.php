<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    public $timestamps = false; 

    public function category(){
        return $this->hasMany('App\Category');
    }
}

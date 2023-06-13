<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false; 

    public function petition(){
        return $this->hasMany('App\Petition');
    }

    public function priority(){
        return $this->belongsTo('App\Priority');
    }

}

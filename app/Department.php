<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public $timestamps = false; 

    public function petition(){
        return $this->hasMany('App\Petition');
    }

    public function user(){
        return $this->hasMany('App\User');
    }
}

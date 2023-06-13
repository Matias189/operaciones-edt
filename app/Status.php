<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public $timestamps = false; 

    public function petition(){
        return $this->hasMany('App\Petition');
    }
}

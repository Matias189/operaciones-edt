<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Petition extends Model
{
    public $timestamps = false; 

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function status(){
        return $this->belongsTo('App\Status');
    }

    public function users(){
        return $this->belongsTo('App\User');
    }

    public function department(){
        return $this->belongsTo('App\Department');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

}

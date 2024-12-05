<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Event extends Model
{
    // relashtion users

    public function users(){

        return $this->belongsToMany('App\User');
    }

}

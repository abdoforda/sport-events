<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class News extends Model
{
    // cat
    public function cat()
    {
        return $this->belongsTo('App\Cat');
    }
}

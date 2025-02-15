<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Cat extends Model
{
    

    // news
    public function news()
    {
        return $this->hasMany('App\News');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class RentalType extends Model
{
    // set table name
    protected $table = 'rental_type';   

    //rentals
    public function rentals(){
        return $this->hasMany('App\Rental');
    }

    
}

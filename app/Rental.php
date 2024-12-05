<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Rental extends Model
{
    // user
    public function user(){
        return $this->belongsTo(User::class);
    }

    //rentalType
    public function rentalType(){
        return $this->belongsTo(RentalType::class);
    }
}

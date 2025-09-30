<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Contest extends Model
{
    // users 
    public function users()
    {
        return $this->hasMany(Contestsuser::class, 'contest_id');
    }
}

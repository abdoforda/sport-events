<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Formss extends Model
{
    
    protected $table = 'formss';

    protected $fillable = ['contest_id', 'form_data'];

}

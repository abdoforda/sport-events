<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //logout

    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }
}

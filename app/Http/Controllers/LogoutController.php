<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function store(){
        auth()->logout(); //cierra la session y nos redirecciona al login
        return redirect('login');
    }

   
}

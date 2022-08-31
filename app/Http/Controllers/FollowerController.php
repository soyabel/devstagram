<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function store(User $user){ //$request es el que hace la peticion para seguir al usuario,$user a que usuario queremos seguir 
        $user->followers()->attach(auth()->user()->id); //attach se utiliza cuando hay una relacion de muchos a muchos
        return back();
    }

    public function destroy(User $user){ 
        $user->followers()->detach(auth()->user()->id); 
        return back();
    }
}

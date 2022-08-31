<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function index(){
        return view('auth.login');
    }

    public function store(Request $request){
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if (!auth()->attempt($request->only('email','password'),$request->remember)) {
            return back()->with('mensaje','Credenciales incorrectas');//es una forma de llenar los valores que tenemos en una session
        //back para volver a la pagina donde mandamos la informacion
        //nos dice regresate a la pagina anterior con las credenciales incorrectas
        } 

         return redirect()->route('posts.index',auth()->user()->username);

    }
}

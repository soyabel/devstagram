<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth'); //para que los usuarios que no esten autentificados no lo puedan ver
    }

    public function index(){
        return view('perfil.index'); //perfil es la carperta y index es el archivo
    }

    public function store(Request $request){
        //Modificar el request
        $request->request->add(['username'=>Str::slug($request->username)]);
        $this->validate($request,[
            'username'=>['required','unique:users,username,'.auth()->user()->id,'min:3','max:20','not_in:twitter,editar-perfil'],
       ]); 

       if ($request->imagen) {
            $imagen=$request->file('imagen'); //pones  'file' como argumento para seleccionar el archivo que le enviamos
            $nombreImgane=Str::uuid().".". $imagen->extension();//Str::uuid() para que nuestras imagens tengan un nombre unico
            $imagenServidor=Image::make($imagen); //para guardar la imagen en el servidor
            $imagenServidor->fit(1000,1000);
            $imagenPath=public_path('perfiles') . "/" . $nombreImgane; //uploads es la carperta donde se guardan las imagenes
            $imagenServidor->save($imagenPath);
       }

       //Guardar Cambios
       $usuario=User::find(auth()->user()->id);
       $usuario->username=$request->username;
       $usuario->imagen=$nombreImgane??auth()->user()->imagen?? null; //si no se subio ninguna imagen aplicale null
       $usuario->save();

       //Redireccionar

       return redirect()->route('posts.index',$usuario->username);

    }
}

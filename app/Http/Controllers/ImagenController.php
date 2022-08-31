<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    //
    public function store(Request $request){
        $imagen=$request->file('file'); //pones  'file' como argumento para seleccionar el archivo que le enviamos
        $nombreImgane=Str::uuid().".". $imagen->extension();//Str::uuid() para que nuestras imagens tengan un nombre unico
        $imagenServidor=Image::make($imagen); //para guardar la imagen en el servidor
        $imagenServidor->fit(1000,1000);
        $imagenPath=public_path('uploads') . "/" . $nombreImgane; //uploads es la carperta donde se guardan las imagenes
        $imagenServidor->save($imagenPath);
        return response()->json(['imagen'=>$nombreImgane]);// métodos del motor Illuminate de laravel "leer"
    }
}



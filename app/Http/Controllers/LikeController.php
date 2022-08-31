<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request, Post $post){

        $post->likes()->create([
            'user_id'=>$request->user()->id
        ]);
        return back(); // la funcion back() nos regresa a donde enviamos la peticion
     }

     public function destroy(Request $request, Post $post){
         //en el request viene el usuario y el usuario ya tiene los likes y los likes esta asociado al modelo
         // y despues lo que hacemos es filtrar el post donde estamos y eliminamos el like
         $request->user()->likes()->where('post_id',$post->id)->delete();
        return back();
     }
}

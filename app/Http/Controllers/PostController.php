<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
   public function __construct()
   {
       $this->middleware('auth')->except(['show','index']); //verifica si el usuario este autentificado
   }

    public function index(User $user){
        $posts=Post::where('user_id',$user->id)->latest()->paginate(20); //traemos la informacion de la base de datos de las publicaciones por medio del campo user_id que esta relacionado con la tabla usuario
        return view('dashboard',[       //latest() para que las publicaciones mas recientes te salgen primero
            'user'=>$user,
            'posts'=>$posts
    ]); //retorno al dashboard y le paso un arreglo como informacion
    }

    public function create(){  //nos permite tener el formulario para poder visualizar la pagina
        return view('posts.create');//posts es la carpeta y create es el archivo create.blade.php
    }

    public function store(Request $request){ //es el que almacena en la base de datos
      $this->validate($request,[
        'titulo'=>'required|max:255',
        'descripcion'=>'required',
        'imagen'=>'required'
      ]);

      /*Post::create([ //para crear la publicacion 
        'titulo'=>$request->titulo,
        'descripcion'=>$request->descripcion,
        'imagen'=>$request->imagen,
        'user_id'=>auth()->user()->id //obtenemos el id del usuario autentificado a quien le pertenece la publicacion
      ]);*/

      //otra forma

    /*  $post=new Post;
      $post->titulo=$request->titulo;
      $post->descripcion=$request->descripcion;
      $post->imagen=$request->imagen;
      $post->user_id=auth()->user()->id;
      $post->save();*/
      

       //otra forma de guardar los datos

       $request->user()->posts()->create([
        'titulo'=>$request->titulo,
        'descripcion'=>$request->descripcion,
        'imagen'=>$request->imagen,
        'user_id'=>auth()->user()->id
       ]);

       return redirect()->route('posts.index',auth()->user()->username);
    }

    public function show(User $user, Post $post){

      return view('posts.show',[
        'post'=>$post,
        'user'=>$user
      ]);
    }

    public function destroy(Post $post){
        $this->authorize('delete',$post);
        $post->delete();

        //Eliminar la imagen
        $imagen_path=public_path('uploads/'.$post->imagen); //nos va a dar la ruta completa a  uploads $post->imagen
        if (File::exists($imagen_path)) { //si existe la ruta
           unlink($imagen_path);  //lo eliminamos
        }
        return redirect()->route('posts.index',auth()->user()->username);
    }

}

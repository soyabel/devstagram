<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke() //este metodo se manda a llamar automaticamente es como un constructor
    {                           //se utiliza solo si tu controlador va a tener un metodo
       $ids= auth()->user()->followings->pluck('id')->toArray(); //con pluck('id') solo obtengo el id te todo el arreglo que me trae
       $posts=Post::whereIn('user_id',$ids)->latest()->paginate(20); //whereIn para filtrar un arreglo
       return view('home',[             //latest() para que las publicaciones mas recientes te salgen primero
           'posts'=>$posts
       ]);
    }
}

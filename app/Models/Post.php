<?php

namespace App\Models;

use App\Models\Like;
use App\Models\Comentario;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    protected $fillable = [ //indicamos que valores vamos a insertar en la base de datos, para que laravel sepa que es la informacion tiene que procesar antes de enviarla a la base de datos
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    public function user(){ //un post pertenece a un usuario
        return $this->belongsTo(User::class)->select(['name','username']);//seleccionanos solo los datos que queremos que nos traigue
    }

    //Un post va a tener multibles comentarios

    public function comentarios(){
        return $this->hasMany(Comentario::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function checkLike(User $user){
        return $this->likes->contains('user_id',$user->id); //likes se posiciona en la tabla likes de la DB y  'user_id' contiene $user->id(ese usuario) 
    }
}

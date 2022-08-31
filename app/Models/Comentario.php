<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comentario extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'post_id',
        'comentario'
    ];

    //creamos una relacion inversa porque los comentarios pertenecen a un usuario
    public function user(){
        return $this->belongsTo(User::class);
    }
}

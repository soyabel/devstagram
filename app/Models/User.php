<?php

namespace App\Models;

use App\Models\Like;
use App\Models\Post;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [ //indicamos que valores vamos a insertar en la base de datos
        'name',
        'email',
        'password',
        'username',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts(){ //un usuario puede tener multibles posts
        return $this->hasMany(Post::class); //le pasamos el modelo con el cual se relaciona
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    //Almacena los seguidores de un usuario
    public function followers(){
        return $this->belongsToMany(User::class,'followers','user_id','follower_id');
    }

    //Almacena los que seguimos

    public function followings(){
        return $this->belongsToMany(User::class,'followers','follower_id','user_id');
    }

    //Comprobar si un usuario ya sigue a otro
    public function siguiendo(User $user){
        return $this->followers->contains($user->id); //contains sirve para iterar todos los datos de la tabla followers en la base de datos
    }
}

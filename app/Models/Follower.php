<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;

    //que es lo que se va a llenar en el modelo de follower
    protected $fillable = [
        'user_id',
        'follower_id'
    ];
}

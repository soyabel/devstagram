<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikePost extends Component
{

    public $post;
    public $isLike;
    public $likes;

    public function mount($post){ //esta funcion se ejecuta ni vien instancias la clase likePost
        $this->isLike=$post->checkLike(auth()->user()); //verifica si el usuario ya le dio like
        $this->likes=$post->likes->count(); //leemos cuantos likes tiene ese post y se lo asignamos a la variable $likes
    }

    public function like(){
        if ($this->post->checkLike(auth()->user())) {
            $this->post->likes()->where('post_id',$this->post->id)->delete();
            $this->isLike=false;
            $this->likes--;
        }else{
            $this->post->likes()->create([
                'user_id'=>auth()->user()->id               
            ]);
            $this->isLike=true;
            $this->likes++;
        }
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}

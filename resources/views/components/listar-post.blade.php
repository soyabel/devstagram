<div>
   @if ($posts->count())
            
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($posts as $post)
                <div>
                    <a href="{{route('posts.show',['post'=>$post,'user'=>$post->user])}}">
                        <img src="{{asset('uploads').'/'.$post->imagen}}" alt="imagen del post {{$post->titulo}}">
                    </a>
                </div>   
            @endforeach
        </div>
        <div class="my-10">
            {{$posts->links()}} {{--Sirve para paginar las paginas--}}
        </div>
        @else
            <p class="text-gray-600 uppercase text-center font-bold text-sm">No hay publicaciones</p>
        @endif
</div>
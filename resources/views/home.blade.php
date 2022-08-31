@extends('layouts.app') {{-- Utilizamos una directiva y siempre apuntan a wiews(/=.=punto) --}} 

@section('titulo')      {{--en blade no es necesacio que el codigo termine en punto y coma--}}
    Página principal    {{--todo lo que esta en el section se va inyectar en el yield('titulo')--}}
@endsection

@section('contenido')
    <x-listar-post :posts="$posts"/>
@endsection
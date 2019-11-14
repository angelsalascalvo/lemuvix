@extends('layouts/master')

@section('title', $movie->title)
    
@section('content')

    <!-- TITULO -->
    <div class="col100">
        <center>
        <div class="titleHeader">
            <h1>
                {{$movie->title}}
            </h1>
            <div class="subTitleHeader">
            </div>
        </div>
        </center>
    </div>

    <!-- CONTENIDO -->
    <div class="col25 posterShow">
        <img src="{{$movie->poster!=null ? url('/img/movies/'.$movie->poster) : url('/img/generic.jpg')}}">

        <div class="buttonActionShow col100">
                <div>
                    <a href="{{route('movie.edit', $movie->id)}}">
                        <button class="col100 buttonStyle2">
                            Editar
                        </button>
                    </a>

                    <form class="convertFormButton" action="{{route('movie.destroy', $movie->id)}}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="col100 buttonStyle2">Eliminar</button>
                    </form>
                </div>
            </div>
    </div>

    <div class="col75">
        <center>
            <div class='contentShow'>
                <span class='col100 subtitleShow'>Sinopsis:</span>
                <span class='col100 infoTextShow'>{{$movie->sinopsis}}</span>
                <span class='col100 subtitleShow'>Año:</span>
                <span class='col100 infoTextShow'>{{$movie->year}}</span>
                <span class='col100 subtitleShow'>Duración:</span>
                <span class='col100 infoTextShow'>{{$movie->duration}}</span>
                <span class='col100 subtitleShow'>Puntuación:</span>
                <span class='col100 infoTextShow'>{{$movie->rating}}/5 ⭐</span>
                <span class='col100 subtitleShow'>Generos:</span>
                <span class='col100 infoTextShow'>
                    @foreach ($movie->genres as $gen)
                    <a href="{{route('movie.showByGenre', $gen->id)}}">
                        {{$gen->description}} 
                        <!-- Sin no es el ultimo elemento escribimos la barra separadora -->
                        @if ($loop->last==false)
                        &nbsp|&nbsp
                        @endif
                    </a>
                    @endforeach
                </span>

                <span class='col100 subtitleShow'>Direccion:</span>
                <span class='col100 infoTextShow'>
                    @foreach ($movie->directors as $dir)
                    <a href="">
                        {{$dir->name}} 
                        <!-- Sin no es el ultimo elemento escribimos la barra separadora -->
                        @if ($loop->last==false)
                        &nbsp|&nbsp
                        @endif
                    </a>
                    @endforeach
                </span>

                <span class='col100 subtitleShow'>Reparto:</span>
                <span class='col100 infoTextShow'>
                    @foreach ($movie->actors as $act)
                    <a href="">
                        {{$act->name}} 
                        <!-- Sin no es el ultimo elemento escribimos la barra separadora -->
                        @if ($loop->last==false)
                        &nbsp|&nbsp
                        @endif
                    </a>
                    @endforeach
                </span>
            </div>
        </center>
    </div>

    
@endsection
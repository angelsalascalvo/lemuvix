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

                    <a href="{{route('movie.destroy', $movie->id)}}">
                        <button class="col100 buttonStyle2">
                            Eliminar
                        </button>
                    </a>
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
            </div>

            
        </center>
    </div>

    
@endsection
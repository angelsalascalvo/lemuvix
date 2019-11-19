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
    <div class="col25">
        <div class="imgAspectRatioA4">
            <img class="imgBorderRound" src="{{$movie->poster!=null ? url('/img/movies/'.$movie->poster) : url('/img/generic.jpg')}}">
        </div>
        
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
                        <div class="col25 centerParent showElementMovie">
                            <div class="col100">
                                <div class="col25">
                                    <div class="imgAspectRatio11">
                                        @if ($gen->image!=null)
                                            <img class="imgRound" src="{{url('/img/genres/'.$gen->image)}}">
                                        @else
                                            <img class="imgRound" src="{{url('/img/generic.jpg')}}">
                                        @endif
                                    </div>
                                </div>

                                <div class="col75">
                                    <span class="centerChildV txtShowElementMovie">{{$gen->description}}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </span>

                <span class='col100 subtitleShow'>Direccion:</span>
                <span class='col100 infoTextShow'>
                    @foreach ($movie->directors as $dir)
                    <a href="{{route('person.show', $dir->id)}}">
                        <div class="col25 centerParent showElementMovie">
                            <div class="col100">
                                <div class="col25">
                                    <div class="imgAspectRatio11">
                                        @if ($dir->photo!=null)
                                            <img class="imgRound" src="{{url('/img/people/'.$dir->photo)}}">
                                        @else
                                            <img class="imgRound" src="{{url('/img/generic.jpg')}}">
                                        @endif
                                    </div>
                                </div>

                                <div class="col75">
                                    <span class="centerChildV txtShowElementMovie">{{$dir->name}}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </span>

                <span class='col100 subtitleShow'>Reparto:</span>
                <span class='col100 infoTextShow'>
                    @foreach ($movie->actors as $act)
                    <a href="{{route('person.show', $act->id)}}">
                        <div class="col25 centerParent showElementMovie">
                            <div class="col100">
                                <div class="col25">
                                    <div class="imgAspectRatio11">
                                        @if ($act->photo!=null)
                                            <img class="imgRound" src="{{url('/img/people/'.$act->photo)}}">
                                        @else
                                            <img class="imgRound" src="{{url('/img/generic.jpg')}}">
                                        @endif
                                    </div>
                                </div>

                                <div class="col75">
                                    <span class="centerChildV txtShowElementMovie">{{$act->name}}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </span>
            </div>
        </center>
    </div>

    
@endsection
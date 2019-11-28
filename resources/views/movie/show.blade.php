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
        @auth
            <div class="buttonActionShow col100">
                <div>
                    <a href="{{route('movie.edit', $movie->id)}}">
                        <button class="col100 buttonStyle2">
                            Editar
                        </button>
                    </a>

                    <form id="removeForm" class="convertFormButton" action="{{route('movie.destroy', $movie->id)}}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="button" id="removeButton" class="col100 buttonStyle2">Eliminar</button>
                    </form>
                </div>
            </div>
        @endauth
    </div>

    <div class="col75">
        <center>
            <div class='contentShow'>
                <span class='col100 subtitleShow'>Sinopsis:</span>
                <span class='col100 infoTextShow'>{{$movie->sinopsis}}</span>
                <div class="col50">
                    <span class='col100 subtitleShow'>Año:</span>
                    <span class='col100 infoTextShow'>{{$movie->year}}</span>
                </div>
                <div class="col50">
                    <span class='col33 subtitleShow'>Duración:</span>
                    <span class='col100 infoTextShow'>{{$movie->duration}} min</span>
                </div>
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
                                            <img class="imgRound" src="{{url('/img/genre.png')}}">
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
                                            <img class="imgRound" src="{{url('/img/person.png')}}">
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
                                            <img class="imgRound" src="{{url('/img/person.png')}}">
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

    <!-- VIDEO PELICULA -->
    <div id="player" class="col100">
        <center>
            <h1 class="width85 titlePlayer">Ver pelicula</h1>
            <div class="width85">
                <video controls width="100%" src="{{url($movie->filepath."/".$movie->filename)}}"></video>
            </div>
        </center>
    </div>

    <!-- SCRIPT -->
    <script>
         $(document).ready(function() {
            $("#removeButton").click(function(){
                var txt = "¿Desea eliminar la pelicula?";
                //Llamada a la ventana modal indicando que metodo debe ejecutar si se acepta el usuario
                modalWindow(txt, 1, "submitDelete()");
            });
        });

        //-------------------------------------------------------------------

        /**
        * METODO PARA ENVIAR EL FORMULARIO DE ELIMANCION DE LA PELICULA
        */
        function submitDelete(){
            $("#removeForm").submit();
        }
    </script>
@endsection
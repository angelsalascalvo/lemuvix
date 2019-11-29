@extends('layouts/master')

@section('title', $person->name)
    
@section('content')

    <!-- TITULO -->
    <div class="col100">
        <center>
        <div class="titleHeader">
            <h1>
                {{$person->name}}
            </h1>
            <div class="subTitleHeader">
            </div>
        </div>
        </center>
    </div>

    <!-- CONTENIDO -->
    <div class="col25">
        
        <div class="imgAspectRatio11">
            <img class="imgRound" src="{{$person->photo!=null ? url('/img/people/'.$person->photo) : url('/img/person.png')}}">
        </div>

        @auth    
            <div class="buttonActionShow col100">
                <div>
                    <a href="{{route('person.edit', $person->id)}}">
                        <button class="col100 buttonStyle2">
                            Editar
                        </button>
                    </a>

                    <form id="removeForm" class="convertFormButton" action="{{route('person.destroy', $person->id)}}" method="POST">
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

                <span class='col100 subtitleShow'>Direcciones:</span>
                <span class='col100 infoTextShow'>
                    @forelse ($person->moviesDirected as $mov)
                    <a href="{{route('movie.show', $mov->id)}}">
                        <div class="col25 centerParent">
                            <div class="marginShowEP">
                                <div class="col100">
                                        <div class="imgAspectRatioA4">
                                            @if ($mov->poster!=null)
                                                <img class="imgBorderRoundMini" src="{{url('/img/movies/'.$mov->poster)}}">
                                            @else
                                                <img class="imgBorderRoundMini" src="{{url('/img/generic.jpg')}}">
                                            @endif
                                        </div>
                                </div>
                                <div class="col100 txtShowElementPerson">
                                    <strong><span>{{$mov->title}}</span></strong>
                                </div>
                            </div>
                        </div>
                    </a>
                    @empty
                    <center>
                        <span>Sin contenido</span>
                    </center>
                    @endforelse
                </span>

                <span class='col100 subtitleShow'>Actuaciones:</span>
                <span class='col100 infoTextShow'>
                    @forelse ($person->moviesActed as $mov)
                    <a href="{{route('movie.show', $mov->id)}}">
                        <div class="col25 centerParent">
                            <div class="marginShowEP">
                                <div class="col100">
                                        <div class="imgAspectRatioA4">
                                            @if ($mov->poster!=null)
                                                <img class="imgBorderRoundMini" src="{{url('/img/movies/'.$mov->poster)}}">
                                            @else
                                                <img class="imgBorderRoundMini" src="{{url('/img/generic.jpg')}}">
                                            @endif
                                        </div>
                                </div>
                                <div class="col100 txtShowElementPerson">
                                    <strong><span>{{$mov->title}}</span></strong>
                                </div>
                            </div>
                        </div>
                    </a>
                    @empty
                    <center>
                        <span>Sin contenido</span>
                    </center>
                    @endforelse
                </span>
            </div>
        </center>
    </div>

     <!-- SCRIPT -->
     <script>
        $(document).ready(function() {
            $("#removeButton").click(function(){
                var txt = "¿Desea eliminar la persona?";
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
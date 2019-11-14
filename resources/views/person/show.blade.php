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
            <img class="imgRound" src="{{$person->photo!=null ? url('/img/people/'.$person->photo) : url('/img/generic.jpg')}}">
        </div>

        <div class="buttonActionShow col100">
                <div>
                    <a href="{{route('person.edit', $person->id)}}">
                        <button class="col100 buttonStyle2">
                            Editar
                        </button>
                    </a>

                    <form class="convertFormButton" action="{{route('person.destroy', $person->id)}}" method="POST">
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

                <span class='col100 subtitleShow'>Direcciones:</span>
                <span class='col100 infoTextShow'>
                    @foreach ($person->moviesDirected as $mov)
                    <a href="{{route('movie.show', $mov->id)}}">
                        {{$mov->title}} 
                        <!-- Sin no es el ultimo elemento escribimos la barra separadora -->
                        @if ($loop->last==false)
                        &nbsp|&nbsp
                        @endif
                    </a>
                    @endforeach
                </span>

                <span class='col100 subtitleShow'>Actuaciones:</span>
                <span class='col100 infoTextShow'>
                    @foreach ($person->moviesActed as $mov)
                    <a href="{{route('movie.show', $mov->id)}}">
                        {{$mov->title}} 
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
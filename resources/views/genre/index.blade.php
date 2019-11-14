@extends('layouts/master')

@section('title', 'Generos | lemuvix')

@section('content')
     <!-- TITULO -->
     <div class="col100">
        <center>
        <div class="titleHeader">
            <h1>
                Generos
            </h1>
            <div class="subTitleHeader">
            </div>
        </div>
        </center>
    </div>

    <!-- CONTENIDO -->
    @foreach ($genres as $gen)
        <div class="col33 genreElement">
            <div class="marginGenre">
            
                <!-- BOTONES DE EDICION FLOTANTES -->
                <div class="floatButtons transform50Y col100 layer20">
                    <div class="sizefbGenre">
                        <form action="{{route('genre.destroy', $gen->id)}}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="fbDelete"></button>
                        </form>
                    </div>
                    <div class="sizefbGenre">
                        <a href="{{route('genre.edit', $gen->id)}}">
                            <button class="fbEdit"></button>
                        </a>
                    </div>
                </div>

                <!-- CONTENEDOR DE GENERO -->
                <a href="{{route('movie.showByGenre', $gen->id)}}">
                    <div class="col100 genreContent layer10">
                        <div class="col20">
                            <div class="imgAspectRatio11">
                                <img class="imgRound"src="{{$gen->image ? url('/img/genres/'.$gen->image) : url('/img/generic.jpg')}}">
                            </div>
                        </div>

                        <div class="col80 txtGenre">
                            <h2>{{$gen->description}}</h2>
                        </div>
                    </div>
                </a>

            </div>
        </div>
    @endforeach

    <div class="buttonAdd">
        <a href="{{route('genre.create')}}">
            <button></button>
        </a>
    </div>
    
@endsection
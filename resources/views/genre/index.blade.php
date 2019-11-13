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
    @foreach ($genres as $g)
        <div class="col33 genreElement">
            <div class="marginGenre">
            
                <div class="floatButtons transform50Y col100 layer20">
                    <div class="sizefbGenre">
                        <form action="{{route('genre.destroy', $g->id)}}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="bDeleteMovie"></button>
                        </form>
                    </div>
                    <div class="sizefbGenre">
                        <a href="{{route('genre.edit', $g->id)}}">
                            <button class="bEditMovie"></button>
                        </a>
                    </div>
                </div>

                <div class="col100 genreContent layer10">
                    <div class="col20 imageGenre">
                        <img class="col100" src="{{$g->image ? url('/img/genres/'.$g->image) : url('/img/generic.jpg')}}">
                    </div>

                    <div class="col80 txtGenre">
                        <h2>{{$g->description}}</h2>
                    </div>
                </div>

            </div>
        </div>
    @endforeach

    <div class="buttonAdd">
        <a href="{{route('genre.create')}}">
            <button></button>
        </a>
    </div>
    
@endsection
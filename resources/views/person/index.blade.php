@extends('layouts/master')

@section('title', 'Generos | lemuvix')

@section('content')
     <!-- TITULO -->
     <div class="col100">
        <center>
        <div class="titleHeader">
            <h1>
                PERSONAS
            </h1>
            <div class="subTitleHeader">
            </div>
        </div>
        </center>
    </div>

    <!-- CONTENIDO -->
    @foreach ($people as $per)
        <div class="col33 genreElement">
            <div class="marginGenre">
            
                <div class="floatButtons transform50Y col100 layer20">
                    <div class="sizefbGenre">
                        <form action="{{route('person.destroy', $per->id)}}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="bDeleteMovie"></button>
                        </form>
                    </div>
                    <div class="sizefbGenre">
                        <a href="{{route('person.edit', $per->id)}}">
                            <button class="bEditMovie"></button>
                        </a>
                    </div>
                </div>
                <a href="{{route('movie.showByGenre', $per->id)}}">
                    <div class="col100 genreContent layer10">
                        <div class="col20 imageGenre">
                            <img class="col100" src="{{$per->photo ? url('/img/people/'.$per->photo) : url('/img/generic.jpg')}}">
                        </div>

                        <div class="col80 txtGenre">
                            <h2>{{$per->name}}</h2>
                        </div>
                    </div>
                </a>

            </div>
        </div>
    @endforeach

    <div class="buttonAdd">
        <a href="{{route('person.create')}}">
            <button></button>
        </a>
    </div>
    
@endsection
@extends('layouts/master')

@section('title', 'lemuvix')

@section('content')
    <div class="marginTopMovies col100">
    </div>

    @foreach ($movies as $m)
        <div class="col25 contentMovie">
            <div class="marginContentMovie">

                <div class="floatButtonsMovie">
                    <div class="sizefbMovie">
                        <form class="convertFormButton" action="{{route('movie.destroy', $m->id)}}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="bDeleteMovie"></button>
                        </form>
                    </div>
                    <div class="sizefbMovie">
                        <a href="{{route('movie.edit', $m->id)}}">
                            <button class="bEditMovie"></button>
                        </a>
                    </div>
                </div>
                
                <div class="posterMovie">
                    <img class="col100" src="{{url('/img/generic.jpg')}}">
                </div>

                <div>
                    <h1 class="col100">{{$m->title}}</h1>
                </div>
            </div>
        </div>
    @endforeach

    <div class="buttonAdd">
        <a href="{{route('movie.create')}}">
            <button></button>
        </a>
    </div>
    
@endsection
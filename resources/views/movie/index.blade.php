@extends('layouts/master')

@section('title', 'lemuvix')

@section('content')

    <!-- TITULO -->
    @if (isset($genre))
        <div class="col100">
            <center>
           
                <div class="titleHeader">
                    <div class="imageHeader">
                        <img src="{{url('/img/genres/'.$genre->image)}}">
                    </div>
                <div style="
                        float: left;
                        position: relative;
                    ">
                         


                         <div style="position: absolute;top: 0;bottom: 0;margin: auto;">
                                


                    <h1>
                        {{$genre->description}}
                    </h1>
                    <div class="subTitleHeader">
                    </div>
                    <div>
                </div>
                </div>
            </center>
        </div>
    @else
        <div class="marginTopMovies col100">
        </div>
    @endif
    

    

    @foreach ($movies as $m)
        <div class="col25 contentMovie">
            <div class="marginContentMovie">

                <div class="floatButtons transform50">
                    <div class="sizefbMovie">
                        <form action="{{route('movie.destroy', $m->id)}}" method="POST">
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

                <a href="{{route('movie.show', $m->id)}}">
                    <div class="posterMovie">
                        <img class="col100" src="{{$m->poster ? url('/img/movies/'.$m->poster) : url('/img/generic.jpg')}}">
                    </div>

                    <div>
                        <h1 class="col100">{{$m->title}}</h1>
                    </div>
                </a>
            </div>
        </div>
    @endforeach

    <div class="buttonAdd">
        <a href="{{route('movie.create')}}">
            <button></button>
        </a>
    </div>
    
@endsection
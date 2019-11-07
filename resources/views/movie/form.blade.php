@extends('layouts/master')

@if ($action=='edit')
    @section('title', 'Editar Pelicula')
@else
    @section('title', 'Nueva Pelicula')
@endif

@section('content')
    <!-- TITULO -->
    <div class="col100">
        <center>
        <div class="titleHeader">
            <h1>
                {{$action=='edit'?"Editar Pelicula":"Nueva pelicula"}}
            </h1>
            <div class="subTitleHeader">
            </div>
        </div>
        </center>
    </div>

    <center>
        <div id="formUser">
            @if ($action=='edit')
                <form action="{{route('movie.update', $datos->id)}}" method="post">    
                    @csrf
                    <input type="hidden" name="_method" value="PATCH">
            @else
                <form action="{{route('movie.store')}}" method="post">
                    @csrf
            @endif
                
                <div class="groupField">
                    <input class="inpForm" type="text" name="title" placeholder=" " autocomplete="off" required value="{{$datos->title ?? ""}}">
                    <label class="labForm" for="title">Titulo</label><br>  
                </div>
                
                <div class="groupField">
                    <textarea class="inpForm textarea" type="text" name="sinopsis" placeholder=" " autocomplete="off" required>{{$datos->sinopsis ?? ""}}</textarea>
                    <label class="labForm" for="sinopsis">Sinopsis</label><br>  
                </div>

                <div class="groupField">
                    <input class="inpForm" type="number" name="duration" placeholder=" " autocomplete="off" required value="{{$datos->duration ?? ""}}">
                    <label class="labForm" for="duration">Duración (min)</label><br>  
                </div>
                
                <div class="groupField">
                    <input class="inpForm" type="number" name="year" placeholder=" " autocomplete="off" required value="{{$datos->year ?? ""}}">
                    <label class="labForm" for="year">Año</label><br>  
                </div>

                <div class="groupField">
                    <input class="inpForm" type="number" name="rating" placeholder=" " autocomplete="off" required value="{{$datos->rating ?? ""}}">
                    <label class="labForm" for="rating">Puntuacion</label><br>  
                </div>

                <input class="bSubmit button" class="button" type="submit" value="{{$action=='edit'?"Actualizar":"Guardar"}}">      
            </form>          
        </div>
    </center>
 
    <!-- 
        ?? es una variacion del operador ternario, si existe la variable, escribe su valor en caso contrario,
        aquello especificado despues de la doble interrogacion
    -->
@endsection
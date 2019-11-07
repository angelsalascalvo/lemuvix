@extends('layouts/master')

@section('title', 'Agregar Usuario')

@section('content')
    <!-- TITULO -->
    <div class="col100">
        <center>
        <div class="titleHeader">
            <h1>
                {{$action=='edit'?"Editar $datos->name":"Nuevo usuario"}}
            </h1>
            <div class="subTitleHeader">
            </div>
        </div>
        </center>
    </div>

    <center>
        <div id="formUser">
            @if ($action=='edit')
                <form action="{{route('user.update', $datos->id)}}" method="post">    
                    @csrf
                    <input type="hidden" name="_method" value="PATCH">
            @else
                <form action="{{route('user.store')}}" method="post">
                    @csrf
            @endif
                
                <div class="groupField">
                    <input class="inpForm" type="text" name="nick" placeholder=" " autocomplete="off" required value="{{$datos->nick ?? ""}}">
                    <label class="labForm" for="nick">Usuario</label><br>  
                </div>
                
                <div class="groupField">
                    <input class="inpForm" type="text" name="name" placeholder=" " autocomplete="off" required value="{{$datos->name ?? ""}}">
                    <label class="labForm" for="nick">Nombre</label><br>  
                </div>
                
                <div class="groupField">
                    <input class="inpForm" type="email" name="email" placeholder=" " autocomplete="off" required value="{{$datos->email ?? ""}}">
                    <label class="labForm" for="nick">Email</label><br>  
                </div>

                <div class="groupField">
                    <input class="inpForm" type="password" name="password" placeholder=" " autocomplete="off" required value="{{$datos->password ?? ""}}">
                    <label class="labForm" for="nick">Contraseña</label><br>  
                </div>

                <div class="rowCheckBox">
                    <input type="checkbox" class="checkbox" name="admin" value="0" {{(isset($datos) && ($datos->admin==0)) ? "checked" : ""}}>
                    <label class="labCheckBox" for="admin">Administrador</label>
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
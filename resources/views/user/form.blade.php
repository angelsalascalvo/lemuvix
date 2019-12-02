@extends('layouts/master')

@if ($action=='edit')
    @section('title', 'Editar Usuario | lemuvix')
@else
    @section('title', 'Nuevo Usuario | lemuvix')
@endif

@section('content')
    <!-- TITULO -->
    <div class="col100">
        <center>
        <div class="titleHeader">
            <h1>
                {{$action=='edit'?"Editar Usuario":"Nuevo usuario"}}
            </h1>
            <div class="subTitleHeader">
            </div>
        </div>
        </center>
    </div>
    
    <!-- CONTENIDO -->
    <center>
        <div id="formUser">
            @if ($action=='edit')
                <form action="{{route('user.update', $data->id)}}" method="post">    
                    @csrf
                    <input type="hidden" name="_method" value="PATCH">
            @else
                <form action="{{route('user.store')}}" method="post">
                    @csrf
            @endif
                
                <div class="groupField @error('nick') invalid @enderror">
                    <input class="inpForm" type="text" name="nick" placeholder=" " autocomplete="off" required value="{{old('nick')?? ($data->nick ?? "")}}">
                    <label class="labForm" for="nick">Usuario</label>
                    @error('nick')
                        <div class="invalidTxt">{{ $message }}</div>
                    @enderror
                    <br>
                </div>
                
                <div class="groupField @error('name') invalid @enderror">
                    <input class="inpForm" type="text" name="name" placeholder=" " autocomplete="off" required value="{{old('name')?? ($data->name ?? "")}}">
                    <label class="labForm" for="nick">Nombre</label>
                    @error('name')
                        <div class="invalidTxt">{{ $message }}</div>
                    @enderror
                    <br>
                </div>
                
                <div class="groupField @error('email') invalid @enderror">
                    <input class="inpForm" type="email" name="email" placeholder=" " autocomplete="off" required value="{{old('email')?? ($data->email ?? "")}}">
                    <label class="labForm" for="email">Email</label>
                    @error('email')
                        <div class="invalidTxt">{{ $message }}</div>
                    @enderror 
                    <br>
                </div>

                <div class="groupField @error('password') invalid @enderror">
                    <input class="inpForm" type="password" name="password" placeholder=" " autocomplete="off" required value="{{isset($data) ? "********": ""}}">
                    <label class="labForm" for="password">Contraseña</label>
                    @error('password')
                        <div class="invalidTxt">{{ $message }}</div>
                    @enderror 
                    <br> 
                </div>

                <div class="rowCheckBox">
                    <input type="checkbox" class="checkbox" name="admin" value="0" {{old('admin')=="0" || (isset($data) && ($data->admin==0)) ? "checked" : ""}}>
                    <label class="labCheckBox" for="admin">Administrador</label>
                    @error('admin')
                        <div class="invalidTxt">{{ $message }}</div>
                    @enderror 
                    <br>
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
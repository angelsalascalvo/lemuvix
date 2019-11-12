@extends('layouts/master')

@section('title', 'Cine')

@section('content')
    <!-- TITULO -->
    <div class="col100">
        <center>
        <div class="titleHeader">
            <h1>
                Usuarios del sistema
            </h1>
            <div class="subTitleHeader">
            </div>
        </div>
        </center>
    </div>

    <!-- BOTON FLOTANTE -->
    <div class="buttonAdd">
        <a href="{{route('user.create')}}">
            <button></button>
        </a>
    </div>
    

    <center>
        <table cellspacing="0">
            <tr>
                <th class="th-color th-left">ID</th>
                <th class="th-color">Nombre</th>
                <th class="th-color">Usuario</th>
                <th class="th-color">Email</th>
                <th class="th-color">Password</th>
                <th class="th-color th-rigth">Admin</th>
            </tr>
            @foreach ($users as $usu)
                <tr>
                    <td>{{$usu->id}}</td>
                    <td>{{$usu->name}}</td>
                    <td>{{$usu->nick}}</td>
                    <td>{{$usu->email}}</td>
                    <td>{{$usu->password}}</td>
                    <td>{{$usu->admin}}</td>

                    <td>
                        <form class="convertFormButton" action="{{route('user.destroy', $usu->id)}}" method="post">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <button>Eliminar</button>
                        </form>
                    </td>

                    <td>
                        <a href="{{route('user.edit', $usu->id)}}">
                            <button>Editar</button>
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
    </center>
@endsection
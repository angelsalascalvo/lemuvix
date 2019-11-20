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
                <tr id="usu{{$usu->id}}">
                    <td>{{$usu->id}}</td>
                    <td>{{$usu->name}}</td>
                    <td>{{$usu->nick}}</td>
                    <td>{{$usu->email}}</td>
                    <td>{{$usu->password}}</td>
                    <td>{{$usu->admin}}</td>

                    <td>
                        <button id="bRemove{{$usu->id}}" class="bDelete">Eliminar</button>
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

    <script>
        $(document).ready(function() {
            //Comprobar existencia de errores para ser mostrados
            @if (session('error'))
                alert("{{ session('error')}}");
            @endif

            //Asignar el metodo de borrado a los botones de eliminar pasandoles su id correspondiente
            $(".bDelete").click(function(){               
                removeMovieAjax($(this).attr("id").replace('bRemove', ''));
            });

        });

        /*
        * METODO PARA ENVIAR LA PETICION DE ELIMINACION POR AJAX AL SERVIDOR
        * Y ELIMINAR EL ELEMENTO HTML
        */
        function removeMovieAjax(id, route){           
            var rute = "{{ route('user.destroy', 'req_id') }}".replace('req_id', id)
            $.ajax({
                url: rute,
                type: 'delete',
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success:function(result){
                    //Si nos devuelve el codigo de la pelicula eliminada, borramos el elemento HTML
                    if(result['status']){                        
                        $("#usu"+result['id']).remove();
                    }else{
                        alert(result['error']);
                    }
                }
            });
        }
    </script>
@endsection
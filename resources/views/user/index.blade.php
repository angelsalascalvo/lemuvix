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
    <div class="buttonAdd buttonFloat">
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
                    <td>********</td>
                    <td>{{$usu->admin}}</td>
                    <!-- No agregar botones de accion para el propio usuario registrado -->
                        <td class="paddingButtonsTable">
                            <div class="buttonTable">
                                <a href="{{route('user.edit', $usu->id)}}">
                                    <button class="fbEdit"></button>
                                </a>
                            </div>
                        </td>
                    @if (Auth::user()->id != $usu->id)                  
                        <td class="paddingButtonsTable">
                                <div class="buttonTable">
                                    <button id="bRemove{{$usu->id}}" class="fbDelete"></button>
                                </div>
                            </td>
                    @endif
                </tr>
            @endforeach
        </table>
    </center>

    <script>
        $(document).ready(function() {
            //Comprobar existencia de errores para ser mostrados
            @if (session('error'))
                modalWindow("{{ session('error')}}", 0, null);
            @endif

            //Asignar el metodo de borrado a los botones de eliminar pasandoles su id correspondiente
             //Asignar el metodo de borrado a los botones de eliminar pasandoles su id correspondiente
             $(".bDelete").click(function(){               
                var id = $(this).attr("id").replace('bRemove', '');
                var txt = "¿Desea eliminar el usuario?";
                //Llamada a la ventana modal indicando que metodo debe ejecutar si se acepta el usuario
                modalWindow(txt, 1, "removeUserAjax("+id+")");
            });

        });

        /*
        * METODO PARA ENVIAR LA PETICION DE ELIMINACION POR AJAX AL SERVIDOR
        * Y ELIMINAR EL ELEMENTO HTML
        */
        function removeUserAjax(id, route){           
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
                        modalWindow(result['error'], 0, null);
                    }
                }
            });
        }
    </script>
@endsection
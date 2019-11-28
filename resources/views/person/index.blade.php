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
        <div id="per{{$per->id}}" class="element col33 genreElement">
            <div class="marginGenre">
                @auth
                    <!-- BOTONES DE EDICION FLOTANTES -->
                    <div class="floatButtons transform50Y col100 layer20">
                        <div class="sizefbGenre">
                            <button id="bRemove{{$per->id}}" class="fbDelete"></button>
                        </div>
                        <div class="sizefbGenre">
                            <a href="{{route('person.edit', $per->id)}}">
                                <button class="fbEdit"></button>
                            </a>
                        </div>
                    </div>
                @endauth

                <!-- CONTENEDOR DE PERSONA -->
                <a href="{{route('person.show', $per->id)}}">
                    <div class="col100 genreContent layer10">
                        <div class="col10" style="height: 1px">
                        </div>

                        <div class="col20">
                            <div class="imgAspectRatio11">
                                <img class="imgRound" src="{{$per->photo ? url('/img/people/'.$per->photo) : url('/img/person.png')}}">
                            </div>
                        </div>

                        <div class="col70 txtGenre">
                            <h2 class="txtElement">{{$per->name}}</h2>
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
    

    <script>
        $(document).ready(function() {
            //Comprobar existencia de errores para ser mostrados
            @if (session('error'))
                modalWindow("{{ session('error')}}", 0, null);
            @endif

            //Asignar el metodo de borrado a los botones de eliminar pasandoles su id correspondiente
            $(".fbDelete").click(function(){               
                var id = $(this).attr("id").replace('bRemove', '');
                var txt = "¿Desea eliminar la persona?";
                //Llamada a la ventana modal indicando que metodo debe ejecutar si se acepta el usuario
                modalWindow(txt, 1, "removePersonAjax("+id+")");
            });
        });

        /*
        * METODO PARA ENVIAR LA PETICION DE ELIMINACION POR AJAX AL SERVIDOR
        * Y ELIMINAR EL ELEMENTO HTML
        */
        function removePersonAjax(id, route){           
            var rute = "{{ route('person.destroy', 'req_id') }}".replace('req_id', id)
            $.ajax({
                url: rute,
                type: 'delete',
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success:function(result){                   
                    //Si nos devuelve un codigo satisfactorio, borramos el elemento HTML
                    if(result['status']){                        
                        $("#per"+result['id']).remove();
                    }else{
                        modalWindow(result['error'], 0, null);
                    }
                }
            });
        }
    </script>

@endsection
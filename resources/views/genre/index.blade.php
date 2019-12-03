@extends('layouts/master')

@section('title', 'Generos | lemuvix')

@section('content')
     <!-- TITULO -->
     <div class="col100">
        <center>
        <div class="titleHeader">
            <h1>
                Generos
            </h1>
            <div class="subTitleHeader">
            </div>
        </div>
        </center>
    </div>

    <!-- Indicacion cuando no se encuentran resultados -->
    <div id="noResults" style="display:none">
        <center>
            <span>Sin resultados...</span>
        <center>
    </div>

    <!-- CONTENIDO -->
    @forelse ($genres as $gen)
        <div id="gen{{$gen->id}}" class="element col33 genreElement">
            <div class="marginGenre">
                @auth
                    <!-- BOTONES DE EDICION FLOTANTES -->
                    <div class="floatButtons transform50Y col100 layer20">
                        <div class="sizefbGenre">
                            <button id="bRemove{{$gen->id}}" class="fbDelete"></button>
                        </div>
                        <div class="sizefbGenre">
                            <a href="{{route('genre.edit', $gen->id)}}">
                                <button class="fbEdit"></button>
                            </a>
                        </div>
                    </div>
                @endauth

                <!-- CONTENEDOR DE GENERO -->
                <a href="{{route('movie.showByGenre', $gen->id)}}">
                    <div class="col100 genreContent layer10">
                        <div class="col10" style="height: 1px">
                        </div>
                        <div class="col20">
                            <div class="imgAspectRatio11">
                                <img class="imgRound"src="{{$gen->image ? url('/img/genres/'.$gen->image) : url('/img/genre.png')}}">
                            </div>
                        </div>

                        <div class="col70 txtGenre">
                            <h2 class="txtElement">{{$gen->description}}</h2>
                        </div>
                    </div>
                </a>

            </div>
        </div>
    @empty
        <div class="col100 noContent">
            <center>
                <span>Sin contenido</span>
            </center>
        </div>
    @endforelse
    
    @auth
        <div class="buttonAdd buttonFloat">
            <a href="{{route('genre.create')}}">
                <button></button>
            </a>
        </div>
    @endauth
    

    <script>
        /**
        * INICIO DE EJECUCION
        */
        $(document).ready(function() {
            //Comprobar existencia de errores para ser mostrados
            @if (session('error'))
                modalWindow("{{ session('error')}}", 0, null);
            @endif

            //Asignar el metodo de borrado a los botones de eliminar pasandoles su id correspondiente
            $(".fbDelete").click(function(){               
                var id = $(this).attr("id").replace('bRemove', '');
                var txt = "¿Desea eliminar el genero?";
                //Llamada a la ventana modal indicando que metodo debe ejecutar si se acepta el usuario
                modalWindow(txt, 1, "removeGenreAjax("+id+")");
            });

        });

        //----------------------------------------------------------------------------------------------

        /*
        * METODO PARA ENVIAR LA PETICION DE ELIMINACION POR AJAX AL SERVIDOR
        * Y ELIMINAR EL ELEMENTO HTML
        */
        function removeGenreAjax(id, route){           
            var rute = "{{ route('genre.destroy', 'req_id') }}".replace('req_id', id)
            $.ajax({
                url: rute,
                type: 'delete',
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success:function(result){                   
                    //Si nos devuelve un codigo satisfactorio, borramos el elemento HTML
                    if(result['status']){                        
                        $("#gen"+result['id']).remove();
                    }else{
                        modalWindow(result['error'], 0, null);
                    }
                }
            });
        }
    </script>
@endsection
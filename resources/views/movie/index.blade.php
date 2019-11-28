@extends('layouts/master')

@section('title', 'lemuvix')

@section('content')

    <!-- TITULO -->
    @if (isset($genre))
        <div class="col100">
            <center>
            <div class="contentHeader">
                <div class="imageHeader">
                    <div class="imgAspectRatio11">
                        <img class="imgRound" src="{{url('/img/genres/'.$genre->image)}}">
                    </div>
                </div>
                <div class="txtHeader">
                    <h1>
                        {{$genre->description}}
                    </h1>
                    <div class="subTitleHeader">
                    </div>
                </div>
            </div>
            </center>
        </div>
    @else
        <div class="marginTopMovies col100">
        </div>
    @endif
    

    @foreach ($movies as $m)
        <div id="mov{{$m->id}}" class="element col25 contentMovie">
            <div class="marginContentMovie">
                <!-- BOTONES DE EDICION FLOTANTES -->
                @auth
                    <div class="floatButtons transform50XY col100 layer20">
                        <div class="sizefbMovie">
                            <button id="bRemove{{$m->id}}" class="fbDelete"></button>
                        </div>
                        <div class="sizefbMovie">
                            <a href="{{route('movie.edit', $m->id)}}">
                                <button class="fbEdit"></button>
                            </a>
                        </div>
                    </div>
                @endauth
               

                <!-- CONTENEDOR DE PELICULA -->
                <a href="{{route('movie.show', $m->id)}}">
                    <div class="col100">
                        <div class="imgAspectRatioA4">
                            <img class="imgBorderRound" src="{{$m->poster ? url('/img/movies/'.$m->poster) : url('/img/generic.jpg')}}">
                        </div>

                        <div>
                            <h1 class="txtElement col100">{{$m->title}}</h1>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    @endforeach

    @auth
        <div class="buttonAdd">
            <a href="{{route('movie.create')}}">
                <button></button>
            </a>
        </div>
    @endauth
    
    
    <script>
         $(document).ready(function() {
            //Comprobar existencia de errores para ser mostrados
            @if (session('error'))
                modalWindow("{{ session('error')}}", 0, null);
            @endif

            //Asignar el metodo de borrado a los botones de eliminar pasandoles su id correspondiente
            $(".fbDelete").click(function(){               
                var id = $(this).attr("id").replace('bRemove', '');
                var txt = "¿Desea eliminar la pelicula?";
                //Llamada a la ventana modal indicando que metodo debe ejecutar si se acepta el usuario
                modalWindow(txt, 1, "removeMovieAjax("+id+")");
            });

         });

        /*
        * METODO PARA ENVIAR LA PETICION DE ELIMINACION POR AJAX AL SERVIDOR
        * Y ELIMINAR EL ELEMENTO HTML
        */
        function removeMovieAjax(id, route){           
            var rute = "{{ route('movie.destroy', 'req_id') }}".replace('req_id', id)
            $.ajax({
                url: rute,
                type: 'delete',
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success:function(result){
                    //Si nos devuelve el codigo de la pelicula eliminada, borramos el elemento HTML
                    if(result['status']){                        
                        $("#mov"+result['id']).remove();
                    }else{
                        modalWindow(result['error'], 0, null);
                    }
                }
            });
        }
    </script>
@endsection
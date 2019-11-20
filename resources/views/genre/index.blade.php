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

    <!-- CONTENIDO -->
    @foreach ($genres as $gen)
        <div id="gen{{$gen->id}}" class="col33 genreElement">
            <div class="marginGenre">
            
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

                <!-- CONTENEDOR DE GENERO -->
                <a href="{{route('movie.showByGenre', $gen->id)}}">
                    <div class="col100 genreContent layer10">
                        <div class="col20">
                            <div class="imgAspectRatio11">
                                <img class="imgRound"src="{{$gen->image ? url('/img/genres/'.$gen->image) : url('/img/genre.png')}}">
                            </div>
                        </div>

                        <div class="col80 txtGenre">
                            <h2>{{$gen->description}}</h2>
                        </div>
                    </div>
                </a>

            </div>
        </div>
    @endforeach

    <div class="buttonAdd">
        <a href="{{route('genre.create')}}">
            <button></button>
        </a>
    </div>
    

    <script>
        $(document).ready(function() {
            //Asignar el metodo de borrado a los botones de eliminar pasandoles su id correspondiente
            $(".fbDelete").click(function(){               
                removeGenreAjax($(this).attr("id").replace('bRemove', ''));
            });

         });

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
                        alert(result['error']);
                    }
                }
            });
        }
    </script>
@endsection
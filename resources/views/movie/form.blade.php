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

    <!-- CONTENIDO -->
    <center>
        <div id="formMovie">
            @if ($action=='edit')
                <form id="fmmovie" enctype='multipart/form-data' action="{{route('movie.update', $data->id)}}" method="post">    
                    @csrf
                    <input type="hidden" name="_method" value="PATCH">
            @else
                <form id="fmmovie" enctype='multipart/form-data' action="{{route('movie.store')}}" method="post">
                    @csrf
            @endif
                <div class="col25">
                    <img id="posterFormImg" src="{{isset($data) && $data->poster!=null ? url('/img/movies/'.$data->poster) : url('/img/uploadPoster.png')}}" onclick="$('#browsePoster').trigger('click')">
                    
                    <div class="groupField" style="display:none">    
                        <input type="file" name="poster" accept=".png, .jpg, .jpeg" id="browsePoster">
                    </div>
                </div>

                <div class="col75"> 
                    <div class="groupField">
                        <input class="inpForm" type="text" name="title" placeholder=" " autocomplete="off" required value="{{$data->title ?? ""}}">
                        <label class="labForm" for="title">Titulo</label><br>  
                    </div>
                    
                    <div class="groupField">
                        <textarea class="inpForm textarea" type="text" name="sinopsis" placeholder=" " autocomplete="off" required>{{$data->sinopsis ?? ""}}</textarea>
                        <label class="labForm" for="sinopsis">Sinopsis</label><br>  
                    </div>

                    <div class="groupField">
                        <input class="inpForm" type="number" name="duration" placeholder=" " autocomplete="off" required value="{{$data->duration ?? ""}}">
                        <label class="labForm" for="duration">Duración (min)</label><br>  
                    </div>
                    
                    <div class="groupField">
                        <input class="inpForm" type="number" name="year" placeholder=" " autocomplete="off" required value="{{$data->year ?? ""}}">
                        <label class="labForm" for="year">Año</label><br>  
                    </div>

                    <div class="groupField">
                        <input class="inpForm" type="number" name="rating" placeholder=" " autocomplete="off" required value="{{$data->rating ?? ""}}">
                        <label class="labForm" for="rating">Puntuacion</label><br>  
                    </div>

                    @if (isset($genres))
                        <select name="genres[]" form="fmmovie" multiple style="width:80%">
                            @foreach ($genres as $gen)
                            <!-- Comprobamos si el genero esta relacionado con la pelicula para marcarlo -->
                                <option value="{{$gen->id}}" 
                                
                                    @foreach ($data->genres as $genRel)
                                    @if ($genRel->id == $gen->id)
                                        selected
                                    @endif
                                @endforeach

                                >{{$gen->description}}</option>       
                            @endforeach
                        </select>
                    @endif

                    <!-- 
                        ?? es una variacion del operador ternario, si existe la variable, escribe su valor en caso contrario,
                        aquello especificado despues de la doble interrogacion
                    -->
                </div>
                
                <div class="col100">
                    <input class="bSubmit button" class="button" type="submit" value="{{$action=='edit'?"Actualizar":"Guardar"}}">      
                </div>
            </form>          
        </div>
    </center>

    <script>

        //PREVISUALIZACION DE POSTAR CARGADO
        function loadPreview(input) {
            if (input.files && input.files[0]) {
                //Establecer como atributo de la imagen la ruta de la imagen seleccionada
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#posterFormImg').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }else{
                $('#posterFormImg').attr('src', "{{url('/img/generic.jpg')}}");
            }
        }

        //Detectar examinacion de una imagen en el formulario
        $("#browsePoster").change(function() {
            loadPreview(this);
        });

    </script>
@endsection
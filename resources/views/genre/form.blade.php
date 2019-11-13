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
                {{$action=='edit'?"Editar Género":"Nuevo Género"}}
            </h1>
            <div class="subTitleHeader">
            </div>
        </div>
        </center>
    </div>

    <!-- CONTENIDO -->
    <center>
        <div id="formGenre">
            @if ($action=='edit')
                <form enctype='multipart/form-data' action="{{route('genre.update', $data->id)}}" method="post">    
                    @csrf
                    <input type="hidden" name="_method" value="PATCH">
            @else
                <form enctype='multipart/form-data' action="{{route('genre.store')}}" method="post">
                    @csrf
            @endif
                <div class="col25">
                    <img id="posterFormImg" src="{{isset($data) && $data->image!=null ? url('/img/genres/'.$data->image) : url('/img/uploadPoster.png')}}" onclick="$('#browsePoster').trigger('click')">
                    
                    <div class="groupField" style="display:none">    
                        <input type="file" name="image" accept=".png, .jpg, .jpeg" id="browsePoster">
                    </div>
                </div>

                <div class="col75"> 
                    <div class="groupField">
                        <input class="inpForm" type="text" name="description" placeholder=" " autocomplete="off" required value="{{$data->description ?? ""}}">
                        <label class="labForm" for="description">Nombre</label><br>  
                    </div>
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
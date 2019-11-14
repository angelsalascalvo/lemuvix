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
                {{$action=='edit'?"Editar Persona":"Nueva Persona"}}
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
                <form enctype='multipart/form-data' action="{{route('person.update', $data->id)}}" method="post">    
                    @csrf
                    <input type="hidden" name="_method" value="PATCH">
            @else
                <form enctype='multipart/form-data' action="{{route('person.store')}}" method="post">
                    @csrf
            @endif
                <div class="col25">
                    <div class="imgAspectRatio11">
                        <img class="imgRound" id="imgUpload" src="{{isset($data) && $data->photo!=null ? url('/img/people/'.$data->photo) : url('/img/uploadPoster.png')}}" onclick="$('#browseImage').trigger('click')">
                    </div>

                    <div class="groupField" style="display:none">    
                        <input type="file" name="photo" accept=".png, .jpg, .jpeg" id="browseImage">
                    </div>
                </div>

                <div class="col75"> 
                    <div class="groupField">
                        <input class="inpForm" type="text" name="name" placeholder=" " autocomplete="off" required value="{{$data->name ?? ""}}">
                        <label class="labForm" for="name">Nombre</label><br>  
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
                    $('#imgUpload').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }else{
                $('#imgUpload').attr('src', "{{url('/img/generic.jpg')}}");
            }
        }

        //Detectar examinacion de una imagen en el formulario
        $("#browseImage").change(function() {
            loadPreview(this);
        });

    </script>
@endsection
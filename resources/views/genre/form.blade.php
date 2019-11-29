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
                <form id="formGenPer" enctype='multipart/form-data' action="{{route('genre.update', $data->id)}}" method="post">    
                    @csrf
                    <input type="hidden" name="_method" value="PATCH">
            @else
                <form id="formGenPer" enctype='multipart/form-data' action="{{route('genre.store')}}" method="post">
                    @csrf
            @endif
                <div class="col100">
                    <center>
                        <div class="width25">
                            <div class="imgAspectRatio11">
                                <img class="imgRound" id="imgUpload" src="{{isset($data) && $data->image!=null ? url('/img/genres/'.$data->image) : url('/img/uploadGenre.png')}}">
                                <img class="imgHover imgRound" src="{{url('/img/uploadGenre2.png')}}" onclick="$('#browseImage').trigger('click')">
                            </div>

                            <div class="groupField" style="display:none">    
                                <input type="file" name="image" accept=".png, .jpg, .jpeg" id="browseImage">
                            </div>
                        </div>

                        <div class="groupField @error('description') invalid @enderror">
                            <input class="inpForm" type="text" name="description" placeholder=" " autocomplete="off" required value="{{old('description')?? ($data->description ?? "")}}">
                            <label class="labForm" for="description">Nombre</label><br>  
                            @error('description')
                                <div class="invalidTxt">{{ $message }}</div>
                            @enderror
                            <br>
                        </div>

                        <div class="col100">
                            <input class="bSubmit button" class="button" type="submit" value="{{$action=='edit'?"Actualizar":"Guardar"}}">      
                        </div>
                    </center>
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
                $('#imgUpload').attr('src', "{{url('/img/uploadGenre.png')}}");
            }
        }

        //Detectar examinacion de una imagen en el formulario
        $("#browseImage").change(function() {
            loadPreview(this);
        });

    </script>
@endsection
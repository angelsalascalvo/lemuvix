@extends('layouts/master')

@if ($action=='edit')
    @section('title', 'Editar Pelicula')
@else
    @section('title', 'Nueva Pelicula')
@endif

<!-- VENTANA EMERGENTE -->
@section('contentEmergent')
    <div id="emergent" style="display:none;">
        <div class="backgroundBlack"></div>
        <div class="emerWindow centerChildVH">
            <div>
                <button id="closeEmergent">X</button>
            </div>
            <center>
                <div class="width60">
                    <h3 id="titleEmergent"></h3>   
                    <div class="searchBarGen">
                        <input placeholder="Buscar...">
                        <button><img src="{{ url('/img/search.png')}}"></button>
                    </div>

                    <div class="listOptions col100">
                        <div class="option centerParent">
                            <div class="imgOption centerChildV">
                                <div class=" imgAspectRatio11">
                                    <img class="imgRound" src="{{url('/img/uploadPoster.png')}}">
                                </div>
                            </div>
                
                            <div class="textOption">
                                <span class="centerChildV">Nuevo...</span>
                            </div>
                        </div>
                    </div>
                    <div class="col100">
                        <center>
                            <button id="emergetAcept" disabled class="width80">Aceptar</button>
                        </center>
                    </div>
                </div>
            </center>
        </div>
    </div>
@endsection

<!-- SECCION DE CONTENIDO --> 
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
                    <div class="imgAspectRatioA4">
                        <img class="imgBorderRound" id="imgUpload" src="{{isset($data) && $data->poster!=null ? url('/img/movies/'.$data->poster) : url('/img/uploadPoster.png')}}" onclick="$('#browseImage').trigger('click')">
                    </div>

                    <div class="groupField" style="display:none">    
                        <input type="file" name="poster" accept=".png, .jpg, .jpeg" id="browseImage">
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

                    <div id="arrayGenres" class="col100">
                        <label>Generos</label>
                        <button id="addGenre" type="button">Agregar</button>
                        <div class="containerElementsMovie">

                                <div class="option elementMovie centerParent">
                                    <div class="imgOption centerChildV">       
                                        <!--boton eliminar-->
                                        <div style="display:none;" class="floatButtons transform30XY col100 layer20">
                                            <div class="sizefbMovieForm">
                                                    <button class="fbDelete"></button>
                                            </div>
                                        </div>                         
                                        <div class=" imgAspectRatio11">
                                            <img class="imgRound" src="{{url('/img/uploadPoster.png')}}">
                                        </div>
                                    </div>
                        
                                    <div class="textOption">
                                        <span class="centerChildV"><strong>Agregar</strong></span>
                                    </div>
                                </div>
                        </div>
                    </div>
                    
                    <div id="arrayActors" class="col100">
                        <label>Dirección</label>
                        <button id="addDirectors" type="button">Agregar</button>
                    </div>

                    <div id="arrayDirectors" class="col100">
                        <label>Reparto</label>
                        <button id="addActors" type="button">Agregar</button>
                        
                    </div>


                
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

        var selectedID = null;
        var allElements = [];
        var genresSelected = [];
        var directorsSelected = [];
        var actorsSelected = [];
    
        $(document).ready(function() {
            $(".backgroundBlack").click(showEmergent);
            $("#closeEmergent").click(showEmergent);

            //Boton añadir genero
            $("#addGenre").click(function(){
                $("#emergetAcept").click(function(){acept("genre")});
                emergentGenres();
                showEmergent();
            });

            //Boton añadir directores
            $("#addDirectors").click(function(){
                $("#emergetAcept").click(function(){acept("director")});
                emergentPeople("Seleccionar Dirección", directorsSelected);
                showEmergent();
            });

            //Boton añadir actores
            $("#addActors").click(function(){
                $("#emergetAcept").click(function(){acept("actor")});
                emergentPeople("Seleccionar Reparto", actorsSelected);
                showEmergent();
            });

            //Rellenar array con elementos previamente asociados (si estamos editando)
            //Crear elementos ocultos para el array correspondiente
            @if ($action=='edit')
                @json($data->genres).forEach(element => {
                    genresSelected.push(element.id);
                    $('#arrayGenres').append("<input type='hidden' name='genres[]' value='"+element.id+"'>")
                });
                @json($data->directors).forEach(element => {
                    directorsSelected.push(element.id);
                    $('#arrayDirectors').append("<input type='hidden' name='directors[]' value='"+element.id+"'>")
                });
                @json($data->actors).forEach(element => {
                    actorsSelected.push(element.id);
                    $('#arrayActors').append("<input type='hidden' name='actors[]' value='"+element.id+"'>")
                });
            @endif
        });

        //--------------------------------------------------------------------------------

        //METODO QUE SE EJECUTARÁ AL PULSAR SOBRE EL BOTON ACEPTAR 
        function acept(type){            
            switch (type){
                case "genre":
                    genresSelected.push(selectedID);
                    $('#arrayGenres').append("<input type='hidden' name='genres[]' value='"+selectedID+"'>")
                break;

                case "director":
                    directorsSelected.push(selectedID);
                    $('#arrayDirectors').append("<input type='hidden' name='directors[]' value='"+selectedID+"'>")
                break;

                case "actor":
                    actorsSelected.push(selectedID);
                    $('#arrayActors').append("<input type='hidden' name='actors[]' value='"+selectedID+"'>")
                break;
            }
        
            //Ocultar ventana
            showEmergent();
        }

        //--------------------------------------------------------------------------------

        //METODO PARA MOSTRAR U OCULTAR LA VENTANA EMERGENTE
        function showEmergent(){
            if($("#emergent").is(':visible')){
                $("#emergent").hide();
                //Desactivar accion de click de aceptar para establecer nuevo al mostrar de nuevo la ventana
                $("#emergetAcept").unbind( "click" );
            }else{
                $("#emergent").show();
            }
        }

        //--------------------------------------------------------------------------------

        //FUNCION PARA ALMACENAR EL ELEMENTO SELECCIONADO Y MARCARLO
        function selected(elementOption){
            $("#emergetAcept").removeAttr("disabled");
            selectedID = elementOption.attr("id");
            //Recorrer todos los elentos para desmarcarlos
            allElements.forEach(element => {
                element.removeClass("markedOption");
            });
            //Marcar el elemento seleccionado
            elementOption.addClass("markedOption");
        }

        //--------------------------------------------------------------------------------

        //METODO PARA VACIAR EL LISTADO DE OPCIONES
        function clearOptions(){
            $(".listOptions .option").each(function(){
                if(!($(this).is(':first-child'))){
                    $(this).remove();
                }
            });
        }

        //--------------------------------------------------------------------------------

        //RELLENAR VENTANA EMERGENTE CON LOS GENEROS DISPONIBLES
        function emergentGenres(){
            var genres = @json($genres);
            var url = "{{url('/')}}";
            //Cambiar titulo
            $("#titleEmergent").text("Seleccionar Genero");

            //Limpiar contenido de la ventana
            clearOptions();
            $("#emergetAcept").prop('disabled', true);

            //Recorrer cada uno de los generos pasados a la vista
            genres.forEach(element => {
                var add = true;

                //Recorrer los elementos seleccionados
                genresSelected.forEach(selected => {
                    if(selected == element.id){
                        add=false;
                    }
                });

                //Agregamos el elemento si no se ha seleccionado
                if(add){
                    var htmlElement = $(".listOptions .option:first").clone(true); 
                
                    //Imagen
                    if(element.image != null){
                        htmlElement.find("img").attr("src", url+"/img/genres/"+element.image);
                    }else{
                        htmlElement.find("img").attr("src", url+"/img/generic.jpg");
                    }
                    //Texto
                    htmlElement.find("span").text(element.description)
                    //Id
                    htmlElement.attr("id", element.id);
                    htmlElement.click(function(){selected(htmlElement)});

                    //Agregar elemento
                    allElements.push(htmlElement);
                    $(".listOptions").append(htmlElement);
                }
            });
        }

        //--------------------------------------------------------------------------------
        
        //RELLENAR VENTANA EMERGENTE CON LAS PERSONAS DISPONIBLES
        function emergentPeople(title, arraySelected){
            var people = @json($people);
            var url = "{{url('/')}}";

            //Cambiar titulo
            $("#titleEmergent").text(title);

            //Limpiar contenido de la ventana
            clearOptions();
            $("#emergetAcept").prop('disabled', true);

            //Recorrer cada uno de los generos pasados a la vista
            people.forEach(element => {
                var add = true;

                //Recorrer los elementos seleccionados
                arraySelected.forEach(selected => {
                    if(selected == element.id){
                        add=false;
                    }
                });

                //Agregamos el elemento si no se ha seleccionado
                if(add){
                    var htmlElement = $(".listOptions .option:first").clone(true); 
                
                    //Imagen
                    if(element.photo != null){
                        htmlElement.find("img").attr("src", url+"/img/people/"+element.photo);
                    }else{
                        htmlElement.find("img").attr("src", url+"/img/generic.jpg");
                    }
                    //Texto
                    htmlElement.find("span").text(element.name)
                    htmlElement.attr("id", element.id);

                    //Al hacer clic sobre cada elemento se llama a la funcion que almacena su id
                    htmlElement.click(function(){selected(htmlElement)});

                    //Agregar elemento
                    allElements.push(htmlElement);
                    $(".listOptions").append(htmlElement);
                }
            });
        }

        //--------------------------------------------------------------------------------

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

        //--------------------------------------------------------------------------------

        //Detectar examinacion de una imagen en el formulario
        $("#browseImage").change(function() {
            loadPreview(this);
        });

    </script>
@endsection
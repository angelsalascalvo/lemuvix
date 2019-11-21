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

            <div class="closeEmergentContent col100">
                <button id="closeEmergent">X</button>
            </div>

            <center>
                <div class="width60">
                    <h3 id="titleEmergent"></h3>   
                    <div class="searchBarGen">
                        <input id="bar" placeholder="Buscar...">
                        <button><img src="{{ url('/img/search.png')}}"></button>
                    </div>

                    <div class="listOptions col100">
                        <div class="option centerParent">
                            <div class="imgOption centerChildV">
                                <div class=" imgAspectRatio11">
                                    <img class="imgRound" src="{{url('/img/addElement1.png')}}">
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
            <!-- CONTROL DE ERRORES -->

                <div class="col25">
                    <div class="imgAspectRatioA4">
                        <img class="imgBorderRound" id="imgUpload" src="{{isset($data) && $data->poster!=null ? url('/img/movies/'.$data->poster) : url('/img/uploadPoster.png')}}">
                        <img class="imgHover imgBorderRound" src="{{url('/img/uploadPoster2.png')}}" onclick="$('#browseImage').trigger('click')">
                    </div>

                    <div class="groupField" style="display:none">    
                        <input type="file" name="poster" accept=".png, .jpg, .jpeg" id="browseImage">
                    </div>
                </div>

                <div class="col75"> 
                    <div class="groupField @error('title') invalid @enderror">
                        <!-- Con la accion de value rellenamos con el dato introducido si se produce un error o con el dato ya guardado si estamos editando -->
                        <input class="inpForm" type="text" name="title" placeholder=" " autocomplete="off" required  value="{{ old('title')?? ($data->title ?? "")}}">
                        <label class="labForm" for="title">Titulo</label>
                        @error('title')
                            <div class="invalidTxt">{{ $message }}</div>
                        @enderror
                        <br>  
                    </div>
                    
                    <div class="groupField @error('sinopsis') invalid @enderror">
                        <textarea class="inpForm textarea" type="text" name="sinopsis" placeholder=" " required autocomplete="off" >{{old('sinopsis')?? ($data->sinopsis ?? "")}}</textarea>
                        <label class="labForm" for="sinopsis">Sinopsis</label>
                        @error('sinopsis')
                            <div class="invalidTxt">{{ $message }}</div>
                        @enderror
                        <br>  
                    </div>

                    <div class="groupField @error('duration') invalid @enderror">
                        <input class="inpForm" type="number" name="duration" placeholder=" " autocomplete="off" required value="{{old('duration')?? ($data->duration ?? "")}}">
                        <label class="labForm" for="duration">Duración (min)</label>
                        @error('duration')
                            <div class="invalidTxt">{{ $message }}</div>
                        @enderror
                        <br> 
                    </div>
                    
                    <div class="groupField @error('year') invalid @enderror">
                        <input class="inpForm" type="number" name="year" placeholder=" " autocomplete="off" required value="{{old('year')?? ($data->year ?? "")}}">
                        <label class="labForm" for="year">Año</label>
                        @error('year')
                            <div class="invalidTxt">{{ $message }}</div>
                        @enderror
                        <br> 
                    </div>

                    <div class="groupField @error('rating') invalid @enderror">
                        <input class="inpForm" type="number" name="rating" placeholder=" " autocomplete="off" required value="{{old('rating')?? ($data->rating ?? "")}}">
                        <label class="labForm" for="rating">Puntuacion</label>
                        @error('rating')
                            <div class="invalidTxt">{{ $message }}</div>
                        @enderror
                        <br>  
                    </div>

                    <!-- Seccion Generos -->
                    <div id="arrayGenres" class="col100">
                        <div class="sectionTitleFMovie">
                            <label>Generos</label>
                        </div>

                        <div id="containerGenres" class="containerElementsMovie">
                            <div id="addGenres">
                                <div class="elementMovie col centerParent">
                                    <div class="imgElementMovie">
                                        <!--boton eliminar-->
                                        <div style="display:none" class="floatButtons transform30XY col100 layer20">
                                            <div class="sizefbMovieForm">
                                                <button type="button" class="fbDelete"></button>
                                            </div>
                                        </div>        

                                        <div class="imgAspectRatio11">
                                            <img class="imgRound" src="{{url('/img/addElement.png')}}">
                                        </div>
                                    </div>

                                    <div class="col txtElementMovie">
                                        <span><strong>Agregar</strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Seccion Dirección -->
                    <div id="arrayDirectors" class="col100">
                        <div class="sectionTitleFMovie sectionFMovieMargin">
                            <label>Dirección</label>
                        </div>

                        <div id="containerDirectors" class="containerElementsMovie">
                            <div id="addDirectors">
                                <div class="elementMovie col centerParent">
                                    <div class="imgElementMovie">
                                        <!--boton eliminar-->
                                        <div style="display:none" class="floatButtons transform30XY col100 layer20">
                                            <div class="sizefbMovieForm">
                                                <button type="button" class="fbDelete"></button>
                                            </div>
                                        </div>        

                                        <div class="imgAspectRatio11">
                                            <img class="imgRound" src="{{url('/img/addElement.png')}}">
                                        </div>
                                    </div>

                                    <div class="col txtElementMovie">
                                        <span><strong>Agregar</strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Seccion Directores -->
                    <div id="arrayActors" class="col100">
                        <div class="sectionTitleFMovie sectionFMovieMargin">
                            <label>Reparto</label>
                        </div>
                        <div id="containerActors" class="containerElementsMovie">
                            <div id="addActors">
                                <div class="elementMovie col centerParent">
                                    <div class="imgElementMovie">
                                        <!--boton eliminar-->
                                        <div style="display:none" class="floatButtons transform30XY col100 layer20">
                                            <div class="sizefbMovieForm">
                                                <button type="button" class="fbDelete"></button>
                                            </div>
                                        </div>        

                                        <div class="imgAspectRatio11">
                                            <img class="imgRound" src="{{url('/img/addElement.png')}}">
                                        </div>
                                    </div>

                                    <div class="col txtElementMovie">
                                        <span><strong>Agregar</strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
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

        var selectedElement = null;
        var allElements = [];
        var genresSelected = [];
        var directorsSelected = [];
        var actorsSelected = [];
    
        $(document).ready(function() {
            $(".backgroundBlack").click(showEmergent);
            $("#closeEmergent").click(showEmergent);

            //Boton añadir genero
            $("#addGenres").click(function(){
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
                    $('#arrayGenres').append("<input type='hidden' class='genreForm' name='genres[]' value='"+element.id+"'>")
                    addGraphicGenre(element);
                });
                @json($data->directors).forEach(element => {
                    directorsSelected.push(element.id);
                    $('#arrayDirectors').append("<input type='hidden' class='directorForm' name='directors[]' value='"+element.id+"'>")
                    addGraphicPeople(element, "director");
                });
                @json($data->actors).forEach(element => {
                    actorsSelected.push(element.id);
                    $('#arrayActors').append("<input type='hidden' class='actorForm' name='actors[]' value='"+element.id+"'>")
                    addGraphicPeople(element, "actor");
                });
            @endif

            search();
        });

        //METODO PARA AGREGAR EL ELEMENTO GRAFICO DE GENERO A LA VISTA
        function addGraphicGenre(element){
            var url = "{{url('/')}}";
            var htmlElement = $("#containerGenres .elementMovie:first").clone(true); 
            //Imagen
            if(element.image != null){
                htmlElement.find("img").attr("src", url+"/img/genres/"+element.image);
            }else{
                htmlElement.find("img").attr("src", url+"/img/genre.jpg");
            }
            //Texto
            htmlElement.find("span").text(element.description);
            //Boton eliminar
            htmlElement.find("button").click(function(){removeGraphicGenre(element.id, htmlElement)});
            htmlElement.find(".floatButtons").show();
            //Agregar el elemento a su padre
            $("#containerGenres").append(htmlElement);
        }

        //METODO PARA ELIMINAR EL ELEMENTO GRAFICO DE GENERO DE LA VISTA
        function removeGraphicGenre(id, htmlElement){
            //Eliminar elemento html
            htmlElement.remove();

            //Eliminar campo del formulario
            $(".genreForm").each(function(){                
                if($(this).val()==id){
                    $(this).remove();
                }
            });

            //Eliminar del listado de seleccionados
            genresSelected = jQuery.grep(genresSelected, function(value) {
                return value != id;
            });
        }

        //METODO PARA AGREGAR EL ELEMENTO GRAFICO DE PERSONA A LA VISTA
        function addGraphicPeople(element, type){
            var url = "{{url('/')}}";

            if(type=="actor"){
                //Duplicar Elemento
                var htmlElement = $("#containerActors .elementMovie:first").clone(true); 
            }else{
                var htmlElement = $("#containerDirectors .elementMovie:first").clone(true); 
            }
            
            //Imagen
            if(element.photo != null){
                htmlElement.find("img").attr("src", url+"/img/people/"+element.photo);
            }else{
                htmlElement.find("img").attr("src", url+"/img/person.png");
            }
            //Texto
            htmlElement.find("span").text(element.name);
            //Boton eliminar
            htmlElement.find("button").click(function(){removeGraphicPeople(element.id, htmlElement, type)});
            htmlElement.find(".floatButtons").show();
            //Agregar el elemento a su padre
            if(type=="actor"){
                $("#containerActors").append(htmlElement);
            }else{
                $("#containerDirectors").append(htmlElement);
            }

        }

        //METODO PARA ELIMINAR EL ELEMENTO GRAFICO DE PERSONA DE LA VISTA
        function removeGraphicPeople(id, htmlElement, type){
            //Eliminar elemento html
            htmlElement.remove();

            if(type=="actor"){
                //Eliminar campo del formulario
                $(".actorForm").each(function(){                
                    if($(this).val()==id){
                        $(this).remove();
                    }
                });
                 //Eliminar del listado de seleccionados
                actorsSelected = jQuery.grep(actorsSelected, function(value) {
                    return value != id;
                });

            }else{
                //Eliminar campo del formulario
                $(".directorForm").each(function(){                
                    if($(this).val()==id){
                        $(this).remove();
                    }
                });
                 //Eliminar del listado de seleccionados
                directorsSelected = jQuery.grep(directorsSelected, function(value) {
                    return value != id;
                });
            }

           
        }

        //--------------------------------------------------------------------------------

        //METODO QUE SE EJECUTARÁ AL PULSAR SOBRE EL BOTON ACEPTAR 
        function acept(type){            
            switch (type){
                case "genre":
                    genresSelected.push(selectedElement.id);
                    $('#arrayGenres').append("<input type='hidden' class='genreForm' name='genres[]' value='"+selectedElement.id+"'>");
                    addGraphicGenre(selectedElement);
                break;

                case "director":
                    directorsSelected.push(selectedElement.id);
                    $('#arrayDirectors').append("<input type='hidden' class='directorForm' name='directors[]' value='"+selectedElement.id+"'>");
                    addGraphicPeople(selectedElement,"director");
                break;

                case "actor":
                    actorsSelected.push(selectedElement.id);
                    $('#arrayActors').append("<input type='hidden' class='actorForm' name='actors[]' value='"+selectedElement.id+"'>");
                    addGraphicPeople(selectedElement,"actor");
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
        function selected(elementOption, elementHtml){
            $("#emergetAcept").removeAttr("disabled");
            selectedElement = elementOption;

            //Recorrer todos los elentos para desmarcarlos
            allElements.forEach(element => {
                element.removeClass("markedOption");
            });

            //Marcar el elemento seleccionado
            elementHtml.addClass("markedOption");
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
            $("#bar").val("");

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
                        htmlElement.find("img").attr("src", url+"/img/person.png");
                    }
                    //Texto
                    htmlElement.find("span").text(element.description)
                    //Id
                    htmlElement.attr("id", element.id);
                    htmlElement.click(function(){selected(element, htmlElement)});

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
            $("#bar").val("");

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
                        htmlElement.find("img").attr("src", url+"/img/person.png");
                    }
                    //Texto
                    htmlElement.find("span").text(element.name)
                    htmlElement.attr("id", element.id);

                    //Al hacer clic sobre cada elemento se llama a la funcion que almacena su id
                    htmlElement.click(function(){selected(element, htmlElement)});

                    //Agregar elemento
                    allElements.push(htmlElement);
                    $(".listOptions").append(htmlElement);
                }
            });
        }

        //--------------------------------------------------------------------------------

        //BUSCAR ELEMENTOS
        function search(){
            $("#bar").on("keyup", function() {
                for(var i =0; i<allElements.length;i++){
                    var listElement = removeDiacritic(allElements[i].find("span").text().toLowerCase());

                    if(listElement.indexOf($(this).val().toLowerCase()) >= 0){
                        allElements[i].show();
                    }else{
                        
                        allElements[i].hide();
                    }
                }
            });
        }

        //METODO PARA ELIMINAR L
        function removeDiacritic(texto) {
            return texto
           .normalize('NFD')
           .replace(/([^n\u0300-\u036f]|n(?!\u0303(?![\u0300-\u036f])))[\u0300-\u036f]+/gi,"$1")
           .normalize();
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
                $('#imgUpload').attr('src', "{{url('/img/uploadPoster.png')}}");
            }
        }

        //--------------------------------------------------------------------------------

        //Detectar examinacion de una imagen en el formulario
        $("#browseImage").change(function() {
            loadPreview(this);
        });

    </script>
@endsection
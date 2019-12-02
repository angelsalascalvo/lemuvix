<html>
    <head>
        <link rel="stylesheet" href="{{ url('css/style.css')}}" />
        <link rel="stylesheet" href="{{ url('css/sizes.css')}}" />
        <link rel="icon" type="image/png" href="{{ url('img/favicon.png')}}" />
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <title>
            @yield('title')
        </title>
    </head>
    <body>

        <!-- VENTANA EMERGENTE GENERICA PARA CONFIRMACION E INFORMACION-->
        <div id="emergentAction" style="display:none;">
            <div class="backgroundBlack backModal"></div>
            <div class="emerWindow2 centerChildVH">

                <div class="closeEmergentContent col100">
                    <button id="closeEmergentModal"><img src="{{ url('/img/close.png')}}"></button>
                </div>

                <center>
                    <div class="width60">
                        <div id="txtEmergent" class="col100">
                            <span></span>
                        </div>
                        <div id="buttonsEmergent" class="marginButtons col100">
                            <div class="col45">
                                <button id="cancelConfirm" class="col100">Cancelar</button>
                            </div>
                            <div class="col10" style="height:1px;">
                            </div>
                            <div class="col45">
                                <button id="aceptConfim" class="col100">Aceptar</button>
                            </div>
                        </div>

                        <div id="buttonAcept" class="marginButtons col100">
                            <center>
                                <button id="aceptInfo" class="width80">Aceptar</button>
                            </center>
                        </div>
                    </div>
                </center>
            </div>
        </div>

        <!-- BARRA SUPERIOR -->
        <div id="topBar">
            <!-- LOGOTIPO -->
            <div id="logoBar">
                <a href="{{route('movie.index')}}">
                    <img src="{{ url('/img/logo.png')}}">
                </a>
            </div>

            <!-- BARRA BUSQUEDA -->
            @if (isset($showBar) && $showBar=='true')
                <div id="searchBar" class="searchBarGen">
                    <input id="barSearchTop" placeholder="Buscar...">
                    <button><img src="{{ url('/img/search.png')}}"></button>
                </div>
            @endif

            <!-- MENU -->
            <div id="menu">
                    <a class="elementMenu" href="{{route('movie.index')}}">
                        <div >
                            <span>Peliculas</span>
                            @if (url()->current()=="http://lemuvix.test" || strpos(url()->current(), '/movie')!==false)
                                <div class="markMenu"></div>
                            @endif      
                        </div>
                    </a>

                    <a class="elementMenu" href="{{route('genre.index')}}">
                        <div>
                            <span>Generos</span>
                            @if (strpos(url()->current(), '/genre')!==false)
                                <div class="markMenu"></div>
                            @endif      
                        </div>
                    </a>

                    <a class="elementMenu" href="{{route('person.index')}}">
                        <div>
                            <span>Personas</span>
                            @if (strpos(url()->current(), '/person')!==false)
                                <div class="markMenu"></div>
                            @endif      
                        </div>
                    </a>

                @auth
                    <a class="elementMenu" href="{{route('user.index')}}">
                        <div>
                            <span>Usuarios</span>
                            @if (strpos(url()->current(), '/user')!==false)
                                <div class="markMenu"></div>
                            @endif      
                        </div>
                    </a>


                        <div class="elementMenu">
                        <form class="convertFormButton" action="{{route('logout')}}" method="POST">
                            @csrf
                            <button class="noButtonStyle">Cerrar sesion</button>
                        </form>
                        </div>
                    
                @endauth
                <!-- Solo para usuarios no registrados -->
                @guest
                    <a class="elementMenu" href="{{route('login')}}">
                        <div>
                            <strong><span>Acceder</span></strong>
                        </div>
                    </a>
                @endguest
            </div>
        </div>

        <!-- CONTENIDO -->
        @yield('contentEmergent')
        
        <div class='content'>
            <div class="margin">
                @yield('content')
            </div>
        </div>

        <!-- PIE DE PAGINA -->
        @if (isset($footer) && $footer=='big')
            <footer class="col100 layer30">
                <div class="imgFooter">
                        <img src="{{url('img/footer.png')}}">
                </div>
                <div class="linksFooter">
                    <div class="col10 colFooter">
                        <img src="{{url('img/favicon.png')}}">
                    </div>
                    <div class="col10 colFooter">
                        <ul>
                            <a href="{{route('movie.index')}}"><li>Peliculas</li></a>
                            <a href="{{route('genre.index')}}"><li>Generos</li></a>
                            <a href="{{route('person.index')}}"><li>Actores y Directores</li></a>
                        </ul>
                    </div>
                    <div class="col10 colFooter">
                        <ul>
                            <a href="{{route('login')}}"><li>Acceder</li></a>
                            <a href="{{route('user.index')}}"><li>Usuarios</li></a>
                            <li>&nbsp</li>
                        </ul>
                    </div>
                </div>
            </footer>            
        @endif
    </body>

    <script>
        /**
        * INICIO DE EJECUCION
        */
        $(document).ready(function() {
            //Inicializaciones
            $(".backModal").click(showModalWindow);
            $("#closeEmergentModal").click(showModalWindow);
            searchBar();
            checkOffset();
            
            //Ejecutar al hacer scroll
            $(document).scroll(checkOffset); 
        });

        //----------------------------------------------------------------------------------------

        /**
        * METODO PARA CONFIRMAR UNA ACCION A TRAVES DE LA VENTANA MODAL
        */
        function modalWindow(txt, type, executeFunc){
            //type 0 -> info
            //Type 1 -> confirm
            $("#aceptConfim").unbind( "click" );
            $("#emergentAction").show();
            $("#txtEmergent span").text(txt);

            //Para ventana de mostrar informacion
            if(type==0){
                $("#buttonAcept").show();
                $("#buttonsEmergent").hide();
                $("#aceptInfo").click(function(){
                    $("#emergentAction").hide();
                });

            //Para ventanas de confirmar accion
            }else{
                $("#buttonAcept").hide();
                $("#buttonsEmergent").show();
                $("#cancelConfirm").click(function(){
                    $("#emergentAction").hide();
                });
                $("#aceptConfim").click(function(){
                    eval(executeFunc);
                    $("#emergentAction").hide();
                });
            }
        }

        //----------------------------------------------------------------------------------------

        /**
        * METODO PARA MOSTRAR U OCULTAR LA VENTANA EMERGENTE
        */
        function showModalWindow(){
            if($("#emergentAction").is(':visible')){
                $("#emergentAction").hide();
            }else{
                $("#emergentAction").show();
            }
        }

        //----------------------------------------------------------------------------------------

        /**
        * METODO PARA HACER QUE EL BOTON FLOTANTE NO BAJE AL LLEGAR AL FOOTER DE LA PAGINA
        */
        function checkOffset() {
            if( $('footer').length ){
                var a=$(document).scrollTop()+window.innerHeight;
                var b=$('footer').offset().top;
                
                if (a<b) {
                    $('.buttonAdd').css('bottom', '30px');
                    $('.buttonScan').css('bottom', '110px');
                } else {
                    $('.buttonAdd').css('bottom', (30+(a-b))+'px');
                    $('.buttonScan').css('bottom', (110+(a-b))+'px');
                }
            }
        }

        //----------------------------------------------------------------------------------------

        /*
        * METODO PARA BUSCAR ELEMENTOS DEL CONTENEDOR DE ELEMENTOS ACTUAL
        */
        function searchBar(){

            $("#barSearchTop").on("keyup", function() {
                var word = $(this).val().toLowerCase();
                var allElementsIndex = $(".element");
                var mostrado = false;
                if(allElementsIndex.length>0){
                    //Recorrer todos los elementos de la pagina
                    allElementsIndex.each(function(index, element){
                        var listElement = removeDiacritic($(this).find(".txtElement").text().toLowerCase());
                        //Comprobar si coinciden con la palabra de busqueda
                        if(listElement.indexOf(word) >= 0){
                            $(this).show();
                            mostrado=true;
                        }else{
                            $(this).hide();
                        }
                    });
                    
                    //Si no se ha mostrado ningun elemento mostramos un texto indicativo
                    if(!mostrado){
                        $("#noResults").show();
                    }else{
                        $("#noResults").hide();
                    }
                }
                //Llamada al metodo que ajusta la posicion de los botones flotantes para evitar fallos
                checkOffset();
            });
        }

        //----------------------------------------------------------------------------------------------

        /** 
        * METODO PARA ELIMINAR LOS SIGNOS DE ACENTUACION DE LAS PALABRAS
        */
        function removeDiacritic(texto) {
            return texto
           .normalize('NFD')
           .replace(/([^n\u0300-\u036f]|n(?!\u0303(?![\u0300-\u036f])))[\u0300-\u036f]+/gi,"$1")
           .normalize();
        }
    </script>
</html>
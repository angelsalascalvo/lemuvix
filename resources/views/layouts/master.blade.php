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

        <!-- VENTANA EMERGENTE -->
        <div id="emergentAction" style="display:none;">
            <div class="backgroundBlack"></div>
            <div class="emerWindow2 centerChildVH">

                <div class="closeEmergentContent col100">
                    <button id="closeEmergent">X</button>
                </div>

                <center>
                    <div class="width60">
                        <div id="txtEmergent" class="col100">
                            <span></span>
                        </div>
                        <div id="buttonsEmergent" class="col100">
                            <div class="col45">
                                <button id="aceptConfim" class="col100">Aceptar</button>
                            </div>
                            <div class="col10" style="height:1px;">
                            </div>
                            <div class="col45">
                                <button id="cancelConfirm" class="col100">Cancelar</button>
                            </div>
                        </div>

                        <div id="emergetAcept" class="col100">
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
            <div id="logoBar">
                <a href="{{route('movie.index')}}">
                    <img src="{{ url('/img/logo.png')}}">
                </a>
            </div>

            <!-- Mostrar barra busqueda si estamos trabajando en la seccion de peliculas -->
            @if (isset($type) && $type=='movie')
                <div id="searchBar" class="searchBarGen">
                    <input placeholder="Buscar...">
                    <button><img src="{{ url('/img/search.png')}}"></button>
                </div>
            @endif
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
                            <a href="{{route('movie.index')}}"><li>Inicio</li></a>
                            <a href="{{route('user.index')}}"><li>Usuarios</li></a>
                            <a href="{{route('genre.index')}}"><li>Generos</li></a>
                        </ul>
                    </div>
                    <div class="col10 colFooter">
                        <ul>
                            <a href="{{route('person.index')}}"><li>Actores y Directores</li></a>
                            <li>Info</li>
                            <li>&nbsp</li>
                        </ul>
                    </div>
                </div>
            </footer>            
        @endif
    </body>

    <script>

        $(document).ready(function() {
            $(".backgroundBlack").click(showModalWindow);
            $("#closeEmergent").click(showModalWindow);
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
                $("#emergetAcept").show();
                $("#buttonsEmergent").hide();
                $("#aceptInfo").click(function(){
                    $("#emergentAction").hide();
                });

            //Para ventanas de confirmar accion
            }else{
                $("#emergetAcept").hide();
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

        //METODO PARA MOSTRAR U OCULTAR LA VENTANA EMERGENTE
        function showModalWindow(){
            if($("#emergentAction").is(':visible')){
                $("#emergentAction").hide();
            }else{
                $("#emergentAction").show();
            }
        }

        //----------------------------------------------------------------------------------------

        /**
        * METODO PARA HACER QUE EL BOTON FLOTANTE NO BAJE AL ENCONTRAR EL FOOTER DE LA PAGINA
        */
        function checkOffset() {
            if( $('footer').length ){
                var a=$(document).scrollTop()+window.innerHeight;
                var b=$('footer').offset().top;
                
                if (a<b) {
                    $('.buttonAdd').css('bottom', '30px');
                } else {
                    $('.buttonAdd').css('bottom', (30+(a-b))+'px');
                }
            }
        }

        $(document).ready(checkOffset); //Ejecutar al acceder a la pagina
        $(document).scroll(checkOffset); //Ejecutar al hacer scroll
    </script>
</html>
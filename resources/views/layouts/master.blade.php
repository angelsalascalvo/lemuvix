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

        <!-- BARRA SUPERIOR -->
        <div id="topBar">
            <div id="logoBar">
                <a href="{{route('movie.index')}}">
                    <img src="{{ url('/img/logo.png')}}">
                </a>
            </div>

            <!-- Mostrar barra busqueda si estamos trabajando en la seccion de peliculas -->
            @if (isset($type) && $type=='movie')
                <div id="searchBar">
                    <input placeholder="Buscar...">
                    <button><img src="{{ url('/img/search.png')}}"></button>
                </div>
            @endif
        </div>

        <!-- CONTENIDO -->
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
        /**
        * METODO PARA HACER QUE EL BOTON FLOTANTE NO BAJE AL ENCONTRAR EL FOOTER DE LA PAGINA
        */
        function checkOffset() {
            var a=$(document).scrollTop()+window.innerHeight;
            var b=$('footer').offset().top;
            
            if (a<b) {
                $('.buttonAdd').css('bottom', '30px');
            } else {
                $('.buttonAdd').css('bottom', (30+(a-b))+'px');
            }
        }

        $(document).ready(checkOffset); //Ejecutar al acceder a la pagina
        $(document).scroll(checkOffset); //Ejecutar al hacer scroll
    </script>
</html>
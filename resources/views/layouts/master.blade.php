<html>
    <head>
        <link rel="stylesheet" href="{{ url('css/style.css')}}" />
        <link rel="stylesheet" href="{{ url('css/sizes.css')}}" />
        <title>
            @yield('title')
        </title>
    </head>
    <body>
        <!-- BARRA SUPERIOR -->
        <div id="topBar">
            <div id="logoBar">
                <img src="{{ url('/img/logo.png')}}">
            </div>
        </div>

        <!-- CONTENIDO -->
        <div class='content'>
            <div class="margin">
                @yield('content')
            </div>
        </div>
    </body>
    <script> </script>
</html>
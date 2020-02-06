<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FARMATURN</title>
    <!-- Bootstrap assets -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" type="text/css" href="css/mystyle.css">
    <!--<link rel="stylesheet"  type="text/css" href="css/style_mapa.css">-->
    <!-- Leaflet assets -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
        integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
        crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet-src.js"
        integrity="sha512-IkGU/uDhB9u9F8k+2OsA6XXoowIhOuQL1NTgNZHY1nkURnqEGlDZq3GsfmdJdKFe1k1zOc6YU2K7qY+hF9AodA=="
        crossorigin=""></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" type="text/css" href="css/mystyle.css">
    <script>
    $(function() {
        var menues = $(".nav li");
        menues.click(function() {
            menues.removeClass("active");
            $(this).addClass("active");
        });
    });
    </script>
    <style>
    #map {
        height: 350px;
        width: 270px;
        left: 0px;
    }
    </style>
        @yield('styles')
</head>

<body>
    <nav class="navbar navbar-inverse" role="navigation">
        <!-- El logotipo y el icono que despliega el menú se agrupan
       para mostrarlos mejor en los dispositivos móviles -->
        @guest
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Desplegar navegación</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Logotipo</a>
            <!-- <img src="images/logo1.png" alt="" />-->
        </div>
        @if (Route::has('register'))

        @endif
        @else
        <!-- Agrupar los enlaces de navegación, los formularios y cualquier
       otro elemento que se pueda ocultar al minimizar la barra -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <li><a href="/">Inicio</a></li>
                <li><a href="/home">Farmaturn</a></li>
                <li><a href="/tipo_usuarios#">Roles</a></li>
                <li><a href="/usuarios#">Usuarios</a></li>
                <li><a href="/farmacias#">Farmacias</a></li>
                <li><a href="/divpoliticas#">Div. Politica del Ecuador</a></li>
                <li><a href="/turnos#">Turnos</a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img style="width:40px; height:30px;" src="/images/{{Auth::user()->image}}" class="w3-circle"
                            alt="" />
                        {{ Auth::user()->nombre}}<b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="/perfil"><span class="glyphicon glyphicon-user"> Perfil</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <span class="glyphicon glyphicon-log-out"></span> {{ __('Cerrar Secion') }}</a></li>
                    </ul>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
        @endguest
    </nav>
    <div id="app">

        <main class="py-4 container">
            @yield('content')
        </main>
        @include('layouts.footer')
    </div>
    @stack('scripts')
</body>

</html>
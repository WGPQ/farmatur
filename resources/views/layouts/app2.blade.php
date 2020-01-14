<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FARMATURN</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/mystyle.css">
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />

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
                <li class="active"><a href="/home">Inicio</a></li>
                <li> <a href="/personas#">Personas</a></li>
                <li><a href="/tipo_usuarios#">Tipos de Usuarios</a></li>
                <li><a href="/usuarios#">Usuarios</a></li>
                <li><a href="/farmacias#">Farmacias</a></li>
                <li><a href="/divpoliticas#">Div. Politica del Ecuador</a></li>
                <li><a href="/turnos#">Turnos</a></li>

            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    {{ Auth::user()->persona['nombre'] }} <b class="caret"></b> <span class="glyphicon glyphicon-user">
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><span class="glyphicon glyphicon-user"> Perfil</a></li>
                        <li><a href="#">Acción #2</a></li>
                        <li><a href="#">Acción #3</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <span class="glyphicon glyphicon-log-out"></span>  {{ __('Cerrar Secion') }}</a></li>
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

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
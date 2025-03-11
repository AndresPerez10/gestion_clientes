<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <link href=" {{ asset('css/style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
    <title>API Gestión Clientes</title>
</head>
<body>
    
<nav class="navbar navbar-expand-lg bg-danger">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img class="logo" src="https://cv2.ptvtelecom.net/images/logo.png" alt=""></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <li class="nav-item">
          <a class="nav-link active text-light" aria-current="page" href="{{ route('welcome') }}">Inicio</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-light nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Funciones
          </a>
          <ul class="dropdown-menu">
            <!-- <li><hr class="dropdown-divider"></li> -->
            <li><a class="dropdown-item" href="{{ route('mostrarClientes') }}" id="ver-clientes-dropdown">Ver Clientes</a></li>
            <li><a class="dropdown-item" href="{{ route('insertarClientes') }}" id="insertar-clientes-dropdown">Insertar Clientes</a></li>
            <li><a class="dropdown-item" href="{{ route('mostrarContratos') }}" id="ver-contratos-dropdown">Ver Contratos</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true"></a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2 border-danger" type="search" placeholder="Buscar" aria-label="Search">
        <button class="btn btn-outline-light" type="submit"><img class="lupa" src="https://antares.sip.ucm.es/forte-cm/img/iconos/buscador.png" alt=""></button>
      </form>
    </div>
  </div>
</nav>
         <!-- Contenido dinámico -->
    <div class="container mt-4">
        @yield('content')
    </div>

</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <link href=" {{ asset('css/style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
          <a class="nav-link active text-light" aria-current="page" href="#">Inicio</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Funciones
          </a>
          <ul class="dropdown-menu">
            <!-- <li><hr class="dropdown-divider"></li> -->
            <li><a class="dropdown-item" href="#" id="ver-clientes-dropdown">Ver Clientes</a></li>
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
    <div class = "background">
        <div class="container py-4 px-6 mx-auto">
            <h1>API Gestión de Clientes</h1>
            <br>
            <button id="boton-obtener-clientes" class="btn btn-danger">Ver clientes</button>
        </div>
    
    <div class="table-container mt-4" id="data-table" style="display: none;">
        <table class="table table-striped-columns table-bordered border-danger text-center">
            <thead>
                <tr>
                    <th>id</th>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Primer apellido</th>
                    <th>Segundo apellido</th>
                    <th>Direccion</th>
                    <th>Email</th>
                    <th>Fecha de Nacimiento</th>
                </tr>
            </thead>
            <tbody id="clientes-table">
                <!-- Los datos se llenarán aquí mediante JS -->
            </tbody>
        </table>
    </div>
    <div class="container mt-4">

    <h2>Agregar Cliente</h2>
    <form id="form-agregar-cliente">
        <div class="mb-3">
            <label for="dni" class="form-label">DNI</label>
            <input type="text" class="form-control" id="dni" name="dni" required>
        </div>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="apellido1" class="form-label">Apellido 1</label>
            <input type="text" class="form-control" id="apellido1" name="apellido1" required>
        </div>
        <div class="mb-3">
            <label for="apellido2" class="form-label">Apellido 2</label>
            <input type="text" class="form-control" id="apellido2" name="apellido2">
        </div>
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="fechaNacimiento" class="form-label">Fecha de Nacimiento</label>
            <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" required>
        </div>
        <button type="submit" class="btn btn-danger">Guardar Cliente</button>
    </form>
</div>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="module" src="{{ asset('/js/clientes.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>

@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<h1>Formulario para insertar clientes</h1>
<form class="row g-3 needs-validation" id="formulario" novalidate>
    <div class="col-md-4">
        <label for="dni" class="form-label">DNI</label>
        <input type="text" class="form-control borde" id="dni" placeholder="12345678A" required>
        <div class="invalid-feedback">
            Por favor, introduzca el DNI.
        </div>
    </div>

    <div class="col-md-4">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control borde" id="nombre" placeholder="Nombre" required>
        <div class="valid-feedback">
            Bien
        </div>
    </div>

    <div class="col-md-4">
        <label for="apellido1" class="form-label">Primer apellido</label>
        <input type="text" class="form-control borde" id="apellido1" placeholder="Primer apellido" required>
        <div class="valid-feedback">
            Bien
        </div>
    </div>

    <div class="col-md-4">
        <label for="apellido2" class="form-label">Segundo apellido</label>
        <input type="text" class="form-control borde" id="apellido2" placeholder="Segundo apellido" required>
        <div class="valid-feedback">
            Bien
        </div>
    </div>

    <div class="col-md-4">
        <label for="direccion" class="form-label">Dirección</label>
        <input type="text" class="form-control borde" id="direccion" placeholder="Cantareros, 8" required>
        <div class="valid-feedback">
            Bien
        </div>
    </div>

    <div class="col-md-4">
        <label for="contrasenna" class="form-label">Contraseña</label>
        <input type="password" class="form-control borde" id="contrasenna" placeholder="Min 13, al menos 1 mayúscula" required>
        <div class="invalid-feedback">
            Por favor, introduzca una contraseña válida.
        </div>
    </div>

    <div class="row g-2">
        <div class="col-md-2">
            <label for="fechaNacimiento" class="form-label">Fecha de Nacimiento</label>
            <input type="date" class="form-control borde" id="fechaNacimiento" required>
            <div class="valid-feedback">
                Bien
            </div>
        </div>

        <div class="col-md-5">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control borde" id="email" placeholder="email5@gmail.com" required>
            <div class="invalid-feedback">
                Por favor, introduzca un email válido.
            </div>
        </div>

        <div class="col-md-2 d-flex align-items-end">
            <button class="btn btn-danger w-90" type="submit" id="boton">Insertar Cliente</button>
        </div>
    </div>
</form>


    <script type="module" src="{{ asset('/js/Clientes/clientes.js') }}"></script>
@endsection

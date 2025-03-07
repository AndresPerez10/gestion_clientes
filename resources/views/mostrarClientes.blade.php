@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
    <h1>Mostrar listado de clientes</h1>
    <div id="spinner" class="spinner-border text-danger" role="status" style="display: none;">
    <span class="visually-hidden">Cargando...</span>
    </div>
<div class="table-container mt-4" id="tablaClientes" style="display: none;">
    <table class="table table-striped-columns text-center">
        <thead>
            <tr>
                <th>id</th>
                <th>DNI</th>
                <th>Nombre</th>
                <th>Primer apellido</th>
                <th>Segundo apellido</th>
                <th>Dirección</th>
                <th>Email</th>
                <th>Fecha de Nacimiento</th>
                <th>Acciones</th>                
            </tr>
        </thead>
        <tbody id="clientes-table">
            <!-- Los datos se llenarán aquí mediante JS -->
        </tbody>
    </table>
</div>

    <script type="module" src="{{ asset('/js/clientes.js') }}"></script>
@endsection

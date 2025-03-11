@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
    <h1>Mostrar listado de contratos</h1>
    
    <div>
        <select class="form-select" id="dni-dropdown" aria-label="Seleccionar DNI">
            <option selected disabled>Seleccione un DNI</option>
        </select>
    </div>

    <div class="table-container mt-4" id="tablaContratos">
        <table class="table table-striped-columns text-center">
            <thead>
                <tr>
                    <th>id</th>
                    <th>idCliente</th>
                    <th>Descripción</th>               
                </tr>
            </thead>
            <tbody id="contratos-table">
                <!-- Los datos se llenarán aquí mediante JS -->
            </tbody>
        </table>
    </div>

    <script type="module" src="{{ asset('/js/Contratos/contratos.js') }}"></script>
    <script type="module" src="{{ asset('/js/Contratos/contratos.js') }}"></script>
@endsection

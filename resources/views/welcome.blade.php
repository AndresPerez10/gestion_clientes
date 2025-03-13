@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
    <h1>Bienvenido a mi API</h1>
    <br>

    <div class="container">
    <div class="row g-3">
        <div class="col-md-4 wow animate__animated animate__fadeIn" data-wow-delay="0.5s">
            <div class="card" style="width: 18rem;">
                <img src="https://static.vecteezy.com/system/resources/previews/017/258/405/non_2x/office-client-list-3d-icon-png.png" class="card-img" alt="ver listado clientes">
                <div class="card-body">
                    <h5 class="card-title">Ver Clientes</h5>
                    <p class="card-text">En esta función podras ver un listado de los clietntes de nuestra base de datos.</p>
                    <a href="{{ route('mostrarClientes') }}" class="btn btn-danger">Ver</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 wow animate__animated animate__fadeIn" data-wow-delay="1.5s">
            <div class="card" style="width: 18rem;">
                <img src="https://png.pngtree.com/png-clipart/20230802/original/pngtree-add-customers-icon-color-flat-picture-image_7822733.png" class="card-img" alt="insertar clientes">
                <div class="card-body">
                    <h5 class="card-title">Insertar Clientes</h5>
                    <p class="card-text">En esta función podrás insertar clientes a la base de datos.</p>
                    <a href="{{ route('insertarClientes') }}" class="btn btn-danger">Ver</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 wow animate__animated animate__fadeIn" data-wow-delay="2.5s">
            <div class="card" style="width: 18rem;">
                <img src="https://cdn-icons-png.flaticon.com/512/5545/5545080.png" class="card-img" alt="Imagen de contrato">
                <div class="card-body">
                    <h5 class="card-title">Ver Contratos</h5>
                    <p class="card-text">En esta función podrás ver todos los contratos de nuestros clientes filtrando por su DNI.</p>
                    <a href="{{ route('mostrarContratos') }}" class="btn btn-danger">Ver</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    h1{
        text-align: center;
    }
    .card {
    align-items: center;
    justify-content: center;
    padding-top: 3%;
            }
    .card-img {
        width: 150px; /* Cambiar ancho */
        height: 150px; /* Cambiar alto */
        object-fit: cover; /* Para que no se deforme */
    
    }
</style>

@endsection
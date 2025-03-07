<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/clientes/mostrar', function () {
    return view('mostrarClientes');
})->name('mostrarClientes');

Route::get('/clientes/insertar', function () {
    return view('insertarClientes');
})->name('insertarClientes');

Route::delete('/clientes/eliminar/{dni}', function () {
    return view('deleteCliente');
})->name('deleteCliente');
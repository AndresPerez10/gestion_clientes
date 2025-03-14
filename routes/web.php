<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


// Clientes

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

// Route::put('/clientes/actualizar', function () {
//     return view('insertarClientes');
// })->name('insertarClientes');

Route::get('/clientes/actualizar', function (Request $request) {
    $data = $request->query('data'); // Obtener el parámetro 'data'
    $cliente = $data ? json_decode(base64_decode($data), true) : null;

    return view('insertarClientes', compact('cliente'));
})->name('insertarClientes');

// Contratos

Route::get('/contratos/mostrar', function () {
    return view('mostrarContratos');
})->name('mostrarContratos');

Route::delete('/contratos/eliminar', function () {
    return view('deleteContrato');
})->name('deleteContrato');
<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientesController; 

Route::get('/clientes/obtener', [ClientesController::class, 'obtenerClientes']);
Route::post('/clientes/crear', [ClientesController::class, 'crearCliente']);
Route::get('/clientes/obtener/{dni}', [ClientesController::class, 'obtenerClientePorDni']);
Route::delete('/clientes/eliminar/{dni}', [ClientesController::class, 'eliminarClientePorDni']);
Route::put('/clientes/actualizar/{dni}', [ClientesController::class, 'actualizarCliente']);
<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientesController; 
use App\Http\Controllers\ContratosController;

//Clientes
Route::get('/clientes/obtener', [ClientesController::class, 'obtenerClientes']);
Route::post('/clientes/crear', [ClientesController::class, 'crearCliente']);
Route::get('/clientes/obtener/{dni}', [ClientesController::class, 'obtenerClientePorDni']);
Route::delete('/clientes/eliminar/{dni}', [ClientesController::class, 'eliminarClientePorDni']);
Route::put('/clientes/actualizar/{dni}', [ClientesController::class, 'actualizarCliente']);
Route::get('/clientes/obtenerDniClientes', [ClientesController::class, 'obtenerDniClientes']);

//Contratos

Route::get('/contratos/obtener', [ContratosController::class, 'obtenerContratos']);
Route::get('/contratos/obtener/{dni}', [ContratosController::class, 'obtenerContratosPorCliente']);
Route::post('/contratos/crear', [ContratosController::class, 'crearContrato']);
Route::delete('/contratos/eliminar', [ContratosController::class, 'eliminarContratoPorDni']);
Route::put('/contratos/actualizar', [ContratosController::class, 'actualizarContratos']);
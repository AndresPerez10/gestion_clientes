<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ContratosController extends Controller
{

    public function obtenerContratosPorCliente(Request $datos) {

        $validatedData = ['dni' => $datos->route('dni')];

        $validator = Validator::make($validatedData, 
            ['dni' => 'regex:/^(\d{8})([A-Z])$/'],
            ['dni.regex' => 'El formato de dni no es correcto']);

        if ($validator->fails()) {
            return $this->devolverRespuestas( false, '422', $validator->errors());
        }

        try {
            $cliente = Cliente::where('dni', $validatedData['dni'])->first();
            if(is_null($cliente)) {
                Log::error('ocurrió un error: No se encuentra el dni ');
                return $this->devolverRespuestas( true, '404', 'Dni inexistente.');
            }
            $contratos = $cliente->contratos;
            // $contratos[] = $cliente->contratosCustom($cliente->dni);
            return $this->devolverRespuestas( true, '200', $contratos);
        } catch(\Exception $e) {
            Log::error('ocurrió un error: Fallo en el servidor');
            return $this->devolverRespuestas( false, '500', $e);
        }         
    }
    

    private function devolverRespuestas($status, $httpCode, $message) {
        return response()->json([
            'status' => $status,
            'httpCode' => $httpCode,
            $status ? 'mensaje' : 'error' => $message
        ]);
    }
}

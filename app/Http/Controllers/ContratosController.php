<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ContratosController extends Controller
{

    public function obtenerContratos() {
        
        try {            
            $contratos = Contrato::all();            
            if($contratos->isEmpty()) {
                Log::error('ocurrió un error: No se encuentran contratos');
            return $this->devolverRespuestas( false, '422', 'ocurrió un error: No se encuentran contratos');
            }
            
        }catch(\Exception $e) {
            Log::error('ocurrió un error: Fallo en el servidor');
            return $this->devolverRespuestas(false, 500, $e);
        } 

    return $this->devolverRespuestas(true, '200', $contratos);
        
    } 

    
    

    private function devolverRespuestas($status, $httpCode, $message) {
        return response()->json([
            'status' => $status,
            'httpCode' => $httpCode,
            $status ? 'mensaje' : 'error' => $message
        ]);
    }
}

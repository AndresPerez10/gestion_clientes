<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ContratosController extends Controller
{

    public function actualizarContratos(Request $datos) {
        $validator = Validator::make($datos->all(), [
            'dni' => ['required', 'regex:/^(\d{8})([A-Z])$/'],
            'idContrato' => ['nullable'],
            'descripcion' => ['nullable']
        ]);   
            
        if ($validator->fails()) {
            return $this->devolverRespuestas(false, 422,  $validator->errors());
        }

        try {
            $cliente = Cliente::where('dni', $datos->dni)->first();
            if(is_null($cliente)) {
                Log::error('ocurrió un error: No se encuentra el dni ');
                return $this->devolverRespuestas(false, 404, 'Dni inexistente.');
            }
            $contratos = Contrato::where('id', $datos->idContrato)->first();
            if(is_null($contratos)) {
                Log::error('ocurrió un error: Contrato inexistente ');
                return $this->devolverRespuestas(false, 404, 'Contrato inexistente.');
            }
            $contratos->update([
                'descripcion' => $datos->descripcion
            ]);

        } catch(\Exception $e) {
            Log::error('ocurrió un error: Fallo en el servidor');
            return $this->devolverRespuestas( false,'500','ocurrió un error: ' . $e
            );
        } 
    
        return response()->json([
            'status' => true,
            'httpCode' => 200,
            'mensaje' => 'Cliente actualizado',
            'cliente actualizado: ' => $contratos
        ]);
    }

    

    private function devolverRespuestas($status, $httpCode, $message) {
        return response()->json([
            'status' => $status,
            'httpCode' => $httpCode,
            $status ? 'mensaje' : 'error' => $message
        ]);
    }
}

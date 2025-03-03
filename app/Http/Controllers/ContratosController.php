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

    public function crearContrato(Request $datos) {
        $validator = Validator::make($datos->all(), [
            'dni' => ['required', 'regex:/^(\d{8})([A-Z])$/'],
            'descripcion' => ['nullable']
            
        ]); 
        
        if ($validator->fails()) {
            return $this->devolverRespuestas( false, '422', $validator->errors());
        }
        
        try {  
            // Buscar al cliente por dni y controlar si existe o no
            $cliente = Cliente::where('dni', $datos->dni)->first();
            if(is_null($cliente)) {
                Log::error('ocurrió un error: No se encuentra el dni ');
                return $this->devolverRespuestas( true, '404', 'Dni inexistente.');
            }

            // Instanciar contrato y setear los datos
            $idCliente = $cliente->id;
            

            // Guardar el contrato

           Contrato::create([
            'dni' => $datos->dni,
            'descripcion' => $datos->descripcion,
            'idCliente' => $idCliente
           ]);  

            return $this->devolverRespuestas( true, '200', 'insertado con éxito');

        }catch(QueryException $e) {
            Log::error('ocurrió un error: El contrato ya existe ');
            return $this->devolverRespuestas( false, '409', 'ocurrió un error: El contrato ya existe');
        }catch(\Exception $e) {
            Log::error('ocurrió un error: Fallo en el servidor');
            return $this->devolverRespuestas( false, '500', 'ocurrió un error: Fallo en el servidor');
        }  

    }

    public function eliminarContratoPorDni(Request $datos) {

        $validator = Validator::make($datos->all(), [
            'dni' => ['required', 'regex:/^(\d{8})([A-Z])$/'],
            'idContrato' => ['nullable']
            
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
            $contratos->delete();
        } catch(\Exception $e) {
            Log::error('ocurrió un error: Fallo en el servidor');
            return $this->devolverRespuestas( false,'500','ocurrió un error: ' . $e
            );
        } 
    
        return $this->devolverRespuestas(true, 200, 'contrato eliminado');
    }

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

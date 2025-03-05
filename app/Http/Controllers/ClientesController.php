<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class ClientesController extends Controller
{

    /**
     * Endpoint que obtiene el listado de clientes de la base de datos.
     * Y devuelver error si no encuentra clientes
     */
    public function obtenerClientes() {        
        try {            
            $clientes = Cliente::all();            
            if($clientes->isEmpty()) {
                Log::error('ocurrió un error: No se encuentran clientes ');
                return $this->devolverRespuestasError( false, '422', 'ocurrió un error: No se encuentran clientes');
            }
            
            $clienteResource = [];        
            foreach($clientes as $cliente) {
                $clienteResource[] = [
                    'id' => $cliente->id,
                    'dni' => $cliente->dni,
                    'nombre' => $cliente->nombre,
                    'apellido1' => $cliente->apellido1,
                    'apellido2' => $cliente->apellido2,
                    'direccion' => $cliente->direccion,
                    'email' => $cliente->email,
                    'fechaNacimiento' => $cliente->fechaNacimiento
                ];
            }
            
            // dd($clienteResource);
            return $this->devolverRespuestasError(true, '200', $clienteResource);
        }catch(\Exception $e) {
            Log::error('ocurrió un error: Fallo en el servidor');
            return $this->devolverRespuestasError(false, 500, $e);
        } 
    } 

    /**
     * Endpoint que inserta un cliente en la base de datos.
     * recibe por request los siguientes parametros
     * dni: corresponde al dni del cliente-
     */
    public function crearCliente(Request $datos) {        

        $messages = [
            'contrasenna.required' => 'Por favor, inserta la contraseña',
            'id.required' => 'Cliente con Id: ' . $datos->id . ' insertado con éxito',
            'dni.regex' => 'El formato de dni no es correcto'
        ];

        $validator = Validator::make($datos->all(), [
            'dni' => ['required', 'regex:/^(\d{8})([A-Z])$/'],
            'nombre' => ['nullable'],
            'apellido1' => ['nullable'],
            'apellido2' => ['nullable'],
            'direccion' => ['nullable'],
            'email' => ['sometimes', 'required', 'email'],
            'fechaNacimiento' => ['date', 'nullable'],
            'contrasenna' => ['required', Password::min(13)->mixedCase()]
        ],
        $messages);    
        
        if ($validator->fails()) {
            return $this->devolverRespuestasError( false, '422', $validator->errors());
        }
        
        try {            
            $validator->validated()['contrasenna'] = Hash::make($datos->contrasenna);
            $result = Cliente::create($validator->validated());            
        }catch(QueryException $e) {
            Log::error('ocurrió un error: El cliente ya existe ');
            return $this->devolverRespuestasError( false, '409', 'ocurrió un error: El cliente ya existe');
        }catch(\Exception $e) {
            Log::error('ocurrió un error: Fallo en el servidor');
            return $this->devolverRespuestasError( false, '500', 'ocurrió un error: Fallo en el servidor');
        } 
        // dd(Hash::check('hola2344', $passHashed));
       
        return $this->devolverRespuestasError( true, '200', 'Cliente con Id: ' . $result->id . ' insertado con éxito');

    }


    /**
     * Endpoint que recoje un cliente de la base datos con dni específico
     * Insertas el dni en la ruta
     */

    public function obtenerClientePorDni(Request $datos) {
        
        $validatedData = ['dni' => $datos->route('dni')];

        $validator = Validator::make($validatedData, 
            ['dni' => 'regex:/^(\d{8})([A-Z])$/'],
            ['dni.regex' => 'El formato de dni no es correcto']);

        if ($validator->fails()) {
            return $this->devolverRespuestasError( false, '422', $validator->errors());
        }

        try {
            $cliente = Cliente::where('dni', $validatedData['dni'])->first();
                if(is_null($cliente)) {
                    Log::error('ocurrió un error: No se encuentra el dni ');
                    return response()->json( true, '404', 'Dni inexistente.');
                }
        } catch(\Exception $e) {
            Log::error('ocurrió un error: Fallo en el servidor');
            return $this->devolverRespuestasError( false, '500', $e);
        } 
        
        return $this->devolverRespuestasError( true, '200', $cliente);
    }

    //////////////////////////////////


    public function eliminarClientePorDni(Request $datos) {
        
        $validatedData = ['dni' => $datos->route('dni')];

        $validator = Validator::make($validatedData, 
            ['dni' => 'regex:/^(\d{8})([A-Z])$/'],
            ['dni.regex' => 'El formato de dni no es correcto']);

        if ($validator->fails()) {
            return $this->devolverRespuestasError(false, 422,  $validator->errors());
        }

        try {
            $cliente = Cliente::where('dni', $validatedData['dni'])->first();
            if(is_null($cliente)) {
                Log::error('ocurrió un error: No se encuentra el dni ');
                return $this->devolverRespuestasError(false, 404, 'Dni inexistente.');
            }
            $cliente->delete();
        } catch(\Exception $e) {
            Log::error('ocurrió un error: Fallo en el servidor');
            return $this->devolverRespuestasError( false,'500','ocurrió un error: ' . $e
            );
        } 
    
        return $this->devolverRespuestasError(true, 200, 'cliente eliminado');
    }


    public function actualizarCliente(Request $datos) {
        
            $validatedData = ['dni' => $datos->route('dni')];
            
            $validator = Validator::make($datos->all(), [
                'dni' => ['required', 'regex:/^(\d{8})([A-Z])$/'],
                ['dni.regex' => 'El formato de dni no es correcto'],
                'nombre' => ['nullable'],
                'apellido1' => ['nullable'],
                'apellido2' => ['nullable'],
                'direccion' => ['nullable'],
                'email' => ['sometimes', 'required', 'email'],
                'fechaNacimiento' => ['date', 'nullable'],
                'contrasenna' => ['required', Password::min(13)->mixedCase()]
            ]);
    
            if ($validator->fails()) {
                return $this->devolverRespuestasError(false, 422,  $validator->errors());
            }
    
            try {
                $cliente = Cliente::where('dni', $validatedData['dni'])->first();

                if(is_null($cliente)) {
                    Log::error('ocurrió un error: No se encuentra el dni ');
                    return $this->devolverRespuestasError(false, 404, 'Cliente no encontrado.');
                }
                $cliente->update([
                    //'dni' => $datos->dni, 
                    'nombre' => $datos->nombre,
                    'apellido1' => $datos->apellido1,
                    'apellido2' => $datos->apellido2,
                    'direccion'=> $datos->direccion,
                    'email' => $datos->email,
                    'fechaNacimiento' => $datos->fechaNacimiento,
                    'contrasenna' => Hash::make($datos->contrasenna)
                ]);

            } catch(\Exception $e) {
                Log::error('ocurrió un error: Fallo en el servidor');
                return $this->devolverRespuestasError( false,'500','ocurrió un error: ' . $e);
            } 
        
            return $this->devolverRespuestasError(true, 200, 'Cliente actualizado correctamente: '.$cliente);

        }

    // private function devolverRespuestasError($data) {       
    //     // $respuesta =  $data['status'] ? 'mensaje' : 'error';
    //     // if(!$data['status']) $respuesta = 'error';

    //     return response()->json([
    //         'status' => $data['status'],
    //         'httpCode' => $data['httpCode'],
    //         $data['status'] ? 'mensaje' : 'error' => $data['respuesta']
    //     ]);
    // }

    private function devolverRespuestasError($status, $httpCode, $message) {
        return response()->json([
            'status' => $status,
            'httpCode' => $httpCode,
            $status ? 'mensaje' : 'error' => $message
        ]);
    }



}

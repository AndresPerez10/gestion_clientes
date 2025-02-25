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
            return response()->json([
                'status' => false,
                'http code' => '422',
                'error' => 'ocurrió un error: No se encuentran clientes'
            ]);
            }
            
        }catch(\Exception $e) {
            Log::error('ocurrió un error: Fallo en el servidor');
            return response()->json([
                'status' => false,
                'http code' => '500',
                'error' => 'ocurrió un error: ' . $e
            ]);
        } 

    return response()->json([
        'status' => true,
        'http code' => '200',
        'Listado de clientes' => $clientes
    ]);
        
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
            return response()->json([
                'status' => false,
                'http code' => '422',
                'error' => $validator->errors()
            ]);
        }
        
        try {            
            $validator->validated()['contrasenna'] = Hash::make($datos->contrasenna);
            $result = Cliente::create($validator->validated());            
        }catch(QueryException $e) {
            Log::error('ocurrió un error: El cliente ya existe ');
            return response()->json([
                'status' => false,
                'http code' => '409',
                'error' => 'ocurrió un error: El cliente ya existe'
            ]);
        }catch(\Exception $e) {
            Log::error('ocurrió un error: Fallo en el servidor');
            return response()->json([
                'status' => false,
                'http code' => '500',
                'error' => 'ocurrió un error: Fallo en el servidor'
            ]);
        } 
        // dd(Hash::check('hola2344', $passHashed));
       
        return response()->json([
            'status' => true,
            'http code' => '200',
            'mensaje' => 'Cliente con Id: ' . $result->id . ' insertado con éxito'
        ]);

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
            return response()->json([
                'status' => false,
                'http code' => '422',
                'error' => $validator->errors()
            ]);
        }

        try {
            $cliente = Cliente::where('dni', $validatedData['dni'])->first();
                if(is_null($cliente)) {
                    Log::error('ocurrió un error: No se encuentra el dni ');
                    return response()->json([
                        'status' => true,
                        'http code' => '404',
                        'mensaje' => 'Dni inexistente.'
                    ]);
                }
        } catch(\Exception $e) {
            Log::error('ocurrió un error: Fallo en el servidor');
            return response()->json([
                'status' => false,
                'http code' => '500',
                'error' => 'ocurrió un error: ' . $e
            ]);
        } 
        
        return response()->json([
            'status' => true,
            'http code' => '200',
            'Listado de clientes' => $cliente
        ]);
    }

    //////////////////////////////////


    public function eliminarClientePorDni(Request $datos) {
        
        $validatedData = ['dni' => $datos->route('dni')];

        $validator = Validator::make($validatedData, 
            ['dni' => 'regex:/^(\d{8})([A-Z])$/'],
            ['dni.regex' => 'El formato de dni no es correcto']);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'http code' => '422',
                'error' => $validator->errors()
            ]);
        }

        try {
            $cliente = Cliente::where('dni', $validatedData['dni'])->first();
                if(is_null($cliente)) {
                    Log::error('ocurrió un error: No se encuentra el dni ');
                    return response()->json([
                        'status' => true,
                        'http code' => '404',
                        'mensaje' => 'Dni inexistente.'
                    ]);
                }
        } catch(\Exception $e) {
            Log::error('ocurrió un error: Fallo en el servidor');
            return response()->json([
                'status' => false,
                'http code' => '500',
                'error' => 'ocurrió un error: ' . $e
            ]);
        } 
        
        $cliente->delete();

        return response()->json([
            'status' => true,
            'http code' => '200',
            'mensaje: ' => 'cliente eliminado'
        ]);
    }

}

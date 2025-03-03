<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ContratosController extends Controller
{

    
    

    private function devolverRespuestas($status, $httpCode, $message) {
        return response()->json([
            'status' => $status,
            'httpCode' => $httpCode,
            $status ? 'mensaje' : 'error' => $message
        ]);
    }
}

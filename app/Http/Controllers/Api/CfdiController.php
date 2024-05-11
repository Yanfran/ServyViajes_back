<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cfdi;

class CfdiController extends Controller
{
    public function index(){        
        try {            
            $data = Cfdi::where('estatus', 1)
            ->orWhere('estatus', 0)
            ->orderBy('id', 'DESC')
            ->get();
            if ($data) {
                return response()->json([
                    'result' => true,
                    'data' => $data,
                    'message' => 'Lista de cfdi obtenidas con éxito.'
                    ], 201
                );
            } else {
                return response()->json([
                    'result' => false,
                    'message' => 'La lista no puede ser obtenida.'
                    ], 201
                );
            }      
        } catch (\Throwable $e) {
            return response()->json([
                'result' => false,
                'message' => 'La lista de cfdi no puede ser obtenida: ' . $e->getMessage()
                ], 200
            );
        }        
    }

    public function obtenerLista() {
        try {
            $data = Cfdi::where('estatus', 1)
            ->orWhere('estatus', 0)
            ->orderBy('id', 'DESC')
            ->get();

            return response()->json([
                'result' => true,
                'data' => $data,
                'message' => 'Lista de cfdi obtenidas con éxito.'
                ], 201
            );

        } catch(\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => 'La lista de cfdi no puede ser obtenida: ' . $e->getMessage()
                ], 200
            ); 
        }
    }
}

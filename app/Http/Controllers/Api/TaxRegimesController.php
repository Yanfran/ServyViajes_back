<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TaxRegimes;

class TaxRegimesController extends Controller
{
    public function index(){        
        try {
            $data = TaxRegimes::where('estatus', 1)
            ->orWhere('estatus', 0)
            ->orderBy('id', 'DESC')
            ->get();
            if ($data) {
                return response()->json([
                    'result' => true,
                    'data' => $data,
                    'message' => 'Lista de regimenes fiscales obtenidas con éxito.'
                    ], 201
                );
            } else {
                return response()->json([
                    'result' => false,
                    'message' => 'La lista no puede ser obtenida.'
                    ], 404
                );
            }      
        } catch (\Throwable $e) {
            return response()->json([
                'result' => false,
                'message' => 'La lista de regimenes fiscales no puede ser obtenida: ' . $e->getMessage()
                ], 200
            );
        }        
    }

    public function obtenerLista() {
        try {
            $data = TaxRegimes::where('estatus', 1)
            ->orWhere('estatus', 0)
            ->orderBy('id', 'DESC')
            ->get();

            return response()->json([
                'result' => true,
                'data' => $data,
                'message' => 'Lista de regimenes fiscales obtenidas con éxito.'
                ], 201
            );
                 
        } catch (\Throwable $e) {
            return response()->json([
                'result' => false,
                'message' => 'La lista de regimenes fiscales no puede ser obtenida: ' . $e->getMessage()
                ], 200
            );
        }
    }
}

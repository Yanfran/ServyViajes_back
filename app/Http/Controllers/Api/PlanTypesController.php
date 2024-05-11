<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PlanTypes;

class PlanTypesController extends Controller
{
    public function index(){        
        try {
            $data = PlanTypes::where('estatus', 1)->orWhere('estatus', 0)->orderBy('id', 'DESC')->get();
            if ($data) {
                return response()->json([
                    'result' => true,
                    'data' => $data,
                    'message' => 'Lista de tipos de plan obtenidas con éxito.'
                    ], 201
                );
            } else {
                return response()->json([
                    'result' => false,
                    'message' => 'La lista no puede ser obtenida.'
                    ], 404
                );
            }      
        } catch (\Throwable $th) {
            return response()->json([
                'result' => false,
                'message' => 'La lista de tipos de plan no puede ser obtenida: ' . $e->getMessage()
                ], 200
            );
        }        
    }
}

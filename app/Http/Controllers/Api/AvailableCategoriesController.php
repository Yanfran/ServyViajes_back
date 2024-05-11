<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AvailableCategories;

class AvailableCategoriesController extends Controller
{
    public function obtenerCategory($id){                                      
        // dd($id);
        try {            
            $data = AvailableCategories::where('events_id', $id)
            ->where('estatus', 1)
            ->value('costo');
            // ->first();            
            if ($data) {
                return response()->json([
                    'result' => true,
                    'data' => $data,
                    'message' => 'Lista de categorias disponobles obtenidas con éxito.'
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
                'message' => 'La lista de categorias disponobles no puede ser obtenida: ' . $e->getMessage()
                ], 200
            );
        }        
    }
}

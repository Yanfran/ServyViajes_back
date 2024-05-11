<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Countrys;

class CountrysController extends Controller
{
    public function getCountrys(){
        try {
            $data = Countrys::where('estatus', 1)                
                ->orderBy('id', 'DESC')
                ->get();

            if ($data) {
                return response()->json([
                    'result' => true,
                    'data' => $data,
                    'message' => 'Lista de países obtenidas con éxito.'
                ], 200);
            } else {
                return response()->json([
                    'result' => false,
                    'message' => 'La lista no puede ser obtenida.'
                ], 200);
            }

        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => 'La lista de países no puede ser obtenida: ' . $e->getMessage()
            ], 200);
        }
    }

    public function obtenerListaPaises() {
        try {
            $data = Countrys::where('estatus', 1)                
                ->orderBy('id', 'DESC')
                ->get();

            return response()->json([
                'result' => true,
                'data' => $data,
                'message' => 'Lista de países obtenidas con éxito.'
            ], 200);
            
        }catch(\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => 'La lista de países no puede ser obtenida: ' . $e->getMessage()
            ], 200);
        }
    }
}

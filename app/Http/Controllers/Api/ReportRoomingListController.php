<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Events;
use App\Models\PlanTypes;

class ReportRoomingListController extends Controller
{
    public function getListEvents()
    {
        try {
            $data = Events::with('hotel')
                ->where('estatus', 1)
                ->orWhere('estatus', 0)
                ->orderBy('id', 'DESC')
                ->get();

            return response()->json([
                'result' => true,
                'data' => $data,
                'message' => 'Lista de eventos obtenidas con éxito.'
            ], 200);
            
        }catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => 'La lista de eventos no puede ser obtenida: ' . $e->getMessage()
            ], 200);
        }
    }

    public function getListPlanTypes()
    {
        try {
            $data = PlanTypes::where('estatus', 1)
                ->orWhere('estatus', 0)
                ->orderBy('id', 'DESC')
                ->get();
            
            return response()->json([
                "result" => true,
                "data" => $data,
                "message" => "Lista de tipos de plan obtenidas con éxito."
            ]);

        }catch(\Exception $e) {
            return response()->json([
                "result" => false,
                "message" => "Error al obtener lista de tipos de plan" . $e->getMessage()
            ]);
        }
    }
}

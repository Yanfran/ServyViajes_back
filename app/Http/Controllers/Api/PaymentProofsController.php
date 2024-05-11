<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentProofs;

class PaymentProofsController extends Controller
{
    public function index(){        
        try {            
            $data = PaymentProofs::where('estatus', 1)
            ->orWhere('estatus', 0)
            ->orderBy('id', 'DESC')
            ->get();
            if ($data) {
                return response()->json([
                    'result' => true,
                    'data' => $data,
                    'message' => 'Lista de comprobantes de pagos obtenidas con éxito.'
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
                'message' => 'La lista de comprobantes de pagos no puede ser obtenida: ' . $e->getMessage()
                ], 200
            );
        }        
    }
}

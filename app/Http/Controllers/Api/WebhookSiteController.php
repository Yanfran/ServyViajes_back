<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReservePayments;
use App\Models\PaymentProofs;

class WebhookSiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */     

    public function webhook(Request $request)
    {        
        // Obtener los datos del request
        $requestData = $request->all();

        // Crear un objeto PHP
        $data = (object) [
            'type' => $requestData['type'],
            'transaction' => (object) [
                'id' => $requestData['transaction']['id'],
                'transaction_type' => $requestData['transaction']['transaction_type'],
                'status' => $requestData['transaction']['status'],
                'order_id' => $requestData['transaction']['order_id'],
                'amount' => $requestData['transaction']['amount'],
            ],
        ];
        
        $orderIdParts = explode('-', $data->transaction->order_id);
        
        $infoBeforeFirstDash = $orderIdParts[0];        

        if ($infoBeforeFirstDash == 'reserve') {
            
            $reservePayments = ReservePayments::where('motion', $data->transaction->id)->first();
            
            // Si se encuentra una coincidencia, cambiar el estado
            if ($reservePayments) {
                $reservePayments->estatus = 1;
                $reservePayments->save();
            }
    
            // dd($reservePayments);
        }


        if ($infoBeforeFirstDash == 'assistan') {
            
            $paymentProofs = PaymentProofs::where('motion', $data->transaction->id)->first();
            
            // Si se encuentra una coincidencia, cambiar el estado
            if ($paymentProofs) {
                $paymentProofs->estatus = 1;
                $paymentProofs->save();
            }
    
            // dd($paymentProofs);
        }


        

    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

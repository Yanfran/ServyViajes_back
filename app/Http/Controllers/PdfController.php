<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function save(Request $request)
    {

        // dd("aqui");
        // $validatedData = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'phone' => 'required|string|max:255',
        //     'email' => 'required|email|max:255',
        //     'certification' => 'required|boolean',
        //     'apostille' => 'required|boolean',

        //     'email_s' => 'required|email|max:255',
        //     'payment_intent_id' => 'required|string',
        //     'amount' => 'required|integer',
        //     'currency' => 'required|string|max:3'
        // ]);

        // $payment = Payment::create([
        //     'name' => $validatedData['name'],
        //     'email' => $validatedData['email'],
        //     'payment_intent_id' => $validatedData['payment_intent_id'],
        //     'amount' => $validatedData['amount'],
        //     'currency' => $validatedData['currency']
        // ]);

        return response()->json(['result' => true, 'msg' => "Realilzado exitosamente."], 202);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

use App\Models\PdfStripe;

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

        $base64String = $request->input('file');
        $data = explode(',', $base64String);
        $fileContents = base64_decode($data[1]);

        $extension = 'pdf'; // Predeterminado

        $fileName = time() . '_file.' . $extension;
        $filePath = public_path('assets/pdf/') . $fileName;

        // Guardar el archivo en la carpeta deseada
        file_put_contents($filePath, $fileContents);

        $cupon = $request->input('cupon', '');

        if($cupon == null){
            $cupon = "";
        }

        $pdfStripe = PdfStripe::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'file' => $fileName,
            'lang_o' => $request->input('lang_1'),
            'lang_t' => $request->input('lang_2'),
            'number_page' => $request->input('number_page'),
            'certification' => $request->input('certification'),
            'apostille' => $request->input('apostille'),
            'cupon' => $cupon,
            'email_stripe' => $request->input('email_stripe'),
            'transaction_stripe' => $request->input('transaction_stripe'),
            'total' => $request->input('total'),
        ]);

        return response()->json(['result' => true, 'msg' => "Realilzado exitosamente."], 202);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assistants;
use App\Models\Constancy;
use App\Models\PaymentProofs;
use App\Models\Discounts;

use Symfony\Component\HttpFoundation\File\MimeType\MimeTypeGuesser;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistroExitoso;
use App\Mail\RegistroExitosoAdmin;
use App\Models\Events;
use App\Models\Categories;
use App\Models\LandingEvento;
use App\Models\Landing;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Openpay;
use App\Models\AcademicGrades;

class AssistantsController extends Controller
{
    public function index(){        
        try {
            $data = Assistants::with('event')
            ->with('category')   
            ->with('payment_types') 
            ->with('tax_regimes')    
            ->with('cfdi')
            ->with('constancy')       
            ->with('payment_proofs')       
            ->where('estatus', 1)
            ->orWhere('estatus', 0)            
            ->orderBy('id', 'DESC')
            ->get();
            if ($data) {
                return response()->json([
                    'result' => true,
                    'data' => $data,
                    'message' => 'Lista de asistentes obtenidas con éxito.'
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
                'message' => 'La lista de asistentes no puede ser obtenida: ' . $e->getMessage()
                ], 200
            );
        }        
    }

    public function store(Request $request)
    {                   
        try {

            DB::beginTransaction();   

            $request->validate([
                // 'codigo_beca' => 'required|unique:assistants|string',
                'categoria_id' => 'required',
                'grado_academico' => 'required',
                'nombre' => 'required',
                'apellido_paterno' => 'required|string',
                'apellido_materno' => 'required|string', 
                'correo_electronico' => 'required',                
                'telefono' => 'required',                
                'pais_id' => 'required',
                'estado' => 'required',
                'ciudad' => 'required',
                'especialidad' => 'required',
                'institucion' => 'required',
                'evento_id' => 'required',                
            ], [                                                
                'categoria_id.required' => 'La categoria es obligatoria.',
                'grado_academico.required' => 'El grado academico es obligatorio.',                
                'nombre.required' => 'El nombre es obligatorio.',                
                'apellido_paterno.required' => 'El apellido paterno es obligatorio.',
                'apellido_materno.required' => 'El apellido materno es obligatorio.',
                'correo_electronico.required' => 'El correo electronico es obligatorio.',
                'telefono.required' => 'El telefono es obligatorio.',                
                'comentario.required' => 'El comentario es obligatorio.',
                'pais_id.required' => 'El pais es obligatorio.',
                'estado.required' => 'El estado es obligatorio.',
                'ciudad.required' => 'La ciudad es obligatoria.',
                'especialidad.required' => 'La especialidad es obligatoria.',
                'institucion.required' => 'La institución es obligatoria.',
                'evento_id.required' => 'El evento es obligatorio.',                
            ]); 

            $input = $request->all();

            //necesitamos buscar al usuario o en su caso generar uno nuevo
            $email = $request->input('correo_electronico');
            //variable para identificar si es nuevo usuario
            $isNewUser = false;
            // password vacio
            $password = '';
            //bucamos al usuario
            $user = User::where('email', $email)->first();

            //creamos un nuevo usuario
            if(!isset($user)) {
                $nombre = $request->input('nombre');
                $apellidoPaterno = $request->input('apellido_paterno');
                $apellidoMaterno = $request->input('apellido_materno');
                $nombreCompleto = $nombre . " " . $apellidoPaterno . " " . $apellidoMaterno;

                $rol = '2';
                $estatus = '1';
                //generar contraseña de 6 caracteres numeros, letras mayuculas y minusculas
                $password = Str::random(6);

                $user = new User([
                    'name' => $nombreCompleto,
                    'email' => $email,
                    'password' => bcrypt($password),
                    'id_rol' => $rol,
                    'estatus' => $estatus,
                    'nombre' => $request->input('nombre'),
                    'apellido_paterno' => $request->input('apellido_paterno'),
                    'apellido_materno' => $request->input('apellido_materno'),
                    'telefono_movil' => $request->input('telefono'),
                    'ciudad' => $request->input('ciudad'),
                ]);
        
                $user->save();

                // nuevo usuario verdadero
                $isNewUser = true;
            }
                        
    
            $assistants = new Assistants([
                'codigo_beca' => $request->input('codigo_beca'),
                'categoria_id' => $request->input('categoria_id'),
                'grado_academico' => $request->input('grado_academico'),
                'nombre' => $request->input('nombre'),
                'apellido_paterno' => $request->input('apellido_paterno'),
                'apellido_materno' => $request->input('apellido_materno'),
                'correo_electronico' => $request->input('correo_electronico'),
                'telefono' => $request->input('telefono'),
                'comentario' => $request->input('comentario'),
                'pais_id' => $request->input('pais_id'),
                'estado' => $request->input('estado'),
                'ciudad' => $request->input('ciudad'),
                'especialidad' => $request->input('especialidad'),
                'institucion' => $request->input('institucion'),
                'evento_id' => $request->input('evento_id'),
                'estatus' => 1,                
                'monto_total' => $request->input('costo'),
                'tipo_pago_id' => $request->input('payment_id'),

                    
                'facturacion' => $request->input('facturacion'),
                'rfc' => $request->input('facturacion') ? $request->input('rfc') : NULL,
                'nombre_fiscal' => $request->input('facturacion') ? $request->input('nombre_fiscal') :  NULL,
                'correo_facturacion' => $request->input('facturacion') ? $request->input('correo_facturacion') : NULL,
                'codigo_postal' => $request->input('facturacion') ? $request->input('codigo_postal') : NULL,
                'regimen_fiscal_id' => $request->input('facturacion') ? $request->input('regimen_fiscal_id') : NULL,
                'cfdi_id' => $request->input('facturacion') ? $request->input('cfdi_id') : NULL,
                'comentario_facturacion' => $request->input('facturacion') ? $request->input('comentario_facturacion') : NULL,

                'estatus_de_pago' => 1,
                'descuento' => $request->input('descuento'),
            ]);

            
            $assistants->save();  
            
            ///////////////////////////////// OPENPAY ///////////////////////////////    
                // Generar un UUID aleatorio
                $uuid = Str::uuid();

                // Concatenar el UUID con el ID de la reserva
                $order_id = 'assistan' . '-' . $uuid;

            if ($request->input('payment_id') == 2) {                            
                $openpay = \Openpay::getInstance(env('OPENPAY_ID'), env('OPENPAY_SK'), 'MX');
                Openpay::setProductionMode(env('OPENPAY_PRODUCTION_MODE'));
                $mode = Openpay::getProductionMode(); 
                
                $customerId = $request->input('openPay');  //token
                $device_sesion = $request->input('device_sesion');     //session           
                        
                $chargeData = [
                    'method' => 'card', 
                    'source_id' => $request->input('openPay'), //token creado con la tarjeta de prueba en frontend por openPay 
                    'amount' => $request->input('monto_openpay'), 
                    'currency' => 'MXN',
                    'order_id' => $order_id,
                    'description' => $request->input('descripcion_openpay'),                
                    'customer' => 
                    [                         
                        'name' => $request->input('nombres_openpay'),
                        'last_name' => $request->input('apellidos_openpay'),
                        'email' => $request->input('email_openpay') //'jorge.vargas@engranedigital.com',                        
                    ],
                    'device_session_id' => $device_sesion, //Session creada en frontend con openPay
                ];
                // Crear el cargo
                $charge = $openpay->charges->create($chargeData);                
            }
            ///////////////////////////////// OPENPAY ///////////////////////////////


            $discount = Discounts::where('codigo_descuento', $request->input('codigo_beca'))->first();
            if ($discount) {
                // Resta 1 al descuento
                $discount->cantidad_disponible = $discount->cantidad_disponible - 1;
                $discount->save();
            
                // Guardamos el porcentaje de descuento
                $assistants->descuento = $discount->porcentaje;
                $assistants->save();
            }
            


            if (isset($input['constancias'])) {
                $this->guardarArchivoYConstancia($input, $assistants);
            }            


            if ($request->input('comprobantes')) {
                foreach ($request->input('comprobantes') as $comprobante) {
                    $base64String = $comprobante['comprobante'];
                    $data = explode(',', $base64String);
                    $fileContents = base64_decode($data[1]);
                
                    $extension = 'pdf'; // Predeterminado
                    $mime = finfo_buffer(finfo_open(), $fileContents, FILEINFO_MIME_TYPE);
                
                    // Determinar la extensión según el tipo MIME
                    if ($mime === 'image/jpeg' || $mime === 'image/jpg') {
                        $extension = 'jpg';
                    } elseif ($mime === 'image/png') {
                        $extension = 'png';
                    }
                
                    $fileName = time() . '_comprobante.' . $extension;
                                
                    $filePath = public_path('assets/comprobantes/') . $fileName;
                    file_put_contents($filePath, $fileContents);
                                                    
                    $paymentProofs = new PaymentProofs([
                        'date' => $comprobante['fecha'],
                        'amount' => $comprobante['monto'], 
                        'motion' => $comprobante['numero_movimiento'],
                        'voucher' => $fileName, 
                        'payment_id' =>  $comprobante['tipo_pago'], 
                        'estatus' => 0,                    
                    ]);
                        
                    $assistants->payment_proofs()->save($paymentProofs);
                }   
            } 

            if ($request->input('openPay')) {                
                $date = Carbon::now();
                $paymentProofs = new PaymentProofs([
                    'date' => $date,
                    'amount' => $request->input('monto_openpay'), 
                    'motion' => $charge->id,
                    'voucher' => '', 
                    'payment_id' =>  $request->input('payment_id'), 
                    'estatus' => 0,                    
                ]);
                    
                $assistants->payment_proofs()->save($paymentProofs);                  
            }     

            DB::commit(); 


            //despues de cofirmas los cambios en db se envia el correo
            // data necesaria para enviar correo
            $evento = Events::where('id', $request->input('evento_id'))->first();
            $categoria = Categories::where('id', $request->input('categoria_id'))->first();            
            $landingEvento = LandingEvento::where('id', 1)->first();
            $landing = Landing::first();
            $grado_academico = AcademicGrades::where('descripcion', $request->input('grado_academico'))->first();

            //enviar correo de confirmacion
            Mail::to($user->email)
                ->send(new RegistroExitosoAdmin(
                    $user, 
                    $isNewUser, 
                    $password, 
                    $evento, 
                    $categoria, 
                    $landingEvento, 
                    $assistants, 
                    $landing,
                    $grado_academico
                )
            );



            return response()->json([
                'result' => true,
                'message' => 'Asistente creado con éxito'
                ], 200
            );

        // } catch (\Exception $e) {
        //     return response()->json(                
        //         [
        //             'result' => false,
        //             'message' => 'Error al crear el asistente: ' . $e->getMessage()
        //         ], 200
        //     );
        // }

                    
        } catch (\OpenpayApiTransactionError $e) {
            DB::rollBack();
            error_log('ERROR on the transaction: ' . $e->getMessage() . 
                ' [error code: ' . $e->getErrorCode() . 
                ', error category: ' . $e->getCategory() . 
                ', HTTP code: '. $e->getHttpCode() . 
                ', request ID: ' . $e->getRequestId() . ']', 0);
        
        } catch (\OpenpayApiRequestError $e) {
            DB::rollback();
            return response()->json(
                [
                    'result' => false,
                    'message' => 'Error al realizar el cargo OpenpayApiRequestError: ' . $e->getMessage()
                    // 'message' => "Error al realizar el cargo OpenpayApiRequestError",
                    // 'error' => $e->getMessage()
                ], 200
            );
        } catch (\OpenpayApiConnectionError $e) {
            DB::rollBack();
            return response()->json(
                [
                    'result' => false,
                    'message' => "Error al realizar el cargo OpenpayApiConnectionError" . $e->getMessage(),
                    // 'error' => $e->getMessage()
                ], 200
            );        
        } catch (\OpenpayApiError $e) {
            DB::rollBack();
            return response()->json(
                [
                    'result' => false,
                    'message' => "Error al realizar el cargo OpenpayApiError" . $e->getMessage(),
                    // 'error' => $e->getMessage()
                ], 200
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(
                [
                    'result' => false,
                    'message' => "Error al realizar el cargo Ex" . $e->getMessage(),
                    // 'error' => $e->getMessage()
                ], 200
            );
        }
    }

        
    public function update(Request $request, $id){
        
        try {
            $input = $request->all();

            // return response()->json([
            //     'result' => false,
            //     'message' => 'Asistente no encontrado.',
            //     'data' => $input,
            // ], 200);

            $request->validate([                                
                // 'academic_grade_id' => 'required',
                'nombre' => 'required',
                'apellido_paterno' => 'required|string',
                'apellido_materno' => 'required|string', 
                'correo_electronico' => 'required',                
                'telefono' => 'required',                
                'pais_id' => 'required',
                'estado' => 'required',
                'ciudad' => 'required',
                'especialidad' => 'required',
                'institucion' => 'required',                
            ], [                                                                
                'academic_grade_id.required' => 'El grado academico es obligatorio.',                
                'nombre.required' => 'El nombre es obligatorio.',                
                'apellido_paterno.required' => 'El apellido paterno es obligatorio.',
                'apellido_materno.required' => 'El apellido materno es obligatorio.',
                'correo_electronico.required' => 'El correo electronico es obligatorio.',
                'telefono.required' => 'El telefono es obligatorio.',                
                'comentario.required' => 'El comentario es obligatorio.',
                'pais_id.required' => 'El pais es obligatorio.',
                'estado.required' => 'El estado es obligatorio.',
                'ciudad.required' => 'La ciudad es obligatoria.',
                'especialidad.required' => 'La especialidad es obligatoria.',
                'institucion.required' => 'La institución es obligatoria.',                
            ]);                   
                
            // if (isset($input['estatus'])) {                
            //     $input['estatus'] = $input['estatus'] ? 1 : 0;
            // }
            
            $assistant = Assistants::find($id);
            
            if (!$assistant) {
                return response()->json([
                    'result' => false,
                    'message' => 'Asistente no encontrado.',
                ], 200);
            }        
            
            $assistant->update($input);


             ///////////////////////////////// OPENPAY ///////////////////////////////    
                // Generar un UUID aleatorio
                $uuid = Str::uuid();

                // Concatenar el UUID con el ID de la reserva
                $order_id = 'reserve' . '-' . $uuid;

                if ($request->input('payment_id') == 2) {                            
                    $openpay = \Openpay::getInstance(env('OPENPAY_ID'), env('OPENPAY_SK'), 'MX');
                    Openpay::setProductionMode(env('OPENPAY_PRODUCTION_MODE'));
                    $mode = Openpay::getProductionMode(); 
                    
                    $customerId = $request->input('openPay');  //token
                    $device_sesion = $request->input('device_sesion');     //session           
                            
                    $chargeData = [
                        'method' => 'card', 
                        'source_id' => $request->input('openPay'), //token creado con la tarjeta de prueba en frontend por openPay 
                        'amount' => $request->input('monto_openpay'), 
                        'currency' => 'MXN',
                        'order_id' => $order_id,
                        'description' => $request->input('descripcion_openpay'),                
                        'customer' => 
                        [                         
                            'name' => $request->input('nombres_openpay'),
                            'last_name' => $request->input('apellidos_openpay'),
                            'email' => $request->input('email_openpay') //'jorge.vargas@engranedigital.com',                        
                        ],
                        'device_session_id' => $device_sesion, //Session creada en frontend con openPay
                    ];
                    // Crear el cargo
                    $charge = $openpay->charges->create($chargeData);                
                }
            ///////////////////////////////// OPENPAY ///////////////////////////////


            if (isset($input['constancias'])) {
                $this->guardarArchivoYConstancia($input, $assistant);
            }

            // if (isset($input['comprobantes'])) {
            //     $this->guardarArchivoYConstanciaTwo($input, $assistant);
            // }

            if ($request->input('comprobantes')) {
                // Obtener todos los IDs de comprobantes del request
                $comprobanteIds = array_column($request->input('comprobantes'), 'id');
            
                // Eliminar los comprobantes que ya no están en la lista
                PaymentProofs::where('assistants_id', $assistant->id)
                    ->whereNotIn('id', $comprobanteIds)
                    ->delete();
            
                foreach ($request->input('comprobantes') as $comprobante) {
                    // Buscar el comprobante existente
                    $assistantsDetailsComprobante = PaymentProofs::find($comprobante['id']);
            
                    // Si no existe, crear uno nuevo
                    if (!$assistantsDetailsComprobante) {
                        $assistantsDetailsComprobante = new PaymentProofs();
                        $comprobante['estatus'] = 0; // Asegurarse de que 'estatus' siempre tenga un valor
                    }
            
                    // Si el comprobante tiene una imagen adjunta, procesarla
                    if (isset($comprobante['voucher']) && str_starts_with($comprobante['voucher'], 'data:image')) {
                        $base64String = $comprobante['voucher'];
                        $data = explode(',', $base64String);
                        $fileContents = base64_decode($data[1]);
            
                        $extension = 'pdf'; // Predeterminado
                        $mime = finfo_buffer(finfo_open(), $fileContents, FILEINFO_MIME_TYPE);
            
                        // Determinar la extensión según el tipo MIME
                        if ($mime === 'image/jpeg' || $mime === 'image/jpg') {
                            $extension = 'jpg';
                        } elseif ($mime === 'image/png') {
                            $extension = 'png';
                        }
            
                        $fileName = time() . '_comprobante.' . $extension;
            
                        $filePath = public_path('assets/comprobantes/') . $fileName;
                        file_put_contents($filePath, $fileContents);
            
                        $comprobante['voucher'] = $fileName;
                    }
            
                    // Actualizar los datos del comprobante
                    $assistantsDetailsComprobante->fill($comprobante);
            
                    $assistant->payment_proofs()->save($assistantsDetailsComprobante);
                }   
            }


            if ($request->input('openPay')) {                
                $date = Carbon::now();

                // Buscar el comprobante existente
                $assistantsDetailsComprobante = PaymentProofs::where('motion', $charge->id)->first();
        
                // Si no existe, crear uno nuevo
                if (!$assistantsDetailsComprobante) {
                    $assistantsDetailsComprobante = new PaymentProofs();
                }
            
                // Actualizar los datos del comprobante
                $assistantsDetailsComprobante->fill([
                    'date' => $date,
                    'amount' => $request->input('monto_openpay'), 
                    'motion' => $charge->id,
                    'voucher' => '', 
                    'payment_id' =>  $request->input('payment_id'), 
                    'estatus' => 0,
                ]);
            
                $assistant->payment_proofs()->save($assistantsDetailsComprobante);                              
            } 
    
            return response()->json([
                'result' => true,
                'message' => 'Asistente editado con éxito'
                ], 200
            );


        // } catch (\Exception $e) {
        //     return response()->json([
        //         'result' => false,
        //         'message' => 'Error al editar el asistete: ' . $e->getMessage(),
        //         'line' => 'La línea del error es: ' . $e->getLine()
        //     ], 200);
        // }

        } catch (\OpenpayApiTransactionError $e) {
            DB::rollBack();
            error_log('ERROR on the transaction: ' . $e->getMessage() . 
                ' [error code: ' . $e->getErrorCode() . 
                ', error category: ' . $e->getCategory() . 
                ', HTTP code: '. $e->getHttpCode() . 
                ', request ID: ' . $e->getRequestId() . ']', 0);
        
        } catch (\OpenpayApiRequestError $e) {
            DB::rollback();
            return response()->json(
                [
                    'result' => false,
                    'message' => 'Error al realizar el cargo OpenpayApiRequestError: ' . $e->getMessage()
                    // 'message' => "Error al realizar el cargo OpenpayApiRequestError",
                    // 'error' => $e->getMessage()
                ], 200
            );
        } catch (\OpenpayApiConnectionError $e) {
            DB::rollBack();
            return response()->json(
                [
                    'result' => false,
                    'message' => "Error al realizar el cargo OpenpayApiConnectionError" . $e->getMessage(),
                    // 'error' => $e->getMessage()
                ], 200
            );        
        } catch (\OpenpayApiError $e) {
            DB::rollBack();
            return response()->json(
                [
                    'result' => false,
                    'message' => "Error al realizar el cargo OpenpayApiError" . $e->getMessage(),
                    // 'error' => $e->getMessage()
                ], 200
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(
                [
                    'result' => false,
                    'message' => "Error al realizar el cargo Ex" . $e->getMessage(),
                    // 'error' => $e->getMessage()
                ], 200
            );
        }
            
                       
    }


    public function delete($id){                 
        
        $assitant = Assistants::find($id);                        
        $assitant->estatus = 2; 
        $assitant->save();

        return response()->json([
            'result' => true,
            'message' => 'Asistente eliminado con éxito'
            ], 200
        );

    }



    private function guardarArchivoYConstancia($input, $assistants)
    {
        $base64String = $input['constancias'];
        $data = explode(',', $base64String);
        $fileContents = base64_decode($data[1]);
    
        $extension = 'pdf'; // Predeterminado
        $mime = finfo_buffer(finfo_open(), $fileContents, FILEINFO_MIME_TYPE);
    
        // Determinar la extensión según el tipo MIME
        if ($mime === 'image/jpeg' || $mime === 'image/jpg') {
            $extension = 'jpg';
        } elseif ($mime === 'image/png') {
            $extension = 'png';
        }
    
        $fileName = time() . '_constancia.' . $extension;
    
        // Guarda el archivo en el servidor
        file_put_contents(public_path('assets/constancias/') . $fileName, $fileContents);
    
        $constancy = new Constancy([
            'nombre' => $fileName,
            'estatus' => 1,
        ]);
    
        $assistants->constancy()->save($constancy);
    }

    private function guardarArchivoYConstanciaTwo($input, $assistants)
    {        
        $base64String = $input['comprobantes'];
        $data = explode(',', $base64String);
        $fileContents = base64_decode($data[1]);
    
        $extension = 'pdf'; // Predeterminado
        $mime = finfo_buffer(finfo_open(), $fileContents, FILEINFO_MIME_TYPE);
    
        // Determinar la extensión según el tipo MIME
        if ($mime === 'image/jpeg' || $mime === 'image/jpg') {
            $extension = 'jpg';
        } elseif ($mime === 'image/png') {
            $extension = 'png';
        }
    
        $fileName = time() . '_comprobante.' . $extension;
    
        // Guarda el archivo en el servidor
        file_put_contents(public_path('assets/comprobantes/') . $fileName, $fileContents);
    
        $paymentProofs = new PaymentProofs([
            'nombre' => $fileName,
            'estatus' => 1,
        ]);
    
        $assistants->payment_proofs()->save($paymentProofs);            
    }



    public function guardarAsistente(Request $request)
    {                   
        try {

            DB::beginTransaction();

            $request->validate([
                // 'codigo_beca' => 'required|unique:assistants|string',
                'categoria_id' => 'required',
                'grado_academico' => 'required',
                'nombre' => 'required',
                'apellido_paterno' => 'required|string',
                'apellido_materno' => 'required|string', 
                'correo_electronico' => 'required',                
                'telefono' => 'required',                
                'pais_id' => 'required',
                'estado' => 'required',
                'ciudad' => 'required',
                'especialidad' => 'required',
                'institucion' => 'required',
                'evento_id' => 'required',
                'landing_id' => 'required'                
            ], [                                                
                'categoria_id.required' => 'La categoria es obligatoria.',
                'grado_academico.required' => 'El grado academico es obligatorio.',                
                'nombre.required' => 'El nombre es obligatorio.',                
                'apellido_paterno.required' => 'El apellido paterno es obligatorio.',
                'apellido_materno.required' => 'El apellido materno es obligatorio.',
                'correo_electronico.required' => 'El correo electronico es obligatorio.',
                'telefono.required' => 'El telefono es obligatorio.',                
                'comentario.required' => 'El comentario es obligatorio.',
                'pais_id.required' => 'El pais es obligatorio.',
                'estado.required' => 'El estado es obligatorio.',
                'ciudad.required' => 'La ciudad es obligatoria.',
                'especialidad.required' => 'La especialidad es obligatoria.',
                'institucion.required' => 'La institución es obligatoria.',
                'evento_id.required' => 'El evento es obligatorio.',
                'landing_id.required' => 'El evento es obligatorio'                
            ]); 

            $input = $request->all();

            //necesitamos buscar al usuario o en su caso generar uno nuevo
            $email = $request->input('correo_electronico');
            //variable para identificar si es nuevo usuario
            $isNewUser = false;
            // password vacio
            $password = '';
            //bucamos al usuario
            $user = User::where('email', $email)->first();
            //creamos un nuevo usuario
            if(!isset($user)) {
                $nombre = $request->input('nombre');
                $apellidoPaterno = $request->input('apellido_paterno');
                $apellidoMaterno = $request->input('apellido_materno');
                $nombreCompleto = $nombre . " " . $apellidoPaterno . " " . $apellidoMaterno;

                $rol = '2';
                $estatus = '1';
                //generar contraseña de 6 caracteres numeros, letras mayuculas y minusculas
                $password = Str::random(6);

                $user = new User([
                    'name' => $nombreCompleto,
                    'email' => $email,
                    'password' => bcrypt($password),
                    'id_rol' => $rol,
                    'estatus' => $estatus,
                    'nombre' => $request->input('nombre'),
                    'apellido_paterno' => $request->input('apellido_paterno'),
                    'apellido_materno' => $request->input('apellido_materno'),
                    'telefono_movil' => $request->input('telefono'),
                    'ciudad' => $request->input('ciudad'),
                ]);
        
                $user->save();

                // nuevo usuario verdadero
                $isNewUser = true;
            }
            
            // if (isset($input['estatus'])) {                
            //     $input['estatus'] = $input['estatus'] ? 1 : 0;
            // }
    
            $assistants = new Assistants([
                'codigo_beca' => $request->input('codigo_beca'),
                'categoria_id' => $request->input('categoria_id'),
                'academic_grade_id' => $request->input('grado_academico'),
                'nombre' => $request->input('nombre'),
                'apellido_paterno' => $request->input('apellido_paterno'),
                'apellido_materno' => $request->input('apellido_materno'),
                'correo_electronico' => $request->input('correo_electronico'),
                'telefono' => $request->input('telefono'),
                'comentario' => $request->input('comentario'),
                'pais_id' => $request->input('pais_id'),
                'estado' => $request->input('estado'),
                'ciudad' => $request->input('ciudad'),
                'especialidad' => $request->input('especialidad'),
                'institucion' => $request->input('institucion'),
                'evento_id' => $request->input('evento_id'),
                'estatus' => 1,                
                'monto_total' => $request->input('costo'),
                'tipo_pago_id' => $request->input('payment_id'),

                    
                'facturacion' => $request->input('facturacion'),
                'rfc' => $request->input('facturacion') ? $request->input('rfc') : NULL,
                'nombre_fiscal' => $request->input('facturacion') ? $request->input('nombre_fiscal') :  NULL,
                'correo_facturacion' => $request->input('facturacion') ? $request->input('correo_facturacion') : NULL,
                'codigo_postal' => $request->input('facturacion') ? $request->input('codigo_postal') : NULL,
                'regimen_fiscal_id' => $request->input('facturacion') ? $request->input('regimen_fiscal_id') : NULL,
                'cfdi_id' => $request->input('facturacion') ? $request->input('cfdi_id') : NULL,
                'comentario_facturacion' => $request->input('facturacion') ? $request->input('comentario_facturacion') : NULL,

                'estatus_de_pago' => 1,
                'user_id' => $user->id,
            ]);

            $assistants->save();

            ///////////////////////////////// OPENPAY ///////////////////////////////    
            // Generar un UUID aleatorio
            $uuid = Str::uuid();

            // Concatenar el UUID con el ID de la reserva
            $order_id = 'assistan' . '-' . $uuid;

            if ($request->input('payment_id') == 2) {                            
                $openpay = \Openpay::getInstance(env('OPENPAY_ID'), env('OPENPAY_SK'), 'MX');
                Openpay::setProductionMode(env('OPENPAY_PRODUCTION_MODE'));
                $mode = Openpay::getProductionMode(); 
                
                $customerId = $request->input('openPay');  //token
                $device_sesion = $request->input('device_sesion');     //session           
                        
                $chargeData = [
                    'method' => 'card', 
                    'source_id' => $request->input('openPay'), //token creado con la tarjeta de prueba en frontend por openPay 
                    'amount' => $request->input('monto_openpay'), 
                    'currency' => 'MXN',
                    'order_id' => $order_id,
                    'description' => $request->input('descripcion_openpay'),                
                    'customer' => 
                    [                         
                        'name' => $request->input('nombres_openpay'),
                        'last_name' => $request->input('apellidos_openpay'),
                        'email' => $request->input('email_openpay') //'jorge.vargas@engranedigital.com',                        
                    ],
                    'device_session_id' => $device_sesion, //Session creada en frontend con openPay
                ];
                // Crear el cargo
                $charge = $openpay->charges->create($chargeData);                
            }
            ///////////////////////////////// OPENPAY ///////////////////////////////

            $discount = Discounts::where('codigo_descuento', $request->input('codigo_beca'))->first();
            if ($discount) {
                // Resta 1 al descuento
                $discount->cantidad_disponible = $discount->cantidad_disponible - 1;
                $discount->save();
            
                // guardamos el porcentaje de descuento
                $assistants->descuento = $discount->porcentaje;
                $assistants->save();
            }

            if (isset($input['constancias'])) {
                $this->guardarArchivoYConstancia($input, $assistants);
            }

            // if (isset($input['comprobantes'])) {
            //     $this->guardarArchivoYConstanciaTwo($input, $assistants);
            // }

            if ($request->input('comprobantes')) {
                foreach ($request->input('comprobantes') as $comprobante) {
                    $base64String = $comprobante['comprobante'];
                    $data = explode(',', $base64String);
                    $fileContents = base64_decode($data[1]);
                
                    $extension = 'pdf'; // Predeterminado
                    $mime = finfo_buffer(finfo_open(), $fileContents, FILEINFO_MIME_TYPE);
                
                    // Determinar la extensión según el tipo MIME
                    if ($mime === 'image/jpeg' || $mime === 'image/jpg') {
                        $extension = 'jpg';
                    } elseif ($mime === 'image/png') {
                        $extension = 'png';
                    }
                
                    $fileName = time() . '_comprobante.' . $extension;
                                
                    $filePath = public_path('assets/comprobantes/') . $fileName;
                    file_put_contents($filePath, $fileContents);
                                                    
                    $paymentProofs = new PaymentProofs([
                        'date' => $comprobante['fecha'],
                        'amount' => $comprobante['monto'], 
                        'motion' => $comprobante['numero_movimiento'],
                        'voucher' => $fileName, 
                        'payment_id' =>  $comprobante['tipo_pago'], 
                        'estatus' => 0,                    
                    ]);
                        
                    $assistants->payment_proofs()->save($paymentProofs);
                }   
            } 

            if ($request->input('openPay')) {                
                $date = Carbon::now();
                $paymentProofs = new PaymentProofs([
                    'date' => $date,
                    'amount' => $request->input('monto_openpay'), 
                    'motion' => $charge->id,
                    'voucher' => '', 
                    'payment_id' =>  $request->input('payment_id'), 
                    'estatus' => 0,                    
                ]);
                    
                $assistants->payment_proofs()->save($paymentProofs);                  
            }     

            DB::commit(); 

            //despues de cofirmas los cambios en db se envia el correo
            // data necesaria para enviar correo
            $evento = Events::where('id', $request->input('evento_id'))->first();
            $categoria = Categories::where('id', $request->input('categoria_id'))->first();
            $landingEvento = LandingEvento::where('id', $request->input('landing_id'))->first();
            $landing = Landing::first();
            $grado_academico = AcademicGrades::where('id', $request->input('grado_academico'))->first();

            //enviar correo de confirmacion
            Mail::to($user->email)
                ->send(new RegistroExitoso(
                    $user, 
                    $isNewUser, 
                    $password, 
                    $evento, 
                    $categoria, 
                    $landingEvento, 
                    $assistants, 
                    $landing,
                    $grado_academico
                )
            );

            return response()->json([
                'result' => true,
                'message' => 'Asistente creado con éxito'
                ], 200
            );

        } catch (\OpenpayApiTransactionError $e) {
            DB::rollBack();
            error_log('ERROR on the transaction: ' . $e->getMessage() . 
                ' [error code: ' . $e->getErrorCode() . 
                ', error category: ' . $e->getCategory() . 
                ', HTTP code: '. $e->getHttpCode() . 
                ', request ID: ' . $e->getRequestId() . ']', 0);
        
        } catch (\OpenpayApiRequestError $e) {
            DB::rollback();
            return response()->json(
                [
                    'result' => false,
                    'message' => 'Error al realizar el cargo OpenpayApiRequestError: ' . $e->getMessage()
                    // 'message' => "Error al realizar el cargo OpenpayApiRequestError",
                    // 'error' => $e->getMessage()
                ], 200
            );
        } catch (\OpenpayApiConnectionError $e) {
            DB::rollBack();
            return response()->json(
                [
                    'result' => false,
                    'message' => "Error al realizar el cargo OpenpayApiConnectionError" . $e->getMessage(),
                    // 'error' => $e->getMessage()
                ], 200
            );        
        } catch (\OpenpayApiError $e) {
            DB::rollBack();
            return response()->json(
                [
                    'result' => false,
                    'message' => "Error al realizar el cargo OpenpayApiError" . $e->getMessage(),
                    // 'error' => $e->getMessage()
                ], 200
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(
                [
                    'result' => false,
                    'message' => "Error al realizar el cargo Ex" . $e->getMessage(),
                    // 'error' => $e->getMessage()
                ], 200
            );
        }
    }

    public function listById($id) {        
        try {
            $data = Assistants::with([
                'event' => function($query) {
                    $query->with('grados');
                },
                'category',
                'payment_types',
                'tax_regimes',
                'cfdi',
                'constancy',
                'payment_proofs',
                'academic_grade',
                'payment_proofs'
            ])
            ->where('estatus', 1)
            ->where('user_id', $id)
            ->orWhere('estatus', 0)
            ->orderBy('id', 'DESC')
            ->get();

            return response()->json([
                'result' => true,
                'data' => $data,
                'message' => 'Lista de asistentes obtenidas con éxito.'
                ], 201
            );

        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => 'La lista de asistentes no puede ser obtenida: ' . $e->getMessage()
                ], 200
            );
        }        
    }
}
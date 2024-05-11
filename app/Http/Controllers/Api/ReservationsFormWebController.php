<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LandingEvento;
use App\Models\PlanTypes;
use Illuminate\Support\Facades\DB;
use App\Models\ReservationRooms;
use App\Models\ReservationRoomsDetails;
use App\Http\Controllers\Api\RoomsByHotelsController;
use App\Mail\ReservationConfirmationMail;
use App\Models\Hotels;
use App\Models\ReservationDetails;
use App\Models\Reservations;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Models\ReservePayments;
use Carbon\Carbon;
use App\Models\RoomsByHotels;

use Openpay;
class ReservationsFormWebController extends Controller
{
    protected $roomsByHotelsController;

    public function __construct(RoomsByHotelsController $roomsByHotelsController)
    {
        $this->roomsByHotelsController = $roomsByHotelsController;
    }

    public function getLandingEventoBySlug($slug) {
        try {
            $data = LandingEvento::where('slug', $slug)
            ->with('evento', function($query){
                $query->with('hotel', function($query) {
                    $query->with('servicios');
                    $query->with('roomsByHotels', function($query) {
                        $query->where('vigencia', '>=', now())
                        ->where('estatus', 1)
                        ->where('cantidad_registrada', '>', 'habitaciones_disponibles');
                    });
                });
            })
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->first();

            return response()->json([
                "result" => true,
                "data" => $data,
                "message" => "lista de landing de eventos obtenida con éxito"
            ], 200);
            
        }catch(\Exception $e) {
            return response()->json([
                "result" => false,
                "message" => "La lista de landing eventos no puedo ser obtenida: " . $e->getMessage()
            ], 500);
        }
    }

    public function getPlanTypes()
    {
        try {
            $data = PlanTypes::where('estatus', 1)
                ->orWhere('estatus', 0)
                ->orderBy('id', 'DESC')
                ->get();

            return response()->json([
                'result' => true,
                'data' => $data,
                'message' => 'Lista de tipos de plan obtenidas con éxito.'
                ], 200
            );
            
        }catch(\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => 'La lista de tipos de plan no puede ser obtenida: ' . $e->getMessage()
                ], 200
            );
        }
    }

    public function saveReservation(Request $request)
    {
        try {

            DB::beginTransaction();

            $this->validateReservationRequest($request);

            $reservations = new Reservations([
                'event_id' => $request->input('event_id'),
                'hotel_id' => $request->input('hotel_id'),
                'plan_id' => $request->input('plan_id'),
                'fecha_entrada' => $request->input('fecha_entrada'),                
                'fecha_salida' => $request->input('fecha_salida'),                
                'cantidad_noches' => $request->input('cantidad_noches'),
                'nombre_solicitante' => $request->input('nombre_solicitante'),
                'apellido_solicitante' => $request->input('apellido_solicitante'),
                'correo_solicitante' => $request->input('correo_solicitante'),
                'telefono_solicitante' => $request->input('telefono_solicitante'),
                'ciudad_solicitante' => $request->input('ciudad_solicitante'),
                'monto_total' => $request->input('monto_total'),
                'observaciones' => $request->input('observaciones'),
                'estatus' => 0,                
            ]);
    
            $reservations->save();

            $conceptCounts = [];
            foreach ($request->input('reservation_details') as $detail) {
                $concept = $detail['concept'];
                // Si el concepto no existe en el array $conceptCounts, inicializa el contador en 0
                if (!isset($conceptCounts[$concept])) {
                    $conceptCounts[$concept] = 0;
                }
                // Incrementa el contador para el concepto actual
                $conceptCounts[$concept]++;
            }

            foreach ($conceptCounts as $concept => $count) {
                // Encuentra el habitacionesHoteles correspondiente para cada concepto
                $habitacionesHoteles = RoomsByHotels::where('hotel_id', $request->input('hotel_id'))
                                                    ->where('tipo_habitacion', $concept)
                                                    ->first();                                                  



                // Si se encontró un habitacionesHoteles correspondiente
                if ($habitacionesHoteles) {

                    $cantidadV = $habitacionesHoteles->cantidad_registrada - $habitacionesHoteles->habitaciones_disponibles;

                    if ($count > $cantidadV ) {
                        return response()->json([
                            'result' => false,
                            'message' => 'La cantidad de habitaciones disponibles es: ' . $cantidadV . ' y la cantidad que requieres es de ' . $count,
                        ], 200);
                    }
                    
                    $cantidad = $habitacionesHoteles->habitaciones_disponibles + $count;                                    

                    // Descuenta la cantidad correcta de las habitaciones disponibles
                    $habitacionesHoteles->habitaciones_disponibles = $cantidad;

                    // Guarda los cambios en el habitacionesHoteles
                    $habitacionesHoteles->save();
                }
            }

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

            foreach ($request->input('reservation_details') as $details) {
                $reservationDetailsModel = new ReservationDetails([
                    'concept' => $details['concept'],
                    'price' => $details['price'], 
                ]);
            
                $reservations->reservationDetails()->save($reservationDetailsModel);
            }

            foreach ($request->input('reservation_rooms') as $room) {
                $room_type_name = $this->roomsByHotelsController->getRoomTypeNameByRoomId($room['room_id']);

                if ($room_type_name !== null) {
                    $reservationRoomsModel = new ReservationRooms([
                        'room_id' => $room['room_id'],
                        'room_type_name' => $room_type_name,
                        'adults_quantity' => $room['adults_quantity'],
                        'minor_quantity' => $room['minor_quantity'],
                        'estatus' => 1,
                    ]);

                    $reservations->reservationRooms()->save($reservationRoomsModel);

                    $this->saveRoomDetails($room['adults'], 'adult', $reservationRoomsModel);
                    $this->saveRoomDetails($room['minors'], 'minor', $reservationRoomsModel);
                } else {
                    DB::rollBack();
                    return response()->json([
                        'result' => false,
                        'message' => 'No se pudo encontrar el tipo de habitación para el room_id: ' . $room['room_id'],
                    ], 400);
                }
            }

            //necesitamos buscar al usuario o en su caso generar uno nuevo
            $email = $request->input('correo_solicitante');
            //variable para identificar si es nuevo usuario
            $isNewUser = false;
            // password vacio
            $password = '';
            //bucamos al usuario
            $user = User::where('email', $email)->first();
            //creamos un nuevo usuario
            if(!isset($user)) {
                $nombre = $request->input('nombre_solicitante');
                $apellidoPaterno = $request->input('apellido_solicitante');
                $apellidoMaterno = null;
                $nombreCompleto = $nombre . " " . $apellidoPaterno;

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
                    'nombre' => $nombre,
                    'apellido_paterno' => $apellidoPaterno,
                    'apellido_materno' => $apellidoMaterno,
                    'telefono_movil' => $request->input('telefono_solicitante'),
                    'ciudad' => $request->input('ciudad_solicitante'),
                ]);
        
                $user->save();

                // nuevo usuario verdadero
                $isNewUser = true;
            }

            //asociar la reservacion a un usuario
            $reservations->user_id = $user->id;
            $reservations->save();

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
                                
                    $filePath = public_path('assets/comprobantes_de_pago/') . $fileName;
                    file_put_contents($filePath, $fileContents);
                                                    
                    $reservationDetailsComprobante = new ReservePayments([
                        'date' => $comprobante['fecha'],
                        'amount' => $comprobante['monto'], 
                        'motion' => $comprobante['numero_movimiento'],
                        'voucher' => $fileName, 
                        'payment_id' =>  $comprobante['tipo_pago'], 
                        'estatus' => 0,                    
                    ]);
                        
                    $reservations->reservePayments()->save($reservationDetailsComprobante);
                }   
            } 
            
            if ($request->input('openPay')) {                
                $date = Carbon::now();
                $reservationDetailsComprobante = new ReservePayments([
                    'date' => $date,
                    'amount' => $request->input('monto_openpay'), 
                    'motion' => $charge->id,
                    'voucher' => '', 
                    'payment_id' =>  $request->input('payment_id'), 
                    'estatus' => 0,                    
                ]);
                    
                $reservations->reservePayments()->save($reservationDetailsComprobante);                  
            } 

            DB::commit();

            //data necesaria para enviar correo
            $hotel = Hotels::where('id', $request->input('hotel_id'))->first();
            $plan = PlanTypes::where('id', $request->input('plan_id'))->first();
            $numeroAdultos = $reservations->reservationRooms()->sum('adults_quantity');
            $numeroMenores = $reservations->reservationRooms()->sum('minor_quantity');
            
            $rooms = $reservations->reservationRooms()->pluck('room_type_name');
            $tiposHabitaciones = implode(', ', $rooms->toArray());

            $adultosRooms = $reservations->reservationRooms()->pluck('adults_quantity');
            $adultosHabitaciones = implode(', ', $adultosRooms->toArray());

            $menoresRooms = $reservations->reservationRooms()->pluck('minor_quantity');
            $menoresHabitaciones = implode(', ', $menoresRooms->toArray());

            $priceRooms = $reservations->reservationDetails()->pluck('price')->filter(function ($price) {
                return $price > 0; // Filtrar solo los precios mayores o iguales a cero
            });
            
            $preciosHabitaciones = $priceRooms->map(function ($price) {
                return '$' . number_format($price, 2); // Formatear los precios como $XXX.XX
            })->implode(', ');

            $habitacionesReservadas = $reservations->reservationRooms()->count();

            //enviar correo de confirmacion
            Mail::to($user->email)->send(new ReservationConfirmationMail(
                $user, 
                $isNewUser, 
                $password, 
                $reservations, 
                $hotel, 
                $plan, 
                $numeroAdultos, 
                $numeroMenores, 
                $tiposHabitaciones,
                $adultosHabitaciones,
                $menoresHabitaciones,
                $preciosHabitaciones,
                $habitacionesReservadas
            ));

            return response()->json([
                'result' => true,
                'message' => 'Reservacion creada con éxito'
                ], 200
            );
            
        // } catch (\Exception $e) {
        //     DB::rollBack();

        //     return response()->json(                
        //         [
        //             'result' => false,
        //             'message' => "Error al crear la reservación",
        //             'error' => $e->getMessage()
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

    private function validateReservationRequest(Request $request)
    {
        $request->validate([
            'event_id' => 'required|numeric',
            'hotel_id' => 'required|numeric',
            'plan_id' => 'required|numeric',
            'fecha_entrada' => 'required|date',
            'fecha_salida' => 'required|date',
            'cantidad_noches' => 'required|integer',
            'nombre_solicitante' => 'required|string',
            'apellido_solicitante' => 'required|string',
            'correo_solicitante' => 'required|string',
            'telefono_solicitante' => 'required|string',
            'ciudad_solicitante' => 'required|string',
            'monto_total' => 'required|numeric|between:0,9999999.99',
            'reservation_details' => 'required|array|min:1',
            'reservation_details.*.concept' => 'required|string',
            'reservation_details.*.price' => 'required|numeric|between:0,9999999.99',
            'reservation_rooms' => 'required|array|min:1',
            'reservation_rooms.*.room_id' => 'required|numeric',
            'reservation_rooms.*.adults_quantity' => 'required|integer|min:0',
            'reservation_rooms.*.minor_quantity' => 'required|integer|min:0',
            'reservation_rooms.*.adults' => 'required|array|min:1',
            'reservation_rooms.*.adults.*.name' => 'required|string',
            'reservation_rooms.*.adults.*.last_name' => 'required|string',
            'reservation_rooms.*.minors' => 'array|min:0',
            'reservation_rooms.*.minors.*.name' => 'required|string',
            'reservation_rooms.*.minors.*.last_name' => 'required|string',
            'reservation_rooms.*.minors.*.age' => 'required|integer|min:0|max:17'                
        ], [                                
            'event_id.required' => 'El evento es obligatorio.',
            'hotel_id.required' => 'El hotel es obligatorio.',                
            'plan_id.required' => 'El plan es obligatorio.',
            'fecha_entrada.required' => 'La fecha de entrada es obligatoria.',
            'fecha_salida.required' => 'La fecha de salida es obligatoria.',
            'cantidad_noches.required' => 'La cantidad de noches obligatoria.',
            'nombre_solicitante.required' => 'El nombre del solicitante es obligatorio.',
            'apellido_solicitante.required' => 'El apellido del solicitante es obligatorio.',
            'correo_solicitante.required' => 'El correo del solicitante es obligatorio.',
            'telefono_solicitante.required' => 'El telefono del solicitante es obligatorio.',
            'ciudad_solicitante.required' => 'La ciudad del solicitante es obligatoria.',
            'monto_total.required' => 'El monto total es obligatorio.',
            'monto_total.numeric' => 'El monto total debe ser numerico.',
            'monto_total.between' => 'El monto total debe estar ubicado dentro del rango 0 y 9,999,999.99.',
            'reservation_details.required' => 'La propiedad reservation_details es obligatoria.',
            'reservation_details.array' => 'La propiedad reservation_details debe ser un array.',
            'reservation_details.min' => 'La propiedad reservation_details debe contener al menos un elemento.',
            'reservation_details.*.concept.required' => 'Cada elemento en reservation_details debe tener un concepto.',
            'reservation_details.*.price.required' => 'Cada elemento en reservation_details debe tener un precio.',
            'reservation_details.*.price.numeric' => 'El precio debe ser numerico.',
            'reservation_details.*.price.between' => 'El precio debe estar ubicado dentro del rango 0 y 9,999,999.99.',
            'reservation_rooms.required' => 'La propiedad reservation_rooms es obligatoria.',
            'reservation_rooms.array' => 'La propiedad reservation_rooms debe ser un array.',
            'reservation_rooms.min' => 'La propiedad reservation_rooms debe contener al menos un elemento.',
            'reservation_rooms.*.room_id.required' => 'El ID de la habitación es obligatorio.',
            'reservation_rooms.*.room_id.numeric' => 'El ID de la habitación debe ser numérico.',
            'reservation_rooms.*.adults_quantity.required' => 'La cantidad de adultos es obligatoria.',
            'reservation_rooms.*.adults_quantity.integer' => 'La cantidad de adultos debe ser un número entero.',
            'reservation_rooms.*.adults_quantity.min' => 'La cantidad de adultos debe ser al menos 0.',
            'reservation_rooms.*.minor_quantity.required' => 'La cantidad de menores es obligatoria.',
            'reservation_rooms.*.minor_quantity.integer' => 'La cantidad de menores debe ser un número entero.',
            'reservation_rooms.*.minor_quantity.min' => 'La cantidad de menores debe ser al menos 0.',
            'reservation_rooms.*.adults.required' => 'El array de adultos es obligatorio.',
            'reservation_rooms.*.adults.array' => 'El array de adultos debe ser un array.',
            'reservation_rooms.*.adults.min' => 'El array de adultos debe contener al menos un elemento.',
            'reservation_rooms.*.adults.*.name.required' => 'El nombre del adulto es obligatorio.',
            'reservation_rooms.*.adults.*.last_name.required' => 'El apellido del adulto es obligatorio.',
            'reservation_rooms.*.minors.required' => 'El array de menores es obligatorio.',
            'reservation_rooms.*.minors.array' => 'El array de menores debe ser un array.',
            'reservation_rooms.*.minors.min' => 'El array de menores debe contener al menos un elemento.',
            'reservation_rooms.*.minors.*.name.required' => 'El nombre del menor es obligatorio.',
            'reservation_rooms.*.minors.*.last_name.required' => 'El apellido del menor es obligatorio.',
            'reservation_rooms.*.minors.*.age.required' => 'La edad del menor es obligatoria.',
            'reservation_rooms.*.minors.*.age.integer' => 'La edad del menor debe ser un número entero.',
            'reservation_rooms.*.minors.*.age.min' => 'La edad del menor debe ser al menos 0.',
            'reservation_rooms.*.minors.*.age.max' => 'La edad del menor no puede ser mayor a 17 años.'
        ]);
    }

    private function saveRoomDetails($details, $type, $reservationRoomsModel)
    {
        foreach ($details as $detail) {
            $reservationRoomsDetails = new ReservationRoomsDetails([
                'name' => $detail['name'],
                'last_name' => $detail['last_name'],
                'age' => $detail['age'] ?? null,
                'type' => $type,
                'estatus' => 1
            ]);

            $reservationRoomsModel->reservationRoomsDetails()->save($reservationRoomsDetails);
        }
    }

    public function listById($id)
    {
        try {
            $reservations = Reservations::where('user_id', $id)
            ->with(
                ['hotel','reservationDetails','reservationRooms.reservationRoomsDetails','plans','payments','reservePayments'])
            ->orderBy('id', 'desc')
            ->get();                        
        

            return response()->json([
                'result' => true,
                'data' => $reservations,
                'message' => 'Lista de evento obtenida con éxito.'
            ], 200);
            
        }catch(\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => 'Error al obtener lista' . $e->getMessage()
            ], 200);
        }
        
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoomsByHotels;

class RoomsByHotelsController extends Controller
{
    public function index(){        
        try {
            $data = RoomsByHotels::with('hotel')
            ->with('plan')
            ->where('estatus', 1)->orWhere('estatus', 0)->orderBy('id', 'DESC')->get();
            if ($data) {
                return response()->json([
                    'result' => true,
                    'data' => $data,
                    'message' => 'Lista de habitaciones por hoteles obtenidas con éxito.'
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
                'message' => 'La lista de habitaciones por hoteles no puede ser obtenida: ' . $e->getMessage()
                ], 200
            );
        }        
    }

    public function store(Request $request)
    {           
        try {
            $request->validate([
                'hotel_id' => 'required',
                'plan_id' => 'required',
                // 'nombre' => 'required|unique:events|string',
                // 'sede' => 'required|string',                
                // 'descripcion' => 'required|string',
                // 'politicas' => 'required|string',
                
            ], [                                
                'politicas.required' => 'Las politicas son obligatorias.',
                'plan_id.required' => 'El tipo de plan es obligatorio.'
                // 'nombre.unique' => 'El nombre ya está en uso.',
                // 'nombre.required' => 'El nombre es obligatorio.',
                // 'sede.required' => 'La sede es obligatoria.',                
                // 'descripcion.required' => 'La descripcion es obligatoria.',
            ]); 

            $input = $request->all();
            
            
            if (isset($input['estatus'])) {                
                $input['estatus'] = $input['estatus'] ? 1 : 0;
            }
    
            $roomsByHotel = new RoomsByHotels([
                'hotel_id' => $request->input('hotel_id'),
                'plan_id' => $request->input('plan_id'),                
                'vigencia' => $request->input('vigencia'),                                
                'tipo_habitacion' => $request->input('tipo_habitacion'),
                'precio_adulto' => $request->input('precio_adulto'),
                'sencilla' => $request->input('sencilla'),
                'doble' => $request->input('doble'),
                'triple' => $request->input('triple'),
                'cuadruple' => $request->input('cuadruple'),
                'infante_edad_minima' => $request->input('infante_edad_minima'),
                'infante_edad_maxima' => $request->input('infante_edad_maxima'),
                'infante_precio_menores' => $request->input('infante_precio_menores'),
                'edad_minima' => $request->input('edad_minima'),
                'edad_maxima' => $request->input('edad_maxima'),
                'precio_menores' => $request->input('precio_menores'),
                'aplica' => $request->input('aplica'),
                'junior_edad_minima' => $request->input('junior_edad_minima'),
                'junior_edad_maxima' => $request->input('junior_edad_maxima'),
                'junior_precio_menores' => $request->input('junior_precio_menores'),
                'habitaciones_disponibles' => 0, #$request->input('habitaciones_disponibles'),
                'cantidad_registrada' => $request->input('habitaciones_disponibles'),                
                'estatus' => $input['estatus'] ?? 0,          
            ]);
    
            // $roomsByHotel->hotel_id = $request->input('hotel_id');

            $roomsByHotel->save();       
            

            return response()->json([
                'result' => true,
                'message' => 'Habitaciones por hoteles creada con éxito'
                ], 200
            );

        } catch (\Exception $e) {
            return response()->json(                
                [
                    'result' => false,
                    'message' => 'Error al crear el habitaciones por hoteles: ' . $e->getMessage()
                ], 200
            );
        }
      
    }

    public function update(Request $request, $id){        
        try {            
            $input = $request->all();
            $request->validate([
                'hotel_id' => 'required',
                'plan_id' => 'required',                              
            ], [                                
                'politicas.required' => 'Las politicas son obligatorias.',
                'plan_id.required' => 'El tipo de plan es obligatorio.'                
            ]);                 

            // Asegúrate de que "estatus" existe en la solicitud
            if (isset($input['estatus'])) {
                // Convierte el valor a un entero (1 si es verdadero, 0 si es falso)
                $input['estatus'] = $input['estatus'] ? 1 : 0;
            }
            
            $roomsByHotel = RoomsByHotels::find($id);
            if (!$roomsByHotel) {
                return response()->json([
                    'result' => false,
                    'message' => 'Habitaciones por hoteles no encontrado.',
                ], 200);
            }      
            
                        
            //  // Verifica que la cantidad registrada no sea mayor que las habitaciones disponibles
            // if ($roomsByHotel->habitaciones_disponibles == 0 && $request->input('cantidad_registrada') < $roomsByHotel->cantidad_registrada) {
            //     return response()->json([
            //         'result' => false,
            //         'message' => 'No puedes disminuir la cantidad registrada cuando las habitaciones disponibles son 0.'
            //     ], 200);
            // }
            

            // // Incrementa las habitaciones disponibles solo si la nueva cantidad registrada es mayor
            // $incrementoHabitacionesDisponibles = max(0, $request->input('cantidad_registrada') - $roomsByHotel->cantidad_registrada);
            // $nuevaCantidadHabitacionesDisponibles = $roomsByHotel->habitaciones_disponibles + $incrementoHabitacionesDisponibles;

            // $input['habitaciones_disponibles'] = $nuevaCantidadHabitacionesDisponibles;
            // $input['cantidad_registrada'] = $request->input('cantidad_registrada');
    
            
            $roomsByHotel->update($input);                            


            


             // Calcula la diferencia entre la cantidad registrada nueva y la anterior
            // $diferenciaCantidadRegistrada = $request->input('cantidad_registrada') - $roomsByHotel->cantidad_registrada;

            // // Si la diferencia es negativa, incrementa las habitaciones disponibles
            // // Si la diferencia es positiva, decrementa las habitaciones disponibles
            // $nuevaCantidadHabitacionesDisponibles = $roomsByHotel->habitaciones_disponibles - $diferenciaCantidadRegistrada;

            // // Asegúrate de que la nueva cantidad de habitaciones disponibles no sea negativa
            // $nuevaCantidadHabitacionesDisponibles = max(0, $nuevaCantidadHabitacionesDisponibles);

            // $input['habitaciones_disponibles'] = $nuevaCantidadHabitacionesDisponibles;
            // $input['cantidad_registrada'] = $request->input('cantidad_registrada');

            // $roomsByHotel->update($input);


             // Obtén la cantidad de habitaciones registradas enviadas desde el frontend
            // $cantidadRegistrada = $request->input('cantidad_registrada');

            // // Calcula la nueva cantidad de habitaciones disponibles
            // if ($cantidadRegistrada > $roomsByHotel->habitaciones_disponibles) {
            //     // Si la cantidad registrada es mayor que las disponibles, actualiza las disponibles a la registrada
            //     $nuevaCantidadHabitacionesDisponibles = $cantidadRegistrada;
            // } else {
            //     // Si la cantidad registrada es menor, resta la cantidad registrada a las disponibles
            //     $nuevaCantidadHabitacionesDisponibles = $roomsByHotel->habitaciones_disponibles - $cantidadRegistrada;
            // }

            // // Asegúrate de que la nueva cantidad de habitaciones disponibles no sea negativa
            // $nuevaCantidadHabitacionesDisponibles = max(0, $nuevaCantidadHabitacionesDisponibles);

            // // Actualiza la cantidad de habitaciones disponibles y la cantidad registrada
            // $roomsByHotel->habitaciones_disponibles = $nuevaCantidadHabitacionesDisponibles;
            // $roomsByHotel->cantidad_registrada = $cantidadRegistrada;

            // // Guarda los cambios en la base de datos
            // $roomsByHotel->save();   


            
        
            return response()->json([
                'result' => true,
                'message' => 'Habitaciones por hoteles editado con éxito'
                ], 200
            );


        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => 'Error al editar el habitaciones por hoteles: ' . $e->getMessage()
                ], 200
            );
        }

    }



    public function delete($id){                 
        
        $roomsByHotels = RoomsByHotels::find($id);                        
        $roomsByHotels->estatus = 2; 
        $roomsByHotels->save();

        return response()->json([
            'result' => true,
            'message' => 'Habitación por hotel eliminado con éxito'
            ], 200
        );

    }

    public static function getRoomTypeNameByRoomId($roomId)
    {
        return RoomsByHotels::where('id', $roomId)->value('tipo_habitacion');
    }


}
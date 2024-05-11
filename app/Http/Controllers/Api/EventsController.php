<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Events;
use App\Models\AvailableCategories;
use App\Models\AcademicGrades;
use App\Models\Hotels;
use App\Models\RoomsByHotels;
use App\Models\PlanTypes;

class EventsController extends Controller
{


    public function index()
    {
        try {
            $data = Events::with('hotel')
                ->with('availableCategories')
                ->with('grados')
                ->where('estatus', 1)
                ->orWhere('estatus', 0)
                ->orWhere('estatus', 2)
                ->orWhere('estatus', 3)
                ->orderBy('id', 'DESC')
                ->get();

            if ($data) {
                return response()->json([
                    'result' => true,
                    'data' => $data,
                    'message' => 'Lista de eventos obtenidas con éxito.'
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
                'message' => 'La lista de eventos no puede ser obtenida: ' . $e->getMessage()
            ], 200);
        }
    } 

    public function store(Request $request)
    {   
        
        try {
            $request->validate([
                'nombre' => 'required|unique:events|string',
                'sede' => 'required|string',                
                'descripcion' => 'required|string',
                'politicas' => 'required|string',
                // 'hotel_id' => 'required|exists:hotels,id',
                'beneficiario' => 'required',
                'banco' => 'required',
                'numero_cuenta' => 'required',
                'clabe_interbancaria' => 'required'
                
            ], [                                
                'nombre.unique' => 'El nombre ya está en uso.',
                'nombre.required' => 'El nombre es obligatorio.',
                'sede.required' => 'La sede es obligatoria.',                
                'descripcion.required' => 'La descripcion es obligatoria.',
                'politicas.required' => 'Las politicas son obligatorias.',
                'beneficiario.required' => 'El beneficiario es obligatorio',
                'banco.required' => 'El banco es obligatorio',
                'numero_cuenta' => 'El numero de cuenta es obligatorio',
                'clabe_interbancaria' => 'La CLABE interbancaria es obligoria'
            ]); 

            $input = $request->all();
            
            
            if (isset($input['estatus'])) {                
                $input['estatus'] = $input['estatus'] ? 1 : 0;
            }
    
            $events = new Events([
                'nombre' => $request->input('nombre'),
                'sede' => $request->input('sede'),
                'fecha_inicio' => $request->input('fecha_inicio'),
                'fecha_termino' => $request->input('fecha_termino'),
                'descripcion' => $request->input('descripcion'),
                'politicas' => $request->input('politicas'),
                'hotel_id' => $request->input('hotel_id'),
                'estatus' => $input['estatus'] ?? 0,
                'beneficiario' => $request->input('beneficiario'),
                'banco' => $request->input('banco'),
                'numero_cuenta' => $request->input('numero_cuenta'),
                'clabe_interbancaria' => $request->input('clabe_interbancaria')          
            ]);
    
            $events->hotel_id = $request->input('hotel_id');

            $events->save();


            

            foreach ($request->input('categorias') as $categoria) {
                $categoriaModel = new AvailableCategories([                    
                    'costo' => $categoria['costo'],
                    'estatus' => 1,
                ]);
            
                // Asigna directamente el ID de la categoría al modelo, para asegurar que category_id esté presente.
                $categoriaModel->category_id = $categoria['category_id'];

                $events->availableCategories()->save($categoriaModel);
            }


            foreach ($request->input('grados') as $grado) {                
                $gradoModel = new AcademicGrades([
                    'descripcion' => $grado['grado_academico'],
                    'estatus' => 1,
                    'events_id' => $events->id, // Asigna el ID del evento
                ]);                            

                $events->grados()->save($gradoModel);
            }
                     
            

            return response()->json([
                'result' => true,
                'message' => 'Evento creado con éxito'
                ], 200
            );

        } catch (\Exception $e) {
            return response()->json(                
                [
                    'result' => false,
                    'message' => 'Error al crear el evento: ' . $e->getMessage()
                ], 200
            );
        }
      
    }

    public function update(Request $request, $id){        
        try {            
            $input = $request->all();
            $request->validate([
                'nombre' => 'required|string|unique:events,nombre,'. $id,              
                'sede' => 'required|string',                
                'descripcion' => 'required|string',
                'politicas' => 'required|string',
                // 'hotel_id' => 'required|exists:hotels,id',
                'beneficiario' => 'required',
                'banco' => 'required',
                'numero_cuenta' => 'required',
                'clabe_interbancaria' => 'required'
            ], [                                
                'nombre.unique' => 'El nombre ya está en uso.',
                'nombre.required' => 'El nombre es obligatorio.',
                'sede.required' => 'La sede es obligatoria.',                
                'descripcion.required' => 'La descripcion es obligatoria.',
                'politicas.required' => 'Las politicas son obligatorias.',
                'beneficiario.required' => 'El beneficiario es obligatorio',
                'banco.required' => 'El banco es obligatorio',
                'numero_cuenta' => 'El numero de cuenta es obligatorio',
                'clabe_interbancaria' => 'La CLABE interbancaria es obligoria'
            ]);         

            // Asegúrate de que "estatus" existe en la solicitud
            if (isset($input['estatus'])) {
                // Convierte el valor a un entero (1 si es verdadero, 0 si es falso)
                $input['estatus'] = $input['estatus'] ? 1 : 0;
            }
            
            $events = Events::find($id);
            if (!$events) {
                return response()->json([
                    'result' => false,
                    'message' => 'Evento no encontrado.',
                ], 200);
            }                
            
            $events->update($input);
                
            $events->availableCategories()->delete();            
            foreach ($request->input('categorias') as $categoria) {
                $category_id = data_get($categoria, 'category_id');
                $costo = data_get($categoria, 'costo');
                $categoriaModel = new availableCategories([
                    'category_id' => $category_id,
                    'costo' => $costo,
                    'estatus' => 1,
                ]);

                $events->availableCategories()->save($categoriaModel);
            }            


            $events->grados()->delete();            
            foreach ($request->input('grados') as $grado) {
                $descripcion = data_get($grado, 'grado_academico');        
                $gradoModel = new AcademicGrades([
                    'descripcion' => $descripcion,                    
                    'estatus' => 1,
                ]);

                $events->grados()->save($gradoModel);
            }
            
        
            return response()->json([
                'result' => true,
                'message' => 'Evento editado con éxito'
                ], 200
            );
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => 'Error al editar el evento: ' . $e->getMessage()
                ], 200
            );
        }

    }

    public function delete($id){ 
        try {            
            $event = Events::find($id);
                
            if (!$event) {
                return response()->json([
                    'result' => false,
                    'message' => 'Evento no encontrado'
                ], 200);
            }
                
            $event->estatus = 2; 
            $event->save();
                
            $categories = $event->availableCategories;
                
            foreach ($categories as $category) {
                $category->estatus = 2;
                $category->save();
            }
    
            return response()->json([
                'result' => true,
                'message' => 'Evento y categorías eliminados con éxito'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => 'Error al eliminar el evento: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getEvents(){
        try {
            $data = Events::where('estatus', 1)                
                ->with('availableCategories')
                ->orderBy('id', 'DESC')
                ->get();

            if ($data) {
                return response()->json([
                    'result' => true,
                    'data' => $data,
                    'message' => 'Lista de eventos obtenidas con éxito.'
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
                'message' => 'La lista de eventos no puede ser obtenida: ' . $e->getMessage()
            ], 200);
        }
    }

    public function getEvent(Request $request){     
        $id = $request->input('id');
        $id_hotel = $request->input('id_hotel');

        try {

            $event = Events::where('id', $id)
            ->with('availableCategories')
            ->get();                        

            $hotel = Hotels::where('id', $id_hotel)            
            ->get();     
            
            $habitaciones_hotel = RoomsByHotels::where('hotel_id', $id_hotel)            
            ->get();
            

            $planIds = [];

            foreach ($habitaciones_hotel as $key => $habitacion_hotel) {                
                $planIds[] = $habitacion_hotel['plan_id'];
            }
            
            
            $tiposDePlan = PlanTypes::whereIn('id', $planIds)
            ->get();

            // dd($tiposDePlan);
            

            if ($event && $hotel) {
                return response()->json([
                    'result' => true,
                    'event' => $event,
                    'hotel' => $hotel,
                    'tiposDePlan' => $tiposDePlan,
                    'habitaciones_hotel' => $habitaciones_hotel,
                    'message' => 'Lista de evento obtenida con éxito.'
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
                'message' => 'La lista de evento no puede ser obtenida: ' . $e->getMessage()
            ], 200);
        }
    }

    public function getByCategory(Request $request)
    {
        $categoryId = $request->input('categoryId');

        // Obtén los eventos asociados a la categoría
        $events = Event::whereHas('categories', function ($query) use ($categoryId) {
            $query->where('category_id', $categoryId);
        })->get();

        return response()->json([
            'result' => true,
            'data' => $events,
            'message' => 'Eventos asociados a la categoría obtenidos con éxito.'
        ], 200);
    }    

    public function getEventV2(){                                        
        try {

            //  CODIGO PARA NO MOSTRAR LAS HABITACIONES POR HOTELES QUE NO TENGA VIGENCIA/DISPONIBILIDAD
            /*$event = Events::with([
                'hotel.roomsByHotels' => function ($query) {
                    $query->where('estatus', 1)
                        ->where(function ($query) {
                            $query->where('habitaciones_disponibles', '>', 0)
                                ->orWhereNull('habitaciones_disponibles');
                        })
                        ->whereDate('vigencia', '>=', now());
                },                               
                'hotel.roomsByHotels.plan',
                'availableCategories.category',
                'hotel.servicios'
            ])
            ->where('estatus', 1)
            ->get();*/
            //  CODIGO PARA NO MOSTRAR LAS HABITACIONES POR HOTELES QUE NO TENGA VIGENCIA/DISPONIBILIDAD


            $event = Events::with([
                'hotel.roomsByHotels',                    
                'hotel.roomsByHotels.plan', 
                'availableCategories.category', 
                'hotel.servicios'])
            ->where('estatus', 1)                        
            ->get();                        
            
            return response()->json([
                'result' => true,
                'data' => $event,
                'message' => 'Lista de evento obtenida con éxito.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => 'La lista de evento no puede ser obtenida: ' . $e->getMessage()
            ], 200);
        }
    }


    public function getEventV3(){                                        
        try {           
            $event = Events::with([
                'hotel.roomsByHotels',
                'hotel.roomsByHotels.plan', 
                'availableCategories.category', 
                'hotel.servicios'])
            // ->where('estatus', 1)                        
            ->get();                        
            
            return response()->json([
                'result' => true,
                'data' => $event,
                'message' => 'Lista de evento obtenida con éxito.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => 'La lista de evento no puede ser obtenida: ' . $e->getMessage()
            ], 200);
        }
    }


    public function getEventsWithCategories(){
        try {
            $data = Events::where('estatus', 1)
                ->with('grados')
                ->with(['availableCategories' => function($query) {
                    $query->whereHas('category', function($query) {
                        $query->where('estatus', 1);
                    })
                    ->with('category');
                }])
                ->orderBy('id', 'DESC')
                ->get();

            if ($data) {
                return response()->json([
                    'result' => true,
                    'data' => $data,
                    'message' => 'Lista de eventos obtenidas con éxito.'
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
                'message' => 'La lista de eventos no puede ser obtenida: ' . $e->getMessage()
            ], 200);
        }
    }
    
}
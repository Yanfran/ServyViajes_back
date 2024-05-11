<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Discounts;
use Illuminate\Support\Carbon;

class DiscountsController extends Controller
{

    public function index(){        
        try {
            $data = Discounts::where('estatus', 1)->orWhere('estatus', 0)->orderBy('id', 'DESC')->get();
            if ($data) {
                return response()->json([
                    'result' => true,
                    'data' => $data,
                    'message' => 'Lista de descuentos obtenidas con éxito.'
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
                'message' => 'La lista de descuentos no puede ser obtenida: ' . $e->getMessage()
                ], 200
            );
        }        
    }

    public function store(Request $request)
    {   
        try {
            $request->validate([
                'nombre' => 'required|unique:hotels|string',
                'porcentaje' => 'required',
                'vigencia' => 'required|string',
                'codigo_descuento' => 'required|string', 
                'cantidad' => 'required',                
            ], [                                
                'nombre.unique' => 'El nombre ya está en uso.',
                'nombre.required' => 'El nombre es obligatorio.',
                'porcentaje.required' => 'El porcentaje es obligatorio.',                
                'vigencia.required' => 'La fecha es obligatoria.',
                'codigo_descuento.required' => 'El codigo descuento es obligatorio.',
                'cantidad.required' => 'La cantidad es obligatoria.'
            ]); 

            $input = $request->all();

            // Asegúrate de que "estatus" existe en la solicitud
            if (isset($input['estatus'])) {
                // Convierte el valor a un entero (1 si es verdadero, 0 si es falso)
                $input['estatus'] = $input['estatus'] ? 1 : 0;
            }
    
            $discounts = new Discounts([
                'nombre' => $request->input('nombre'),
                'porcentaje' => $request->input('porcentaje'),
                'vigencia' => $request->input('vigencia'),
                'codigo_descuento' => $request->input('codigo_descuento'),                
                'cantidad' => $request->input('cantidad'),                
                'cantidad_disponible' => $request->input('cantidad'),                
                'estatus' => $input['estatus'] ?? 0,                
            ]);
    
            $discounts->save();
          
            return response()->json([
                'result' => true,
                'message' => 'Descuento creado con éxito'
                ], 200
            );

        } catch (\Exception $e) {
            return response()->json(                
                [
                    'result' => false,
                    'message' => 'Error al crear el descuento: ' . $e->getMessage()
                ], 200
            );
        }
      
    }

    public function update(Request $request, $id){
        
        try {
            $input = $request->all();
            $request->validate([
                'nombre' => 'required|string|unique:discounts,nombre,' . $id,                            
                'porcentaje' => 'required',
                'vigencia' => 'required|string',
                'codigo_descuento' => 'required|string', 
                'cantidad' => 'required',                
            ], [                                
                'nombre.unique' => 'El nombre ya está en uso.',
                'nombre.required' => 'El nombre es obligatorio.',
                'porcentaje.required' => 'El porcentaje es obligatorio.',                
                'vigencia.required' => 'La fecha es obligatoria.',
                'codigo_descuento.required' => 'El codigo descuento es obligatorio.',
                'cantidad.required' => 'La cantidad es obligatoria.'
            ]);         
    
            // Asegúrate de que "estatus" existe en la solicitud
            if (isset($input['estatus'])) {
                // Convierte el valor a un entero (1 si es verdadero, 0 si es falso)
                $input['estatus'] = $input['estatus'] ? 1 : 0;
            }
            
            $discount = Discounts::find($id);
            
            if (!$discount) {
                return response()->json([
                    'result' => false,
                    'message' => 'Descuento no encontrado.',
                ], 200);
            }        
            
            $discount->update($input);
    
            return response()->json([
                'result' => true,
                'message' => 'Descuento editado con éxito'
                ], 200
            );
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => 'Error al editar el descuento: ' . $e->getMessage()
                ], 200
            );
        }
                       
    }


    public function delete($id){                 
        
        $discounts = Discounts::find($id);                        
        $discounts->estatus = 2; 
        $discounts->save();

        return response()->json([
            'result' => true,
            'message' => 'Descuento eliminado con éxito'
            ], 200
        );

    }


    // Ajusta tu método porcentaje en el controlador
    public function porcentaje(Request $request){        
        try {                                            
            //asignamos el codigo de beca a una variable
            $codigo_beca = $request->input('codigo_beca');
            
            //buscamos si existe el codigo de beca
            $discount = Discounts::where('codigo_descuento', $codigo_beca)
                ->where('estatus', 1)
                ->first();
            
            //en caso de no existir regresamos una respuesta
            if (!isset($discount)) {
                return response()->json([
                    'result' => false,
                    'message' => 'Descuento no encontrado'
                ], 200);
            }

            //convertimos la fecha un objeto de tipo fecha
            $vigencia = Carbon::parse($discount->vigencia);

            //verificamos la vigencia
            if ($vigencia->isPast()) {
                return response()->json([
                    'result' => false,
                    'message' => 'El descuento ha expirado'
                ], 200);
            }

            //validamos si existe una cantidad disponible
            $cantidadDisponible = $discount->cantidad_disponible ? $discount->cantidad_disponible : 0;

            if($cantidadDisponible <= 0) {
                return response()->json([
                    'result' => false,
                    'message' => 'El límite de usos ha sido alcanzado'
                ], 200);
            }

            return response()->json([
                'result' => true,
                'data' => $discount,
                'message' => 'Descuento aplicado con éxito'
            ], 200);

        }  catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => 'Error al obtener descuento: ' . $e->getMessage()
            ], 200);
        }
    }

    public function getDiscount(Request $request) {        
        try {                                            
            //asignamos el codigo de beca a una variable
            $codigo_beca = $request->input('codigo_beca');
            
            //buscamos si existe el codigo de beca
            $discount = Discounts::where('codigo_descuento', $codigo_beca)
                ->where('estatus', 1)
                ->first();
            
            //en caso de no existir regresamos una respuesta
            if (!isset($discount)) {
                return response()->json([
                    'result' => false,
                    'message' => 'Descuento no encontrado'
                ], 200);
            }

            //convertimos la fecha un objeto de tipo fecha
            $vigencia = Carbon::parse($discount->vigencia);

            //verificamos la vigencia
            if ($vigencia->isPast()) {
                return response()->json([
                    'result' => false,
                    'message' => 'El descuento ha expirado'
                ], 200);
            }

            //validamos si existe una cantidad disponible
            $cantidadDisponible = $discount->cantidad_disponible ? $discount->cantidad_disponible : 0;

            if($cantidadDisponible <= 0) {
                return response()->json([
                    'result' => false,
                    'message' => 'El límite de usos ha sido alcanzado'
                ], 200);
            }

            return response()->json([
                'result' => true,
                'data' => $discount,
                'message' => 'Descuento aplicado con éxito'
            ], 200);

        }  catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => 'Error al obtener descuento: ' . $e->getMessage()
            ], 200);
        }
    }

}

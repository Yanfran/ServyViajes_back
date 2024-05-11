<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotels;
use App\Models\Galleries;
use App\Models\ServicesOfHotels;


class HotelsController extends Controller
{

    public function index()
    {
        try {
            $data = Hotels::with('servicios')
                ->with('galleries') // Cargar la relación de servicios
                ->where('estatus', 1)
                ->orWhere('estatus', 0)
                ->orderBy('id', 'DESC')
                ->get();

            if ($data) {
                return response()->json([
                    'result' => true,
                    'data' => $data,
                    'message' => 'Lista de hoteles obtenidas con éxito.'
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
                'message' => 'La lista de hoteles no puede ser obtenida: ' . $e->getMessage()
            ], 200);
        }
    } 

    public function store(Request $request)
    {   
        try {
            $request->validate([
                'nombre' => 'required|unique:hotels|string',
                'direccion' => 'required|string',
                'descripcion' => 'required|string',
                'politicas' => 'required|string',
                'beneficiario' => 'required',
                'banco' => 'required',
                'numero_cuenta' => 'required',
                'clabe_interbancaria' => 'required'                
            ], [                                
                'nombre.unique' => 'El nombre ya está en uso.',
                'nombre.required' => 'El nombre es obligatorio.',
                'direccion.required' => 'La direccion es obligatoria.',                
                'descripcion.required' => 'La descripcion es obligatoria.',
                'politicas.required' => 'Las politicas son obligatorias.',
                'beneficiario.required' => 'El beneficiario es requerido',
                'banco.require' => 'El banco es requerido',
                'numero_cuenta.required' => 'El numero de cuenta es requerido',
                'clabe_interbancaria.required' => 'La CLABE interbancaria es requerida'
            ]); 

            $input = $request->all();

            // Asegúrate de que "estatus" existe en la solicitud
            if (isset($input['estatus'])) {
                // Convierte el valor a un entero (1 si es verdadero, 0 si es falso)
                $input['estatus'] = $input['estatus'] ? 1 : 0;
            }
    
            $hotels = new Hotels([
                'nombre' => $request->input('nombre'),
                'direccion' => $request->input('direccion'),
                'descripcion' => $request->input('descripcion'),
                'politicas' => $request->input('politicas'),                
                'check_in' => $request->input('check_in'),                
                'check_out' => $request->input('check_out'),                
                'estatus' => $input['estatus'] ?? 0,
                'beneficiario' => $request->input('beneficiario'),
                'banco' => $request->input('banco'),
                'numero_cuenta' => $request->input('numero_cuenta'),
                'clabe_interbancaria' => $request->input('clabe_interbancaria'),
            ]);
    
            $hotels->save();

            // Asignar los servicios al hotel recién creado
            foreach ($request->input('servicios') as $servicio) {
                $servicioModel = new ServicesOfHotels([
                    'descripcion' => $servicio['servicio'],
                    'estatus' => 1, 
                ]);
            
                $hotels->servicios()->save($servicioModel);
            }

            foreach ($request->input('imagenes') as $index => $gallery) {
                // Eliminar el prefijo "data:image/png;base64,"
                $base64Data = substr($gallery, strpos($gallery, ',') + 1);
            
                // Obtener la extensión desde la cadena Base64
                $extension = 'png';
            
                // Generar un nombre único para la imagen con la extensión correcta
                $nombreUnico = substr(md5(time() . $index), 0, 10) . '.' . $extension;
            
                // Ruta donde se guardará la imagen
                $rutaImagen = public_path('assets/images/') . $nombreUnico;
            
                // Verificar si el archivo ya existe y generar un nombre único si es necesario
                while (file_exists($rutaImagen)) {
                    $nombreUnico = substr(md5(time() . $index . rand()), 0, 10) . '.' . $extension;
                    $rutaImagen = public_path('assets/images/') . $nombreUnico;
                }
            
                // Decodificar la imagen en base64 y guardarla
                $imagenDecodificada = base64_decode($base64Data);
                file_put_contents($rutaImagen, $imagenDecodificada);
            
                // Crear un modelo y guardar en la base de datos
                $galleryModel = new Galleries([
                    'ruta' => $nombreUnico,
                    'estatus' => 1,
                ]);
            
                $hotels->galleries()->save($galleryModel);
            }
            

            return response()->json([
                'result' => true,
                'message' => 'Hotel creado con éxito'
                ], 200
            );

        } catch (\Exception $e) {
            return response()->json(                
                [
                    'result' => false,
                    'message' => 'Error al crear el hotel: ' . $e->getMessage()
                ], 200
            );
        }
      
    }

    public function edit($id){  
        
        try {
            $data = Hotels::where('id', $id)->first();
            if ($data) {
                return response()->json([
                    'result' => true,
                    'data' => $data,
                    'message' => 'Hotel obtenido exitosamente.'
                    ], 200
                );
            } else {
                return response()->json([
                    'result' => false,
                    'message' => 'El hotel no existe.'
                    ], 200
                );
            }                       
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => 'El hotel no puede ser obtenido: ' . $e->getMessage()
                ], 200
            );
        }                    
    }

    public function update(Request $request, $id){

        try {
            $input = $request->all();
            $request->validate([
                'nombre' => 'required|string|unique:hotels,nombre,'. $id,                
                'direccion' => 'required|string',
                'descripcion' => 'required|string',
                'politicas' => 'required|string',
                'beneficiario' => 'required',
                'banco' => 'required',
                'numero_cuenta' => 'required',
                'clabe_interbancaria' => 'required'
            ], [                                
                'nombre.unique' => 'El nombre ya está en uso.',
                'nombre.required' => 'El nombre es obligatorio.',
                'direccion.required' => 'La direccion es obligatoria.',                
                'descripcion.required' => 'La descripcion es obligatoria.',
                'politicas.required' => 'Las politicas son obligatorias.',
                'beneficiario.required' => 'El beneficiario es requerido',
                'banco.require' => 'El banco es requerido',
                'numero_cuenta.required' => 'El numero de cuenta es requerido',
                'clabe_interbancaria.required' => 'La CLABE interbancaria es requerida'
            ]); 
    
            // Asegúrate de que "estatus" existe en la solicitud
            if (isset($input['estatus'])) {
                // Convierte el valor a un entero (1 si es verdadero, 0 si es falso)
                $input['estatus'] = $input['estatus'] ? 1 : 0;
            }
            
            $hotels = Hotels::find($id);
            if (!$hotels) {
                return response()->json([
                    'result' => false,
                    'message' => 'Hotel no encontrado.',
                ], 200);
            }                
            
            $hotels->update($input);
            
            // Eliminar todos los servicios existentes asociados con el hotel
            $hotels->servicios()->delete();
    
            // Asignar los servicios actualizados al hotel
            foreach ($request->input('servicios') as $servicio) {
                $servicioModel = new ServicesOfHotels([
                    'descripcion' => $servicio['servicio'],
                    'estatus' => 1,
                ]);
    
                $hotels->servicios()->save($servicioModel);
            }
          
            return response()->json([
                'result' => true,
                'message' => 'Hotel editado con éxito'
                ], 200
            );
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => 'Error al editar el hotel: ' . $e->getMessage()
                ], 200
            );
        }       
    }

    public function delete($id){ 
        $hotels = Hotels::find($id);                        
        $hotels->estatus = 2; 
        $hotels->save();
        return response()->json([
            'result' => true,
            'message' => 'Hotel eliminado con éxito'
            ], 200
        );
    }

    public function addImagen(Request $request, $id){

        // $request->validate([
        //     'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Ajusta las reglas de validación según tus necesidades
        // ]);
    
        $hotel = Hotels::find($id);
    
        if (!$hotel) {
            return response()->json(['message' => 'Hotel no encontrado'], 200);
        }

        foreach ($request->input('imagenes') as $index => $gallery) {
            // Eliminar el prefijo "data:image/png;base64,"
            $base64Data = substr($gallery, strpos($gallery, ',') + 1);
        
            // Obtener la extensión desde la cadena Base64
            $extension = 'png';
        
            // Generar un nombre único para la imagen con la extensión correcta
            $nombreUnico = substr(md5(time() . $index), 0, 10) . '.' . $extension;
        
            // Ruta donde se guardará la imagen
            $rutaImagen = public_path('assets/images/') . $nombreUnico;
        
            // Verificar si el archivo ya existe y generar un nombre único si es necesario
            while (file_exists($rutaImagen)) {
                $nombreUnico = substr(md5(time() . $index . rand()), 0, 10) . '.' . $extension;
                $rutaImagen = public_path('assets/images/') . $nombreUnico;
            }
        
            // Decodificar la imagen en base64 y guardarla
            $imagenDecodificada = base64_decode($base64Data);
            file_put_contents($rutaImagen, $imagenDecodificada);
        
            // Crear un modelo y guardar en la base de datos
            $galleryModel = new Galleries([
                'ruta' => $nombreUnico,
                'estatus' => 1,
            ]);
        
            $hotel->galleries()->save($galleryModel);
        }
        
        return response()->json([
            'result' => true,
            'message' => 'Imagen agregada con éxito'
            ], 200
        );               

    }

    public function deleteImagen($idHotel, $idImagen)
    {
        $hotel = Hotels::find($idHotel);

        if (!$hotel) {
            return response()->json(['message' => 'Hotel no encontrado'], 200);
        }

        $imagen = Galleries::find($idImagen);

        if (!$imagen) {
            return response()->json(['message' => 'Imagen no encontrada'], 200);
        }

        // Eliminar la imagen del almacenamiento
        // $rutaImagen = public_path('assets/images/') . $imagen->ruta;

        // if (File::exists($rutaImagen)) {
        //     File::delete($rutaImagen);
        // }

        // Eliminar la entrada de la imagen de la base de datos
        $imagen->delete();

        return response()->json([
            'result' => true,
            'message' => 'Imagen eliminada con éxito'
            ], 200
        );        
    }

    public function getHotels(){
        try {
            $data = Hotels::where('estatus', 1)                                
                ->orderBy('id', 'DESC')
                ->get();

            if ($data) {
                return response()->json([
                    'result' => true,
                    'data' => $data,
                    'message' => 'Lista de hoteles obtenidas con éxito.'
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
                'message' => 'La lista de hoteles no puede ser obtenida: ' . $e->getMessage()
            ], 200);
        }
    }

    
}

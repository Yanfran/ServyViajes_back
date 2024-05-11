<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use Illuminate\Http\JsonResponse;

class CategoriesController extends Controller
{    

    public function index(){        
        try {
            $data = Categories::where('estatus', 1)->orWhere('estatus', 0)->orderBy('id', 'DESC')->get();
            if ($data) {
                return response()->json([
                    'result' => true,
                    'data' => $data,
                    'message' => 'Lista de categorias obtenidas con éxito.'
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
                'message' => 'La lista de categoría no puede ser obtenida: ' . $e->getMessage()
                ], 200
            );
        }        
    }

    public function store(Request $request)
    {   
        
        try {
            
            $request->validate([
                'descripcion' => 'required|unique:categories|string',                              
            ], [                                
                'descripcion.unique' => 'La descripcion ya está en uso.',
                'descripcion.required' => 'La descripcion es obligatoria.',                
            ]); 

            $input = $request->all();

            // Asegúrate de que "estatus" existe en la solicitud
            if (isset($input['estatus'])) {
                // Convierte el valor a un entero (1 si es verdadero, 0 si es falso)
                $input['estatus'] = $input['estatus'] ? 1 : 0;
            }
    
            $Categories = new Categories([
                'descripcion' => $request->input('descripcion'),
                'estatus' => $input['estatus'] ?? 0, // Usa 0 como valor predeterminado si "estatus" no está presente         
            ]);
    
            $Categories->save();
    
            return response()->json([
                'result' => true,
                'message' => 'Categoria creada con éxito'
                ], 200
            );

        } catch (\Exception $e) {
            return response()->json(                
                [
                    'result' => false,
                    'message' => 'Error al crear la categoria: ' . $e->getMessage()
                ], 200
            );
        }
      
    }

    public function edit($id){  
        
        try {
            $data = Categories::where('id', $id)->first();
            if ($data) {
                return response()->json([
                    'result' => true,
                    'data' => $data,
                    'message' => 'Categoría obtenida exitosamente.'
                    ], 200
                );
            } else {
                return response()->json([
                    'result' => false,
                    'message' => 'La categoría no existe.'
                    ], 200
                );
            }                       
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => 'La categoría no puede ser obtenida: ' . $e->getMessage()
                ], 200
            );
        }                    
    }


    public function update(Request $request){
        
            
            try {                
                $input = $request->all();
                $request->validate([
                    'descripcion' => 'required|string|unique:categories,descripcion,' . $input['id'],                
                ], [                                
                    'descripcion.unique' => 'La descripcion ya está en uso.',
                    'descripcion.required' => 'La descripcion es obligatoria.',                
                ]); 

                // Asegúrate de que "estatus" existe en la solicitud
                if (isset($input['estatus'])) {
                    // Convierte el valor a un entero (1 si es verdadero, 0 si es falso)
                    $input['estatus'] = $input['estatus'] ? 1 : 0;
                }
                
                $category = Categories::find($input['id']);
                
                if (!$category) {
                    return response()->json([
                        'result' => false,
                        'message' => 'Categoría no encontrada.',
                    ], 200);
                }
        
                // $category->descripcion = $input['descripcion'];
                // $category->estatus = $input['estatus'] ?? 0; // Usa 0 como valor predeterminado si "estatus" no está presente
                // $category->save();
                
                $category->update($input);
        
                return response()->json([
                    'result' => true,
                    'message' => 'Categoria editada con éxito'
                    ], 200
                );
            } catch (\Exception $e) {
                return response()->json([
                    'result' => false,
                    'message' => 'Error al editar una categoria: ' . $e->getMessage()
                    ], 200
                );
            }       

        
    }


    public function delete(Request $request){ 
        
        $input = $request->all();
        
        $category = Categories::find($input['id']);                        
        $category->estatus = 2; 
        $category->save();

        return response()->json([
            'result' => true,
            'message' => 'Categoria eliminada con éxito'
            ], 200
        );
    
    }


    public function getCategories(){
        try {
            $data = Categories::where('estatus', 1) 
                // ->with(['category_availble' => function ($query) {
                //     $query->with('event');
                // }])               
                ->orderBy('id', 'DESC')
                ->get();

            if ($data) {
                return response()->json([
                    'result' => true,
                    'data' => $data,
                    'message' => 'Lista de categorias obtenida con éxito.'
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
                'message' => 'La lista de categorias no puede ser obtenida: ' . $e->getMessage()
            ], 200);
        }
    }
}

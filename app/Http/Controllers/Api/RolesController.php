<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Roles;
use App\Http\Controllers\Controller;


class RolesController extends Controller
{
    public function store(Request $request)
    {   
        
        try {
            
            $request->validate([
                'descripcion' => 'required|unique:roles|string',
                'estatus' => 'required',                
            ]);
    
            $roles = new Roles([
                'descripcion' => $request->input('descripcion'),
                'estatus' => $request->input('estatus'),                
            ]);
    
            $roles->save();
    
            return response()->json(['message' => 'Rol creado con éxito'], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al crear el rol: ' . $e->getMessage()], 200);
        }
      
    }
}

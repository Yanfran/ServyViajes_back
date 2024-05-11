<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function store(Request $request)
    {           
        
        try {
            
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'password' => 'required|string'                
            ]);


            $rol = '2';
            $estatus = '1';
            
            $user = new User([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'id_rol' => $rol,
                'estatus' => $estatus,
            ]);            
    
            $user->save();
    
            return response()->json([
                'result' => true,
                'message' => 'Usuario creado con éxito'
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => 'Error al crear el usuario: ' . $e->getMessage()
            ], 200);
        }
      
    }
}

<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function store(Request $request)
    {           
        
        try {
            
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'password' => 'required|string',
                'id_rol' => 'required|exists:roles,id',
                'estatus' => 'required',
            ]);
    
            
            $user = new User([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'id_rol' => $request->input('id_rol'),
                'estatus' => $request->input('estatus'),
            ]);            
    
            $user->save();
    
            return response()->json(['message' => 'Usuario creado con éxito'], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al crear el usuario: ' . $e->getMessage()], 200);
        }
      
    }

    public function getUserById($id) {

        try {
            $data = User::where('id', $id)->first();

            if (isset($user)) {
                return response()->json([
                    'result' => false,
                    'message' => 'Usuario no encontrado, vuelva a iniciar sesión e intente de nuevo'
                ]);
            }

            return response()->json([
                'result' => true,
                'data' => $data,
                'message' => 'Usuario obtenido con éxito'
            ]);

        }catch(\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => 'Error al obtener usuario: ' . $e->getMessage()
            ]);
        }
        
    }

    public function updateAdmin(Request $request) 
    {
        try {
            $request->validate(
                [
                    'id' => 'required',
                    'name' => 'required',
                    'telefono_movil' => 'required'
                ],
                [
                    'id.required' => 'Usuario no encontrado, vuelva a iniciar sesión e intente de nuevo',
                    'name.required' => 'El nombre es requerido',
                    'telefono_movil.required' => 'El telefono movil es requerido'
                ]
            );

            $user = User::where('id', $request->id)->first();

            //creamos un array con los datos a actualizar
            $data = [
                'name' => $request->name,
                'telefono_movil' => $request->telefono_movil,
            ];

            //asignamos el valor de la contraseña a una variable
            $newPassword = $request->password ? $request->password : null;

            //validamos se envio una nueva contraseña
            if(isset($newPassword)) {
                $data['password'] = bcrypt($newPassword);
            }

            //actualizamos los datos del usuario
            $user->update($data);

            return response()->json([
                'result' => true,
                'message' => 'Usuario actualizado con éxito'
            ], 200);

        }catch(\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => 'Error al actualizar usuario: ' . $e->getMessage()
            ], 200);
        }
    }

    public function updateAssistant(Request $request) 
    {
        try {
            $request->validate(
                [
                    'id' => 'required',
                    'telefono_movil' => 'required',
                    'ciudad' => 'required'
                ],
                [
                    'id.required' => 'Usuario no encontrado, vuelva a iniciar sesión e intente de nuevo',
                    'telefono_movil.required' => 'El telefono movil es requerido',
                    'ciudad.required' => 'La ciudad es requerida'
                ]
            );

            $user = User::where('id', $request->id)->first();

            //creamos un array con los datos a actualizar
            $data = [
                'telefono_movil' => $request->telefono_movil,
                'ciudad' => $request->ciudad,
            ];

            //asignamos el valor de la contraseña a una variable
            $newPassword = $request->password ? $request->password : null;

            //validamos se envio una nueva contraseña
            if(isset($newPassword)) {
                $data['password'] = bcrypt($newPassword);
            }

            //actualizamos los datos del usuario
            $user->update($data);

            return response()->json([
                'result' => true,
                'message' => 'Usuario actualizado con éxito'
            ], 200);

        }catch(\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => 'Error al actualizar usuario: ' . $e->getMessage()
            ], 200);
        }
    }
}

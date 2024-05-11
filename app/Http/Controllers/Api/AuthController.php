<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $request)
    {
        try {
            // $input = $request->all();
            $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ], [                
                'email.email' => 'Ingresa un correo electrónico válido.',
                'email.unique' => 'El correo electrónico ya está en uso por otro usuario.',
                'email.required' => 'El correo electrónico es obligatorio.',                
                'password.unique' => 'La clave ya está en uso por otro usuaria.',
                'password.required' => 'La clave es obligatoria.',
            ]);                  
                  

            $credentials = request(['email', 'password']);

            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'result' => false,
                    'message' => 'Credenciales inválidas',                    
                ], 200);
            }            

            $user = auth()->user();

            // Personaliza los claims del token
            $customClaims = [      
                'user' => [                     
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'id_rol' => $user->id_rol,
                    'avatar' => '',
                    'status' => $user->estatus,                
                ],
                'tokenType' => 'bearer',
            ];

            // assets/images/avatars/brian-hughes.jpg
            
            // Genera un token con los claims personalizados
            $token = JWTAuth::claims($customClaims)->fromUser($user);

            return response()->json([
                'result' => true,
                'message' => 'Inicio de sesión con éxito',                
                'access_token' => $token,
                'tokenType' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60,
                'user' => $customClaims,
            ]);
           

        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => 'Error al iniciar sesión: ' . $e->getMessage(),                
            ], 200);
        }
        
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}

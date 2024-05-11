<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\PasswordResetToken;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPasswordMail;
use App\Mail\PasswordResetConfirmation;

class ResetPasswordController extends Controller
{
    public function forgotPassword(Request $request)
    {
        try {
            //validamos que estamos recibiendo un email
            $request->validate([
                'email' => 'required'
            ],[
                'email.required' => 'El correo electrónico es requerido'
            ]);

            //verificar si el usuario existe
            $user = User::where('email', $request->email)->first();

            //en caso de no existir regresar una respuesta
            if (!isset($user)) {
                return response()->json([
                    'result' => false,
                    'message' => 'No encontramos un usuario registrado con este correo electrónico.' .
                                ' Por favor, asegúrate de que la dirección de correo electrónico sea correcta.'
                ], 200);
            }

            //establecer numero de intentos en uno
            $numeroIntentos = 1;

            //verificar si se tiene un token
            $passwordResetToken = PasswordResetToken::where('email', $user->email)->first();

            //validar si existe un token generado
            if (isset($passwordResetToken)) {
                // verificar límite de intentos durante una hora
                if ($passwordResetToken->reset_attempts >= 5 &&
                    $passwordResetToken->last_attempt_at > now()->subHour()) {
                    return response()->json([
                        'result' => false,
                        'message' => 'Has excedido el número máximo de intentos. Intenta nuevamente en una hora.'
                    ], 200);
                }elseif ($passwordResetToken->last_attempt_at > now()->subHour()) {
                    $numeroIntentos = $passwordResetToken->reset_attempts + 1;
                }

                //eliminamos el token actual
                $passwordResetToken->delete();
            }

            // Generar un token único para la recuperación de contraseña
            $token = JWTAuth::fromUser($user, ['exp' => now()->addDay()->timestamp]); // 24 horas en minutos

            //guardar el token y fecha de expiracion en la db
            PasswordResetToken::create([
                'email' => $user->email,
                'token' => $token,
                'expires_at' => now()->addDay(),
                'reset_attempts' => $numeroIntentos,
                'last_attempt_at' => now(),
            ]);
            
            //enviar correo electronico con la url de recuperacion
            $url = 'https://servyviajes.engranedigital.com/reset-password?token='.$token;
            Mail::to($request->email)->send(new ForgotPasswordMail($user, $url));

            return response()->json([
                'result' => true,
                'message' => 'Se ha enviado un enlace de restablecimiento de ' .
                            'contraseña al correo electrónico proporcionado.'
            ], 200);


        }catch(\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => 'Error al recuperar contraseña' . $e->getMessage()
            ], 200);
        }
    }
    
    public function resetPassword(Request $request)
    {
        try {
            $request->validate([
                'token' => 'required',
                'password' => 'required'
            ], [
                'token.required' => 'El token es requerido',
                'password.required' => 'La contraseña es requerida'
            ]);

            //verificamos si tenemos el token
            $token = PasswordResetToken::where('token', $request->token)->first();

            //en caso de no encontrase enviar una respuesta
            if(!isset($token)) {
                return response()->json([
                    'result' => false,
                    'message' => 'El enlace de restablecimiento de contraseña es inválido.' .
                                ' Por favor, solicita un nuevo enlace.'
                ], 200);
            }

            // Verificar si el token ha expirado
            if ($token->expires_at && now()->gt($token->expires_at)) {
                return response()->json([
                    'message' => 'El enlace de restablecimiento de contraseña ha expirado.' .
                                ' Por favor, solicita un nuevo enlace.'
                ], 200);
            }

            //buscamos al usuario con el email vinculado
            $user = User::where('email', $token->email)->first();

            //actualizamos la contraseña
            $user->password = bcrypt($request->password);
            $user->save();

            //enviamos un email de confirmación
            Mail::to($user->email)->send(new PasswordResetConfirmation($user));

            //eliminar el token
            $token->delete();

            return response()->json([
                'result' => true,
                'message' => '¡Contraseña restablecida con éxito! Ahora puedes' .
                            ' iniciar sesión con tu nueva contraseña.'
            ]);


        }catch(\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => 'Error al restablecer contraseña' . $e->getMessage()
            ]);
        }
    }
}

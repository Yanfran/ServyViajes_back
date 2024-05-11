<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Landing;
use App\Models\LandingBanner;
use App\Traits\ProcesarImgBase64;

class LandingController extends Controller
{
    use ProcesarImgBase64;

    public function index() {
        $landing = Landing::with('banners')->first();

        if(!isset($landing)) {
            return response()->json([
                "result" => true,
                "message" => "Landing no encontrado"
            ], 200);
        }

        return response()->json([
            "result" => true,
            "message" => "Landing obtenido con éxito",
            "data" => $landing
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            "nosotros" => "required|string",
            "mensaje" => "required|string",
            "telefono_fijo" => "required|string",
            "telefono_movil" => "required|string",
            "correo_contacto" => "required|string",
            "url_facebook" => "required|string",
            "domicilio" => "required|string",
            "imagen" => "required",
            "imagen_mensaje" => "required"
        ]);

        //almacenar todos los datos recibidos en data
        $data = $request->all();

        //procesamiento imagen base64
        $imagenBase64 = $request->input('imagen');
        $imagenBase64Procesado = $this->saveAndGetNameImg($imagenBase64);

        $imagenMensaje = $request->input('imagen_mensaje');
        $imagenMensajeProcesado = $this->saveAndGetNameImg($imagenMensaje);
        
        $landing = Landing::first();

        // validamos si ya existe un landing
        if(isset($landing)) {
            $landing->nosotros = $data['nosotros'];
            $landing->mensaje = $data['mensaje'];
            $landing->telefono_fijo = $data['telefono_fijo'];
            $landing->telefono_movil = $data['telefono_movil'];
            $landing->correo_contacto = $data['correo_contacto'];
            $landing->url_facebook = $data['url_facebook'];
            $landing->domicilio = $data['domicilio'];
            $landing->imagen = $imagenBase64Procesado;
            $landing->imagen_mensaje = $imagenMensajeProcesado;
            $landing->save();

            //guardar banners
            $banners = $request->input('banners');
            $landing->banners()->delete();
            
            foreach($banners as $banner) {
                //procesar banners
                $bannerProcesado = $this->saveAndGetNameImg($banner);
                $newBanner = new LandingBanner();
                $newBanner->landing_id = $landing->id;
                $newBanner->banner = $bannerProcesado;
                $newBanner->save();
            }

            return response()->json([
                "result" => true,
                "message" => "Landing actualizado con éxito"
            ], 200);
        }

        $landing = new Landing();
        $landing->nosotros = $data['nosotros'];
        $landing->mensaje = $data['mensaje'];
        $landing->telefono_fijo = $data['telefono_fijo'];
        $landing->telefono_movil = $data['telefono_movil'];
        $landing->correo_contacto = $data['correo_contacto'];
        $landing->url_facebook = $data['url_facebook'];
        $landing->domicilio = $data['domicilio'];
        $landing->imagen = $imagenBase64Procesado;
        $landing->imagen_mensaje = $imagenMensajeProcesado;
        $landing->save();

        //guardar banners
        $banners = $request->input('banners');
        foreach($banners as $banner) {
            //procesar banners
            $bannerProcesado = $this->saveAndGetNameImg($banner);
            $newBanner = new LandingBanner();
            $newBanner->landing_id = $landing->id;
            $newBanner->banner = $bannerProcesado;
            $newBanner->save();
        }

        return response()->json([
            "result" => true,
            "message" => "Landing creado con éxito"
        ], 200);

    }

    public function getLanding() {
        $landing = Landing::with('banners')->first();

        if(!isset($landing)) {
            return response()->json([
                "result" => false,
                "message" => "Landing no encontrado"
            ], 200);
        }

        return response()->json([
            "result" => true,
            "message" => "Landing obtenido con éxito",
            "data" => $landing
        ], 200);
    }
}
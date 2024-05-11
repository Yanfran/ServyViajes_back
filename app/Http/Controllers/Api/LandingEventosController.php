<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LandingEvento;
use App\Models\Banner;
use App\Models\Programa;
use App\Models\Patrocinadore;
use App\Models\Events;
use App\Traits\ProcesarImgBase64;
use App\Traits\ProcesarPdfBase64;

class LandingEventosController extends Controller
{
    use ProcesarImgBase64;
    use ProcesarPdfBase64;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = LandingEvento::with('banners')
            ->with('patrocinadores')
            ->with('programas')
            ->with('evento')
            ->get();

            return response()->json([
                "result" => true,
                "data" => $data,
                "message" => "lista de landing de eventos obtenida con éxito"
            ], 200);

        } catch(\Exception $e) {
            return response()->json([
                "result" => false,
                "message" => "La lista de landing eventos no puedo ser obtenida: " . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $request->validate([
                "color_fondo" => "required",
                "event_id" => "required",
                "que_incluye" => "required",
                "status" => "required",
                "dias" => "required",
                "conferencias" => "required",
                "profesores" => "required",
                "slug" => "required|unique:landing_eventos",
                "facebook" => "required",
                "whatsapp" => "required",
                "iframe_maps" => "required",
                "show_hotel" => "required",
                "show_event" => "required"
            ],[
                "color_fondo.required" => "El color de fondo es requerido.",
                "event_id.required" => "El evento es requerido.",
                "que_incluye.required" => "El campo que incluye es requerido.",
                "dias.required" => "El número días son requeridos.",
                "conferencias.required" => "El número de conferencias es requerido.",
                "profesores.required" => "El número de profesores es requerido.",
                "slug.required" => "El slug es requerido.",
                "slug.unique" => "El slug ya está en uso.",
                "facebook.required" => "El facebook es requerido.",
                "whatsapp.required" => "El whatsapp es requerido.",
                "iframe_maps.required" => "El iframe de maps es requerido.",
                "show_hotel.required" => "Mostrar u ocultar hotel es requerido.",
                "show_event.required" => "Mostrar u ocultar evento es requerido."
            ]);

            //procesar logo evento
            $logoEvento = $request->input('logo_evento');
            $logoEventoProcesado = $this->saveAndGetNameImg($logoEvento);
            //procesar logo_asociacion
            $logoAsociacion = $request->input('logo_asociacion');
            $logoAsociacionProcesado = $this->saveAndGetNameImg($logoAsociacion);
            //procesar pdf
            $pdfPrograma = $request->input('pdf_programa');
            $pdfProgramaProcesado = $this->saveAndGetNamePdf($pdfPrograma);

            $landingEvento = new LandingEvento();
            $landingEvento->color_fondo = $request->input('color_fondo');
            $landingEvento->event_id = $request->input('event_id');
            $landingEvento->slug = $request->input('slug');
            $landingEvento->logo_evento = $logoEventoProcesado;
            $landingEvento->logo_asociacion = $logoAsociacionProcesado;
            $landingEvento->que_incluye = $request->input('que_incluye');
            $landingEvento->pdf_programa = $pdfProgramaProcesado;
            $landingEvento->status = $request->input('status');
            $landingEvento->dias = $request->input('dias');
            $landingEvento->conferencias = $request->input('conferencias');
            $landingEvento->profesores = $request->input('profesores');
            $landingEvento->facebook = $request->input('facebook');
            $landingEvento->instagram = $request->input('instagram');
            $landingEvento->whatsapp = $request->input('whatsapp');
            $landingEvento->twitter = $request->input('twitter');
            $landingEvento->iframe_maps = $request->input('iframe_maps');
            $landingEvento->show_hotel = $request->input('show_hotel');
            $landingEvento->show_event = $request->input('show_event');
            $landingEvento->save();

            //guardar banners
            $banners = $request->input('banners');
            foreach($banners as $banner) {
                //procesar banners
                $bannerProcesado = $this->saveAndGetNameImg($banner);
                $newBanner = new Banner();
                $newBanner->landing_eventos_id = $landingEvento->id;
                $newBanner->banner = $bannerProcesado;
                $newBanner->save();
            }

            //guardar patrocinadores
            $patrocinadores = $request->input('patrocinadores');
            foreach($patrocinadores as $patrocinador) {
                //procesar patrocinadores
                $patrocinadorProcesado = $this->saveAndGetNameImg($patrocinador);
                $newPatrocinador = new Patrocinadore();
                $newPatrocinador->landing_eventos_id = $landingEvento->id;
                $newPatrocinador->patrocinador = $patrocinadorProcesado;
                $newPatrocinador->save();
            }

            //guardar programas
            $programas = $request->input('programas');
            foreach($programas as $programa) {
                $newPrograma = new Programa();
                $newPrograma->landing_eventos_id = $landingEvento->id;
                //$newPrograma->dia = $programa["dia"];
                $newPrograma->fecha = $programa["fecha"];
                $newPrograma->horario = $programa["horario"];
                $newPrograma->modulo_conferencia = $programa["modulo_conferencia"];
                $newPrograma->coordinador_profesor = $programa["coordinador_profesor"];
                $newPrograma->save();
            }

            return response()->json([
                "result" => true,
                "message" => "landing evento guardado con éxito"
            ], 200);

        } catch(\Exception $e) {
            return response()->json([
                "result" => false,
                "message" => "error al guardar landing evento: " . $e->getMessage()
            ], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {

            $request->validate([
                "color_fondo" => "required",
                "event_id" => "required",
                "que_incluye" => "required",
                "status" => "required",
                "dias" => "required",
                "conferencias" => "required",
                "profesores" => "required",
                "slug" => "required|unique:landing_eventos,slug,".$id,
                "facebook" => "required",
                "whatsapp" => "required",
                "iframe_maps" => "required",
                "show_hotel" => "required",
                "show_event" => "required"
            ],[
                "color_fondo.required" => "El color de fondo es requerido.",
                "event_id.required" => "El evento es requerido.",
                "que_incluye.required" => "El campo que incluye es requerido.",
                "dias.required" => "El número días son requeridos.",
                "conferencias.required" => "El número de conferencias es requerido.",
                "profesores.required" => "El número de profesores es requerido.",
                "slug.required" => "El slug es requerido.",
                "slug.unique" => "El slug ya está en uso",
                "facebook.required" => "El facebook es requerido.",
                "whatsapp.required" => "El whatsapp es requerido.",
                "iframe_maps.required" => "El iframe de maps es requerido.",
                "show_hotel.required" => "Mostrar u ocultar hotel es requerido.",
                "show_event.required" => "Mostrar u ocultar evento es requerido."
            ]);

            //procesar logo evento
            $logoEvento = $request->input('logo_evento');
            $logoEventoProcesado = $this->saveAndGetNameImg($logoEvento);
            //procesar logo_asociacion
            $logoAsociacion = $request->input('logo_asociacion');
            $logoAsociacionProcesado = $this->saveAndGetNameImg($logoAsociacion);
            //procesar pdf
            $pdfPrograma = $request->input('pdf_programa');
            $pdfProgramaProcesado = $this->saveAndGetNamePdf($pdfPrograma);
            
            $landingEventoId = $id;
            $landingEvento = LandingEvento::find($landingEventoId);
            $landingEvento->color_fondo = $request->input('color_fondo');
            $landingEvento->event_id = $request->input('event_id');
            $landingEvento->slug = $request->input('slug');
            $landingEvento->logo_evento = $logoEventoProcesado;
            $landingEvento->logo_asociacion = $logoAsociacionProcesado;
            $landingEvento->que_incluye = $request->input('que_incluye');
            $landingEvento->pdf_programa = $pdfProgramaProcesado;
            $landingEvento->status = $request->input('status');
            $landingEvento->dias = $request->input('dias');
            $landingEvento->conferencias = $request->input('conferencias');
            $landingEvento->profesores = $request->input('profesores');
            $landingEvento->facebook = $request->input('facebook');
            $landingEvento->instagram = $request->input('instagram');
            $landingEvento->whatsapp = $request->input('whatsapp');
            $landingEvento->twitter = $request->input('twitter');
            $landingEvento->iframe_maps = $request->input('iframe_maps');
            $landingEvento->show_hotel = $request->input('show_hotel');
            $landingEvento->show_event = $request->input('show_event');
            $landingEvento->save();
            /*
                Para actualizar los banners, pratrocinadores y programas 
                como no se actualizan los regitros si no que solo se agrega y elimina,
                cada vez que se actualice se elimaran los banners, patrocinadores y programas
                relacionados al landing-evento, para agregar nuevo o los mismos con
                diferentes regitros
            */
            //guardar banners
            $banners = $request->input('banners');
            $landingEvento->banners()->delete();
            
            foreach($banners as $banner) {
                //procesar banners
                $bannerProcesado = $this->saveAndGetNameImg($banner);
                $newBanner = new Banner();
                $newBanner->landing_eventos_id = $landingEvento->id;
                $newBanner->banner = $bannerProcesado;
                $newBanner->save();
            }

            //guardar patrocinadores
            $patrocinadores = $request->input('patrocinadores');
            $landingEvento->patrocinadores()->delete();
            
            foreach($patrocinadores as $patrocinador) {
                //procesar patrocinadores
                $patrocinadorProcesado = $this->saveAndGetNameImg($patrocinador);
                $newPatrocinador = new Patrocinadore();
                $newPatrocinador->landing_eventos_id = $landingEvento->id;
                $newPatrocinador->patrocinador = $patrocinadorProcesado;
                $newPatrocinador->save();
            }

            //guardar programas
            $programas = $request->input('programas');
            $landingEvento->programas()->delete();

            foreach($programas as $programa) {
                $newPrograma = new Programa();
                $newPrograma->landing_eventos_id = $landingEvento->id;
                //$newPrograma->dia = $programa["dia"];
                $newPrograma->fecha = $programa["fecha"];
                $newPrograma->horario = $programa["horario"];
                $newPrograma->modulo_conferencia = $programa["modulo_conferencia"];
                $newPrograma->coordinador_profesor = $programa["coordinador_profesor"];
                $newPrograma->save();
            }
            
            return response()->json([
                "result" => true,
                "message" => "landing evento actualizado con éxito"
            ], 200);
            
        } catch(\Exception $e) {
            return response()->json([
                "result" => false,
                "message" => "error al actualizar landing evento: " . $e->getMessage()
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $landingEvento = LandingEvento::find($id);
            $landingEvento->banners()->delete();
            $landingEvento->patrocinadores()->delete();
            $landingEvento->programas()->delete();
            $landingEvento->delete();

            return response()->json([
                "result" => true,
                "message" => "landing evento eliminado con éxito"
            ], 200);

        } catch(\Exception $e) {
            return response()->json([
                "result" => false,
                "message" => "error al eliminar landing evento: " . $e->getMessage()
            ], 500);
        }
    }

    public function getEventos() {
        try {
            $data = Events::where('estatus', 1)
                ->get();

            return response()->json([
                "result" => true,
                "data" => $data,
                "message" => "lista de eventos obtenida con éxito"
            ], 200);

        }catch(\Exception $e) {
            return response()->json([
                "result" => false,
                "message" => "error al obtener eventos: " . $e->getMessage()
            ], 500); 
        }
    }

    public function getLandingEventoBySlug($slug) {
        try {
            $data = LandingEvento::where('slug', $slug)
            ->with('banners')
            ->with('patrocinadores')
            ->with('programas')
            ->with('evento', function($query){
                $query->with('hotel', function($query) {
                    $query->with('galleries');
                    $query->with('servicios');
                });
                $query->with('availableCategories', function($query) {
                    $query->whereHas('category', function($query) {
                        $query->where('estatus', 1);
                    })
                    ->with('category')
                    ->where('estatus', 1);
                });
                $query->with('grados', function($query) {
                    $query->where('estatus', 1);
                });
            })
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->first();

            return response()->json([
                "result" => true,
                "data" => $data,
                "message" => "lista de landing de eventos obtenida con éxito"
            ], 200);
            
        }catch(\Exception $e) {
            return response()->json([
                "result" => false,
                "message" => "La lista de landing eventos no puedo ser obtenida: " . $e->getMessage()
            ], 500);
        }
    }

    public function downloadProgram(Request $request) {
        try{
            $nombrePDF = $request->input('nombre_pdf');
            $rutaPDF = public_path('assets/programas/') . $nombrePDF;
            
            $base64PDF = base64_encode(file_get_contents($rutaPDF));
            $data = [
                "pdf_base64" => $base64PDF
            ];

            return response()->json([
                "result" => true,
                "data" => $data,
                "message" => "programa obtenido con éxito"
            ], 200);

        }catch(\Exception $e) {
            return response()->json([
                "result" => false,
                "message" => "Programa no encontrado: " . $e->getMessage()
            ], 500);
        }
    }
}

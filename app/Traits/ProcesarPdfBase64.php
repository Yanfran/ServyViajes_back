<?php

namespace App\Traits;

trait ProcesarPdfBase64 {
    
    public function saveAndGetNamePdf($pdf) {
        //procesamiento imagen base64
        $pdfBase64 = $pdf;
        $datoBuscado = "data";

        if(strpos($pdfBase64, $datoBuscado) !== false) { //validamos si es base64
            // Eliminar el prefijo "data:image/png;base64,"
            $base64Data = substr($pdfBase64, strpos($pdfBase64, ',') + 1);

            $extension = "pdf";

            // Generar un nombre único para la imagen con la extensión correcta
            $nombreUnico = substr(md5(time() . 0 ), 0, 10) . '.' . $extension;

            // Ruta donde se guardará la imagen
            $rutaImagen = public_path('assets/programas/') . $nombreUnico;
                
            // Verificar si el archivo ya existe y generar un nombre único si es necesario
            while (file_exists($rutaImagen)) {
                $nombreUnico = substr(md5(time() . 0 . rand()), 0, 10) . '.' . $extension;
                $rutaImagen = public_path('assets/programas/') . $nombreUnico;
            }
        
            // Decodificar la imagen en base64 y guardarla
            $imagenDecodificada = base64_decode($base64Data);
            file_put_contents($rutaImagen, $imagenDecodificada);

            // devolvemos el nombre unico
            return $nombreUnico;
        }

        return $pdfBase64;
    }
}
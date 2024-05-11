<?php

namespace App\Traits;

trait ProcesarImgBase64 {
    
    public function saveAndGetNameImg($imagen) {
        //procesamiento imagen base64
        $imagenBase64 = $imagen;
        $datoBuscado = "data";

        if(strpos($imagenBase64, $datoBuscado) !== false) { //validamos si es base64
            // Eliminar el prefijo "data:image/png;base64,"
            $base64Data = substr($imagenBase64, strpos($imagenBase64, ',') + 1);

            $extension = $this->obtenerExtensionBase64($imagenBase64);

            // Generar un nombre único para la imagen con la extensión correcta
            $nombreUnico = substr(md5(time() . 0 ), 0, 10) . '.' . $extension;

            // Ruta donde se guardará la imagen
            $rutaImagen = public_path('assets/images/') . $nombreUnico;
                
            // Verificar si el archivo ya existe y generar un nombre único si es necesario
            while (file_exists($rutaImagen)) {
                $nombreUnico = substr(md5(time() . 0 . rand()), 0, 10) . '.' . $extension;
                $rutaImagen = public_path('assets/images/') . $nombreUnico;
            }
        
            // Decodificar la imagen en base64 y guardarla
            $imagenDecodificada = base64_decode($base64Data);
            file_put_contents($rutaImagen, $imagenDecodificada);

            // devolvemos el nombre unico
            return $nombreUnico;
        }

        return $imagenBase64;
    }

    public function obtenerExtensionBase64($imagenBase64) {
        preg_match('/^data:image\/(\w+);base64,/', $imagenBase64, $matches);
        
        if (count($matches) > 1) {
            return $matches[1]; // Devuelve la extensión (por ejemplo: 'jpeg', 'png', 'jpg', etc.)
        }
        
        return null; // No se encontró una extensión válida
    }
}
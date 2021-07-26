<?php

class Uploader {

    function __construct() {

    }

    function uploadPhoto($dir_path, $field_name) {
        $temp = $_FILES[$field_name]['tmp_name'];
        $path = $_FILES[$field_name]['name'];
        $ext = pathinfo($path)['extension'];
        $filename = pathinfo($path)['filename']; // Obtenemos el nombre de la imagen.
        $file = $filename . '_' . uniqid() . '.' . $ext; // Nuevo nombre de la imágen: 'NombreAnterior_ID.ext'
        if(move_uploaded_file($temp, $dir_path . $file)) { // Se almacena la imágen en servidor
            $this->feedback['resource'] = $file;
            $this->feedback['ok'] = true;
        } else {
            $this->feedback['ok'] = false;
        }

        return $this->feedback;
    }

    function deletePhoto($dir_path, $photo) {
        return unlink($dir_path . $photo); // Elimina la imágen pasada como parámetro. Devuelve true en caso de éxito.
    }
}
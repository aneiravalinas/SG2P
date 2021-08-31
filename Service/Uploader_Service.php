<?php

class Uploader {

    function __construct() {

    }


    function uploadFile($dir_path, $file_name) {
        $temp = $_FILES['nombre_doc']['tmp_name'];
        $feedback = $this->dir_exist($dir_path);
        if(!$feedback['ok']) {
            $feedback['ok'] = mkdir($dir_path, 0700, true);
            if(!$feedback['ok']) {
                $feedback['code'] = 'DIRFILE_IMPDIR_ADD_KO';
            }
        }

        if(move_uploaded_file($temp, $dir_path . '/' . $file_name)) {
            $feedback['ok'] = true;
            $feedback['code'] = 'FILE_ADD_OK';
        } else {
            $feedback['ok'] = false;
            $feedback['code'] = 'FILE_ADD_KO';
        }

        return $feedback;
    }

    function uploadPhoto($dir_path, $field_name) {
        $temp = $_FILES[$field_name]['tmp_name'];
        $path = $_FILES[$field_name]['name'];
        $ext = pathinfo($path)['extension'];
        $filename = pathinfo($path)['filename']; // Obtenemos el nombre de la imagen.
        $file = $filename . '_' . uniqid() . '.' . $ext; // Nuevo nombre de la imágen: 'NombreAnterior_ID.ext'
        if(move_uploaded_file($temp, $dir_path . $file)) { // Se almacena la imágen en servidor
            $feedback['resource'] = $file;
            $feedback['ok'] = true;
        } else {
            $feedback['ok'] = false;
        }

        return $feedback;
    }

    function deletePhoto($dir_path, $photo) {
        return unlink($dir_path . $photo); // Elimina la imágen pasada como parámetro. Devuelve true en caso de éxito.
    }

    function file_exist($path) {
        if(file_exists($path)) {
            $feedback['ok'] = true;
            $feedback['code'] = 'UPL_FILE_EXST';
        } else {
            $feedback['ok'] = false;
            $feedback['code'] = 'UPL_FILE_NOT_EXST';
        }

        return $feedback;
    }

    function dir_exist($path) {
        if(is_dir($path)) {
            $feedback['ok'] = true;
            $feedback['code'] = 'UPL_DIR_EXST';
        } else {
            $feedback['ok'] = false;
            $feedback['code'] = 'UPL_DIR_NOT_EXST';
        }

        return $feedback;
    }

    function create_dir($path, $dirname) {
        $feedback = $this->file_exist($path . $dirname);
        if($feedback['ok']) {
            $feedback['ok'] = false;
            return $feedback;
        }

        $feedback['ok'] = mkdir($path . $dirname, 0700, true);
        if($feedback['ok']) {
            $feedback['code'] = 'UPL_MKDIR_OK';
        } else {
            $feedback['code'] = 'UPL_MKDIR_KO';
        }

        return $feedback;
    }

    function dir_is_empty($path) {
        $feedback = $this->dir_exist($path);
        if(!$feedback['ok']) {
            return $feedback;
        }

        $dir = scandir($path);
        if(count($dir) > 2) {
            $feedback['ok'] = false;
            $feedback['code'] = 'UPL_DIR_NOT_EMPT';
        } else {
            $feedback['ok'] = true;
            $feedback['code'] = 'UPL_DIR_EMPT';
        }

        return $feedback;
    }

    function delete($path) {
        if(is_dir($path)) {
            $feedback['ok'] = rmdir($path);
            if($feedback['ok']) {
                $feedback['code'] = 'UPL_DEL_DIR_OK';
            } else {
                $feedback['code'] = 'UPL_DEL_DIR_KO';
            }
        } else {
            $feedback['ok'] = unlink($path);
            if($feedback['ok']) {
                $feedback['code'] = 'UPL_DEL_FILE_OK';
            } else {
                $feedback['code'] = 'UPL_DEL_FILE_KO';
            }
        }

        return $feedback;
    }

    function delete_all($path) {
        $files = scandir($path);
        array_shift($files);
        array_shift($files);

        foreach($files as $file) {
            $file = $path . '/' . $file;
            if(is_dir($file)) {
                $this->delete_all($file);
            } else {
                unlink($file);
            }
        }

        return $this->delete($path);
    }
}
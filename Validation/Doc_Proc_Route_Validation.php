<?php

include 'Cumplimentation_Validation.php';

class Doc_Proc_Route_Validation extends Cumplimentation_Validation {
    var $nombre_doc;

    function __construct() {
    }

    function validar_atributos_search() {
        $validacion = parent::validar_atributos_search();
        if(!$validacion['ok']) {
            return $validacion;
        }

        if($this->nombre_doc != '') {
            $validacion = $this->validar_NOMBRE_DOC_SEARCH();
        }

        return $validacion;
    }

    function validar_atributos_searchCompletions() {
        $validacion = $this->validar_atributos_search();
        if(!$validacion['ok']) {
            return $validacion;
        }

        if($this->edificio_id != '') {
            $validacion = $this->validar_EDIFICIO_ID();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        if($this->nombre_edificio != '') {
            $validacion = $this->validar_NOMBRE_EDIFICIO();
        }

        return $validacion;
    }

    function validar_NOMBRE_DOC() {
        if(!$this->no_vacio($this->nombre_doc)) {
            return $this->rellena_validation(false, 'FILENAME_EMPT', 'DOC_PROC_ROUTE');
        }

        if(!$this->longitud_maxima($this->nombre_doc, 50)) {
            return $this->rellena_validation(false, 'FILENAME_LRG', 'DOC_PROC_ROUTE');
        }

        if(!$this->formato_nombre_fichero($this->nombre_doc)) {
            return $this->rellena_validation(false, 'FILENAME_FRMT', 'DOC_PROC_ROUTE');
        }

        if(!$this->extension_fichero($this->nombre_doc)) {
            return $this->rellena_validation(false, 'FILENAME_EXT', 'DOC_PROC_ROUTE');
        }


        return $this->rellena_validation(true, '00000', 'DOC_PROC_ROUTE');
    }

    function validar_NOMBRE_DOC_SEARCH() {
        if(!$this->longitud_maxima($this->nombre_doc, 50)) {
            return $this->rellena_validation(false, 'FILENAME_LRG', 'DOC_PROC_ROUTE');
        }

        if(!$this->nombre_doc_search($this->nombre_doc)) {
            return $this->rellena_validation(false, 'FILENAME_FRMT', 'DOC_PROC_ROUTE');
        }

        return $this->rellena_validation(true, '00000', 'DOC_PROC_ROUTE');
    }

}
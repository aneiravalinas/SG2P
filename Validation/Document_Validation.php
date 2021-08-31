<?php

include_once 'Validator.php';

class Document_Validation extends Validator {
    var $edificio_documento_id;
    var $edificio_id;
    var $documento_id;
    var $estado;
    var $fecha_cumplimentacion;
    var $nombre_doc;
    var $nombre_edificio;
    var $buildings;
    const states = array('pendiente','cumplimentado','vencido');

    function __construct() {
    }

    function validar_atributos_searchImplements() {
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

    function validar_atributos_search() {
        $validacion = $this->rellena_validation(true, '00000', 'IMP_DOC');
        if($this->edificio_documento_id != '') {
            $validacion = $this->validar_EDIFICIO_DOCUMENTO_ID();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        if($this->estado != '') {
            $validacion = $this->validar_ESTADO();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        if($this->fecha_cumplimentacion != '') {
            $validacion = $this->validar_FECHA_CUMPLIMENTACION();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        if($this->nombre_doc != '') {
            $validacion = $this->validar_NOMBRE_DOC();
        }

        return $validacion;
    }

    function validar_seek_document() {
        $validacion = $this->validar_EDIFICIO_ID();
        if(!$validacion['ok']) {
            return $validacion;
        }

        return $this->validar_DOCUMENTO_ID();
    }

    function validar_atributos_add() {
        $validation = $this->validar_DOCUMENTO_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        return $this->validar_BUILDINGS();
    }

    function validar_EDIFICIO_DOCUMENTO_ID() {
        if(!$this->no_vacio($this->edificio_documento_id)) {
            return $this->rellena_validation(false, 'IMPDOC_ID_EMPT', 'IMP_DOC');
        }

        if(!$this->es_numerico($this->edificio_documento_id)) {
            return $this->rellena_validation(false, 'IMPDOC_ID_NOT_NUMERIC', 'IMP_DOC');
        }

        return $this->rellena_validation(true, '00000', 'IMP_DOC');
    }

    function validar_EDIFICIO_ID() {
        if(!$this->no_vacio($this->edificio_id)) {
            return $this->rellena_validation(false,'BLD_ID_EMPT','IMP_DOC');
        }

        if(!$this->es_numerico($this->edificio_id)) {
            return $this->rellena_validation(false,'BLD_ID_NOT_NUMERIC','IMP_DOC');
        }

        return $this->rellena_validation(true,'00000','IMP_DOC');
    }

    function validar_DOCUMENTO_ID() {
        if(!$this->no_vacio($this->documento_id)) {
            return $this->rellena_validation(false,'DFDOC_ID_EMPT','IMP_DOC');
        }

        if(!$this->es_numerico($this->documento_id)) {
            return $this->rellena_validation(false,'DFDOC_ID_NOT_NUMERIC','IMP_DOC');
        }

        return $this->rellena_validation(true,'00000','IMP_DOC');
    }

    function validar_ESTADO() {
        if(!$this->no_vacio($this->estado)) {
            return $this->rellena_validation(false,'STATE_EMPT','IMP_DOC');
        }

        if(!$this->en_valores($this->estado, self::states)) {
            return $this->rellena_validation(false,'STATE_KO','IMP_DOC');
        }

        return $this->rellena_validation(true,'00000','IMP_DOC');
    }

    function validar_FECHA_CUMPLIMENTACION() {
        if(!$this->validar_fecha($this->fecha_cumplimentacion)) {
            return $this->rellena_validation(false,'DATECOMP_KO','IMP_DOC');
        }

        return $this->rellena_validation(true,'00000','IMP_DOC');
    }

    function validar_NOMBRE_EDIFICIO() {
        if(!$this->longitud_minima($this->nombre_edificio,3)) {
            return $this->rellena_validation(false,'BLD_NAM_SHRT','IMP_DOC');
        }

        if(!$this->longitud_maxima($this->nombre_edificio,60)) {
            return $this->rellena_validation(false,'BLD_NAM_LRG','IMP_DOC');
        }

        if(!$this->solo_letras_numeros_espacios_acentos($this->nombre_edificio)) {
            return $this->rellena_validation(false,'BLD_NAM_FRMT','IMP_DOC');
        }

        return $this->rellena_validation(true,'00000','IMP_DOC');
    }

    function validar_NOMBRE_DOC() {
        if(!$this->no_vacio($this->nombre_doc)) {
            return $this->rellena_validation(false, 'FILENAME_EMPT', 'IMP_DOC');
        }

        if(!$this->longitud_maxima($this->nombre_doc, 50))
            return $this->rellena_validation(false, 'FILENAME_LRG', 'IMP_DOC');

        if(!$this->formato_nombre_fichero($this->nombre_doc)) {
            return $this->rellena_validation(false, 'FILENAME_FRMT', 'IMP_DOC');
        }

        if(!$this->extension_fichero($this->nombre_doc)) {
            return $this->rellena_validation(false, 'FILENAME_EXT', 'IMP_DOC');
        }


        return $this->rellena_validation(true, '00000', 'IMP_DOC');
    }

    function validar_BUILDINGS() {
        if(empty($this->buildings)) {
            return $this->rellena_validation(false, 'BLD_ID_EMPT', 'IMP_DOC');
        }

        foreach($this->buildings as $building) {
            $this->edificio_id = $building;
            $validacion = $this->validar_EDIFICIO_ID();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        return $this->rellena_validation(true, '00000', 'IMP_DOC');
    }

}
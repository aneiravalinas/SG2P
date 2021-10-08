<?php

include_once 'Validator.php';

class Procedure_Validation extends Validator {
    var $edificio_procedimiento_id;
    var $edificio_id;
    var $procedimiento_id;
    var $estado;
    var $fecha_cumplimentacion;
    var $fecha_vencimiento;
    var $nombre_doc;
    var $buildings = array();
    var $nombre_edificio;
    const states = array('pendiente','cumplimentado','vencido');

    function __construct() {
    }

    function validar_atributos_search() {
        $validation = $this->rellena_validation(true, '00000', 'IMP_PROC');
        if($this->edificio_procedimiento_id != '') {
            $validation = $this->validar_EDIFICIO_PROCEDIMIENTO_ID();
            if(!$validation['ok']) {
                return $validation;
            }
        }

        if($this->estado != '') {
            $validation = $this->validar_ESTADO();
            if(!$validation['ok']) {
                return $validation;
            }
        }

        if($this->fecha_cumplimentacion != '') {
            $validation = $this->validar_FECHA_CUMPLIMENTACION();
            if(!$validation['ok']) {
                return $validation;
            }
        }

        if($this->fecha_vencimiento != '') {
            $validation = $this->validar_FECHA_VENCIMIENTO();
            if(!$validation['ok']) {
                return $validation;
            }
        }

        if($this->nombre_doc != '') {
            $validation = $this->validar_NOMBRE_DOC_SEARCH();
        }

        return $validation;
    }

    function validar_atributos_search_implements() {
        $validation = $this->validar_atributos_search();
        if(!$validation['ok']) {
            return $validation;
        }

        if($this->edificio_id != '') {
            $validation = $this->validar_EDIFICIO_ID();
            if(!$validation['ok']) {
                return $validation;
            }
        }

        if($this->nombre_edificio != '') {
            $validation = $this->validar_NOMBRE_EDIFICIO();
        }

        return $validation;
    }

    function validar_proc_and_building() {
        $validation = $this->validar_PROCEDIMIENTO_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        return $this->validar_EDIFICIO_ID();
    }

    function validar_atributos_add() {
        $validation = $this->validar_PROCEDIMIENTO_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        return $this->validar_BUILDINGS();
    }

    function validar_EDIFICIO_PROCEDIMIENTO_ID() {
        if(!$this->no_vacio($this->edificio_procedimiento_id)) {
            return $this->rellena_validation(false, 'IMPPROC_ID_EMPT', 'IMP_PROC');
        }

        if(!$this->es_numerico($this->edificio_procedimiento_id)) {
            return $this->rellena_validation(false, 'IMPPROC_ID_NOT_NUMERIC', 'IMP_PROC');
        }

        return $this->rellena_validation(true, '00000', 'IMP_PROC');
    }

    function validar_EDIFICIO_ID() {
        if(!$this->no_vacio($this->edificio_id)) {
            return $this->rellena_validation(false,'BLD_ID_EMPT','IMP_PROC');
        }

        if(!$this->es_numerico($this->edificio_id)) {
            return $this->rellena_validation(false,'BLD_ID_NOT_NUMERIC','IMP_PROC');
        }

        return $this->rellena_validation(true,'00000','IMP_DOC');
    }

    function validar_PROCEDIMIENTO_ID() {
        if(!$this->no_vacio($this->procedimiento_id)) {
            return $this->rellena_validation(false,'DFPROC_ID_EMPT','IMP_PROC');
        }

        if(!$this->es_numerico($this->procedimiento_id)) {
            return $this->rellena_validation(false,'DFPROC_ID_NOT_NUMERIC','IMP_PROC');
        }

        return $this->rellena_validation(true,'00000','IMP_PROC');
    }

    function validar_ESTADO() {
        if(!$this->no_vacio($this->estado)) {
            return $this->rellena_validation(false,'STATE_EMPT','IMP_PROC');
        }

        if(!$this->en_valores($this->estado, self::states)) {
            return $this->rellena_validation(false,'STATE_KO','IMP_PROC');
        }

        return $this->rellena_validation(true,'00000','IMP_PROC');
    }

    function validar_FECHA_CUMPLIMENTACION() {
        if(!$this->validar_fecha($this->fecha_cumplimentacion)) {
            return $this->rellena_validation(false,'DATECOMP_KO','IMP_PROC');
        }

        return $this->rellena_validation(true,'00000','IMP_PROC');
    }

    function validar_FECHA_VENCIMIENTO() {
        if(!$this->validar_fecha($this->fecha_vencimiento)) {
            return $this->rellena_validation(false, 'DATEEXPIRE_KO','IMP_PROC');
        }

        return $this->rellena_validation(true, '00000', 'IMP_PROC');
    }

    function validar_NOMBRE_EDIFICIO() {
        if(!$this->longitud_minima($this->nombre_edificio,3)) {
            return $this->rellena_validation(false,'BLD_NAM_SHRT','IMP_PROC');
        }

        if(!$this->longitud_maxima($this->nombre_edificio,60)) {
            return $this->rellena_validation(false,'BLD_NAM_LRG','IMP_PROC');
        }

        if(!$this->solo_letras_numeros_espacios_acentos($this->nombre_edificio)) {
            return $this->rellena_validation(false,'BLD_NAM_FRMT','IMP_PROC');
        }

        return $this->rellena_validation(true,'00000','IMP_PROC');
    }

    function validar_NOMBRE_DOC() {
        if(!$this->no_vacio($this->nombre_doc)) {
            return $this->rellena_validation(false, 'FILENAME_EMPT', 'IMP_PROC');
        }

        if(!$this->longitud_maxima($this->nombre_doc, 50)) {
            return $this->rellena_validation(false, 'FILENAME_LRG', 'IMP_PROC');
        }

        if(!$this->formato_nombre_fichero($this->nombre_doc)) {
            return $this->rellena_validation(false, 'FILENAME_FRMT', 'IMP_PROC');
        }

        if(!$this->extension_fichero($this->nombre_doc)) {
            return $this->rellena_validation(false, 'FILENAME_EXT', 'IMP_PROC');
        }


        return $this->rellena_validation(true, '00000', 'IMP_PROC');
    }

    function validar_NOMBRE_DOC_SEARCH() {
        if(!$this->longitud_maxima($this->nombre_doc, 50)) {
            return $this->rellena_validation(false, 'FILENAME_LRG', 'IMP_PROC');
        }

        if(!$this->nombre_doc_search($this->nombre_doc)) {
            return $this->rellena_validation(false, 'FILENAME_FRMT', 'IMP_PROC');
        }

        return $this->rellena_validation(true, '00000', 'IMP_PROC');
    }

    function validar_BUILDINGS() {
        if(empty($this->buildings)) {
            return $this->rellena_validation(false, 'BLD_ID_EMPT', 'IMP_PROC');
        }

        foreach($this->buildings as $building) {
            $this->edificio_id = $building;
            $validacion = $this->validar_EDIFICIO_ID();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        return $this->rellena_validation(true, '00000', 'IMP_PROC');
    }
}
<?php

include_once 'Validator.php';

class DefProc_Validation extends Validator {
    var $procedimiento_id;
    var $plan_id;
    var $nombre;
    var $descripcion;

    function __construct() {

    }


    function validar_atributos(){
        $validacion = $this->validar_NOMBRE();
        if(!$validacion['ok']) {
            return $validacion;
        }

        return $this->validar_DESCRIPCION();
    }

    function validar_atributos_search() {
        $validacion = $this->rellena_validation(true,'00000','DEF_PROC');
        if($this->procedimiento_id != '') {
            $validacion = $this->validar_PROCEDIMIENTO_ID();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        if($this->nombre != '') {
            $validacion = $this->validar_NOMBRE();
        }

        return $validacion;
    }

    function validar_PROCEDIMIENTO_ID() {
        if(!$this->no_vacio($this->procedimiento_id)) {
            return $this->rellena_validation(false,'DFPROC_ID_EMPT','DEF_PROC');
        }

        if(!$this->es_numerico($this->procedimiento_id)) {
            return $this->rellena_validation(false,'DFPROC_ID_NOT_NUMERIC','DEF_PROC');
        }

        return $this->rellena_validation(true,'00000','DEF_PROC');
    }

    function validar_PLAN_ID() {
        if(!$this->no_vacio($this->plan_id)) {
            return $this->rellena_validation(false, 'DFPLAN_ID_EMPT', 'DEF_PROC');
        }

        if(!$this->es_numerico($this->plan_id)) {
            return $this->rellena_validation(false, 'DFPLAN_ID_NOT_NUMERIC', 'DEF_PROC');
        }

        return $this->rellena_validation(true,'00000','DEF_PROC');
    }

    function validar_NOMBRE() {
        if(!$this->longitud_minima($this->nombre,5)) {
            return $this->rellena_validation(false,'DFPROC_NAM_SHRT','DEF_PROC');
        }

        if(!$this->longitud_maxima($this->nombre,50)) {
            return $this->rellena_validation(false,'DFPROC_NAM_LRG','DEF_PROC');
        }

        if(!$this->solo_alfanumerico_espacios_guiones($this->nombre)) {
            return $this->rellena_validation(false,'DFPROC_NAM_FRMT','DEF_PROC');
        }

        return $this->rellena_validation(true,'00000','DEF_PROC');
    }

    function validar_DESCRIPCION() {
        if(!$this->no_vacio($this->descripcion)) {
            return $this->rellena_validation(false,'DESC_EMPTY','DEF_PROC');
        }

        if(!$this->comprobar_textos($this->descripcion)) {
            return $this->rellena_validation(false,'DESC_FRMT','DEF_PROC');
        }

        return $this->rellena_validation(true,'00000','DEF_PROC');
    }
}
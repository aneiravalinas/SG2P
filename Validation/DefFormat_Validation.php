<?php

include_once 'Validator.php';

class DefFormat_Validation extends Validator {
    var $formacion_id;
    var $plan_id;
    var $nombre;
    var $descripcion;


    function __construct(){
    }

    function validar_atributos() {
        $validation = $this->validar_NOMBRE();
        if(!$validation['ok']) {
            return $validation;
        }

        return $this->validar_DESCRIPCION();
    }

    function validar_atributos_search() {
        $validation = $this->rellena_validation(true,'00000','DEF_FORMAT');
        if($this->formacion_id != '') {
            $validation = $this->validar_FORMACION_ID();
            if(!$validation['ok']) {
                return $validation;
            }
        }

        if($this->nombre != '') {
            $validation = $this->validar_NOMBRE();
        }

        return $validation;
    }

    function validar_FORMACION_ID() {
        if(!$this->no_vacio($this->formacion_id)) {
            return $this->rellena_validation(false,'DFFRMT_ID_EMPT','DEF_FORMAT');
        }

        if(!$this->es_numerico($this->formacion_id)) {
            return $this->rellena_validation(false,'DEFFRMT_ID_NOT_NUMERIC','DEF_FORMAT');
        }

        return $this->rellena_validation(true,'00000','DEF_FORMAT');
    }

    function validar_PLAN_ID() {
        if(!$this->no_vacio($this->plan_id)) {
            return $this->rellena_validation(false, 'DFPLAN_ID_EMPT', 'DEF_FORMAT');
        }

        if(!$this->es_numerico($this->plan_id)) {
            return $this->rellena_validation(false, 'DFPLAN_ID_NOT_NUMERIC', 'DEF_FORMAT');
        }

        return $this->rellena_validation(true,'00000','DEF_FORMAT');
    }

    function validar_NOMBRE() {
        if(!$this->longitud_minima($this->nombre,5)) {
            return $this->rellena_validation(false,'DFFRMT_NAM_SHRT','DEF_FORMAT');
        }

        if(!$this->longitud_maxima($this->nombre,50)) {
            return $this->rellena_validation(false,'DFFRMT_NAM_LRG','DEF_FORMAT');
        }

        if(!$this->solo_alfanumerico_espacios_guiones($this->nombre)) {
            return $this->rellena_validation(false,'DFFRMT_NAM_FRMT','DEF_FORMAT');
        }

        return $this->rellena_validation(true,'00000','DEF_FORMAT');
    }

    function validar_DESCRIPCION() {
        if(!$this->no_vacio($this->descripcion)) {
            return $this->rellena_validation(false,'DESC_EMPTY','DEF_FORMAT');
        }

        if(!$this->comprobar_textos($this->descripcion)) {
            return $this->rellena_validation(false,'DESC_FRMT','DEF_FORMAT');
        }

        return $this->rellena_validation(true,'00000','DEF_FORMAT');
    }

}
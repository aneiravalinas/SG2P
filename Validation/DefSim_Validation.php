<?php

include_once 'Validator.php';

class DefSim_Validation extends Validator {
    var $simulacro_id;
    var $plan_id;
    var $nombre;
    var $descripcion;

    function __construct() {

    }

    function validar_atributos() {
        $validation = $this->validar_NOMBRE();
        if(!$validation['ok']) {
            return $validation;
        }

        return $this->validar_DESCRIPCION();
    }

    function validar_atributos_search() {
        $validation = $this->rellena_validation(true,'00000','DEF_SIM');
        if($this->simulacro_id != '') {
            $validation = $this->validar_SIMULACRO_ID();
            if(!$validation['ok']) {
                return $validation;
            }
        }

        if($this->nombre != '') {
            $validation = $this->validar_NOMBRE();
        }

        return $validation;
    }

    function validar_SIMULACRO_ID() {
        if(!$this->no_vacio($this->simulacro_id)) {
            return $this->rellena_validation(false,'DFSIM_ID_EMPT','DEF_SIM');
        }

        if(!$this->es_numerico($this->simulacro_id)) {
            return $this->rellena_validation(false,'DFSIM_ID_NOT_NUMERIC','DEF_SIM');
        }

        return $this->rellena_validation(true,'00000','DEF_SIM');
    }

    function validar_PLAN_ID() {
        if(!$this->no_vacio($this->plan_id)) {
            return $this->rellena_validation(false, 'DFPLAN_ID_EMPT', 'DEF_SIM');
        }

        if(!$this->es_numerico($this->plan_id)) {
            return $this->rellena_validation(false, 'DFPLAN_ID_NOT_NUMERIC', 'DEF_SIM');
        }

        return $this->rellena_validation(true,'00000','DEF_SIM');
    }

    function validar_NOMBRE() {
        if(!$this->longitud_minima($this->nombre,5)) {
            return $this->rellena_validation(false,'DFSIM_NAM_SHRT','DEF_SIM');
        }

        if(!$this->longitud_maxima($this->nombre,50)) {
            return $this->rellena_validation(false,'DFSIM_NAM_LRG','DEF_SIM');
        }

        if(!$this->solo_alfanumerico_espacios_guiones($this->nombre)) {
            return $this->rellena_validation(false,'DFSIM_NAM_FRMT','DEF_SIM');
        }

        return $this->rellena_validation(true,'00000','DEF_SIM');
    }

    function validar_DESCRIPCION() {
        if(!$this->no_vacio($this->descripcion)) {
            return $this->rellena_validation(false,'DESC_EMPTY','DEF_SIM');
        }

        if(!$this->comprobar_textos($this->descripcion)) {
            return $this->rellena_validation(false,'DESC_FRMT','DEF_SIM');
        }

        return $this->rellena_validation(true,'00000','DEF_SIM');
    }
}
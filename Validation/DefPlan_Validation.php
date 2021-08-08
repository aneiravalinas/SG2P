<?php

include 'Validator.php';

class DefPlan_Validation extends Validator {
    var $plan_id;
    var $nombre;
    var $descripcion;

    function __construct() {

    }

    function validar_atributos_search() {
        $validacion = array('ok' => true, 'code' => '00000', 'resource' => 'EDIFICIO');
        if($this->plan_id != '') {
            $validacion = $this->validar_PLAN_ID();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        if($this->nombre != '') {
            $validacion = $this->validar_NOMBRE();
        }

        return $validacion;
    }

    function validar_atributos() {
        $validacion = $this->validar_NOMBRE();
        if(!$validacion['ok']) {
            return $validacion;
        }

        return $this->validar_DESCRIPCION();;
    }

    function validar_PLAN_ID() {
        if(!$this->no_vacio($this->plan_id)) {
            return $this->rellena_validation(false, 'DFPLAN_ID_EMPT', 'DEF_PLAN');
        }

        if(!$this->es_numerico($this->plan_id)) {
            return $this->rellena_validation(false, 'DFPLAN_ID_NOT_NUMERIC', 'DEF_PLAN');
        }

        return $this->rellena_validation(true,'00000','DEF_PLAN');
    }

    function validar_NOMBRE() {
        if(!$this->longitud_minima($this->nombre, 5)) {
            return $this->rellena_validation(false, 'DFPLAN_NAM_SHRT', 'DEF_PLAN');
        }

        if(!$this->longitud_maxima($this->nombre,60)) {
            return $this->rellena_validation(false, 'DEFPLAN_NAM_LRG', 'DEF_PLAN');
        }

        if(!$this->solo_alfanumerico_espacios_guiones($this->nombre)) {
            return $this->rellena_validation(false, 'DEFPLAN_NAM_FRMT', 'DEF_PLAN');
        }

        return $this->rellena_validation(true, '00000', 'DEF_PLAN');
    }

    function validar_DESCRIPCION() {
        if(!$this->no_vacio($this->descripcion)) {
            return $this->rellena_validation(false,'DESC_EMPTY','DEF_PLAN');
        }

        if(!$this->comprobar_textos($this->descripcion)) {
            return $this->rellena_validation(false,'DESC_FRMT','DEF_PLAN');
        }

        return $this->rellena_validation(true,'00000','DEF_PLAN');
    }
}
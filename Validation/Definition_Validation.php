<?php

include_once 'Validator.php';

class Definition_Validation extends Validator {
    var $nombre;
    var $descripcion;
    var $plan_id;

    function __construct() {
    }

    function validar_atributos() {
        $validacion = $this->validar_NOMBRE();
        if(!$validacion['ok']) {
            return $validacion;
        }

        return $this->validar_DESCRIPCION();
    }

    function validar_atributos_search() {
        if($this->nombre != '') {
            return $this->validar_NOMBRE_SEARCH();
        }

        return $this->rellena_validation(true, '00000', 'DEFINITION');
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
            return $this->rellena_validation(false, 'DEFNAM_SHRT', 'DEFINITION');
        }

        if(!$this->longitud_maxima($this->nombre,60)) {
            return $this->rellena_validation(false, 'DEFNAM_LRG', 'DEFINITION');
        }

        if(!$this->solo_alfanumerico_espacios_guiones($this->nombre)) {
            return $this->rellena_validation(false, 'DEFNAM_FRMT', 'DEFINITION');
        }

        return $this->rellena_validation(true, '00000', 'DEFINITION');
    }

    function validar_NOMBRE_SEARCH() {
        if(!$this->longitud_maxima($this->nombre,60)) {
            return $this->rellena_validation(false, 'DEFNAM_LRG', 'DEFINITION');
        }

        if(!$this->solo_alfanumerico_espacios_guiones($this->nombre)) {
            return $this->rellena_validation(false, 'DEFNAM_FRMT', 'DEFINITION');
        }

        return $this->rellena_validation(true, '00000', 'DEFINITION');
    }

    function validar_DESCRIPCION() {
        if(!$this->no_vacio($this->descripcion)) {
            return $this->rellena_validation(false,'DESC_EMPTY','DEFINITION');
        }

        if(!$this->comprobar_textos($this->descripcion)) {
            return $this->rellena_validation(false,'DESC_FRMT','DEFINITION');
        }

        return $this->rellena_validation(true,'00000','DEFINITION');
    }
}
<?php

include_once 'Validator.php';

class DefDoc_Validation extends Validator {
    var $documento_id;
    var $plan_id;
    var $nombre;
    var $descripcion;
    var $visible;

    function __construct() {

    }

    function validar_atributos() {
        $validacion = $this->validar_NOMBRE();
        if(!$validacion['ok']) {
            return $validacion;
        }

        $validacion = $this->validar_DESCRIPCION();
        if(!$validacion['ok']) {
            return $validacion;
        }

        return $this->validar_VISIBLE();

    }

    function validar_atributos_search() {
        $validacion = $this->rellena_validation(true,'00000','DEF_DOC');

        if($this->documento_id != '') {
            $validacion = $this->validar_DOCUMENTO_ID();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        if($this->nombre != '') {
            $validacion = $this->validar_NOMBRE();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        if($this->visible != '') {
            $validacion = $this->validar_VISIBLE();
        }

        return $validacion;
    }

    function validar_DOCUMENTO_ID() {
        if(!$this->no_vacio($this->documento_id)) {
            return $this->rellena_validation(false,'DFDOC_ID_EMPT','DEF_DOC');
        }

        if(!$this->es_numerico($this->documento_id)) {
            return $this->rellena_validation(false,'DFDOC_ID_NOT_NUMERIC','DEF_DOC');
        }

        return $this->rellena_validation(true,'00000','DEF_DOC');
    }

    function validar_PLAN_ID() {
        if(!$this->no_vacio($this->plan_id)) {
            return $this->rellena_validation(false, 'DFPLAN_ID_EMPT', 'DEF_DOC');
        }

        if(!$this->es_numerico($this->plan_id)) {
            return $this->rellena_validation(false, 'DFPLAN_ID_NOT_NUMERIC', 'DEF_DOC');
        }

        return $this->rellena_validation(true,'00000','DEF_DOC');
    }

    function validar_NOMBRE() {
        if(!$this->longitud_minima($this->nombre,5)) {
            return $this->rellena_validation(false,'DFDOC_NAM_SHRT','DEF_DOC');
        }

        if(!$this->longitud_maxima($this->nombre,50)) {
            return $this->rellena_validation(false,'DFDOC_NAM_LRG','DEF_DOC');
        }

        if(!$this->solo_alfanumerico_espacios_guiones($this->nombre)) {
            return $this->rellena_validation(false,'DFDOC_NAM_FRMT','DEF_DOC');
        }

        return $this->rellena_validation(true,'00000','DEF_DOC');
    }

    function validar_DESCRIPCION() {
        if(!$this->no_vacio($this->descripcion)) {
            return $this->rellena_validation(false,'DESC_EMPTY','DEF_DOC');
        }

        if(!$this->comprobar_textos($this->descripcion)) {
            return $this->rellena_validation(false,'DESC_FRMT','DEF_DOC');
        }

        return $this->rellena_validation(true,'00000','DEF_DOC');
    }

    function validar_VISIBLE() {
        if(!$this->no_vacio($this->visible)) {
            return $this->rellena_validation(false,'DFDOC_VISB_EMPT','DEF_DOC');
        }

        if(!$this->en_valores($this->visible, array('yes', 'no'))) {
            return $this->rellena_validation(false,'DFDOC_VISB_VALUES','DEF_DOC');
        }

        return $this->rellena_validation(true,'00000','DEF_DOC');
    }
}
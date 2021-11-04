<?php

include_once 'Definition_Validation.php';

class DefDoc_Validation extends Definition_Validation {
    var $documento_id;
    var $visible;

    function __construct() {
    }

    function validar_atributos() {
        $validacion = parent::validar_atributos();
        if(!$validacion['ok']) {
            return $validacion;
        }

        return $this->validar_VISIBLE();

    }

    function validar_atributos_search() {
        $validacion = parent::validar_atributos_search();
        if(!$validacion['ok']) {
            return $validacion;
        }

        if($this->documento_id != '') {
            $validacion = $this->validar_DOCUMENTO_ID();
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
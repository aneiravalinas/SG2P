<?php

include_once 'Definition_Validation.php';

class DefProc_Validation extends Definition_Validation {
    var $procedimiento_id;

    function __construct() {
    }

    function validar_atributos_search() {
        $validacion = parent::validar_atributos_search();
        if(!$validacion['ok']) {
            return $validacion;
        }

        if($this->procedimiento_id != '') {
            $validacion = $this->validar_PROCEDIMIENTO_ID();
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
}
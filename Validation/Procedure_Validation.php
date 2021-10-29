<?php

include_once 'Doc_Proc_Route_Validation.php';

class Procedure_Validation extends Doc_Proc_Route_Validation {
    var $procedimiento_id;

    function __construct() {
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

    function validar_PROCEDIMIENTO_ID() {
        if(!$this->no_vacio($this->procedimiento_id)) {
            return $this->rellena_validation(false,'DFPROC_ID_EMPT','IMP_PROC');
        }

        if(!$this->es_numerico($this->procedimiento_id)) {
            return $this->rellena_validation(false,'DFPROC_ID_NOT_NUMERIC','IMP_PROC');
        }

        return $this->rellena_validation(true,'00000','IMP_PROC');
    }

}
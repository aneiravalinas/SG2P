<?php

include_once 'Sim_Format_Validation.php';

class Formation_Validation extends Sim_Format_Validation {
    var $formacion_id;

    function __construct() {
    }

    function validar_format_and_building() {
        $validacion = $this->validar_FORMACION_ID();
        if(!$validacion['ok']) {
            return $validacion;
        }

        return $this->validar_EDIFICIO_ID();
    }

    function validar_atributos_add() {
        $validacion = $this->validar_FORMACION_ID();
        if(!$validacion['ok']) {
            return $validacion;
        }

        return $this->validar_BUILDINGS();
    }

    function validar_FORMACION_ID() {
        if(!$this->no_vacio($this->formacion_id)) {
            return $this->rellena_validation(false,'DFFRMT_ID_EMPT','IMP_FORMAT');
        }

        if(!$this->es_numerico($this->formacion_id)) {
            return $this->rellena_validation(false,'DEFFRMT_ID_NOT_NUMERIC','IMP_FORMAT');
        }

        return $this->rellena_validation(true,'00000','IMP_FORMAT');
    }
}
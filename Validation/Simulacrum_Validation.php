<?php

include_once 'Sim_Format_Validation.php';

class Simulacrum_Validation extends Sim_Format_Validation {
    var $simulacro_id;

    function __construct() {
    }

    function validar_sim_and_building() {
        $validacion = $this->validar_SIMULACRO_ID();
        if(!$validacion['ok']) {
            return $validacion;
        }

        return $this->validar_EDIFICIO_ID();
    }

    function validar_atributos_add() {
        $validacion = $this->validar_SIMULACRO_ID();
        if(!$validacion['ok']) {
            return $validacion;
        }

        return $this->validar_BUILDINGS();
    }

    function validar_SIMULACRO_ID() {
        if(!$this->no_vacio($this->simulacro_id)) {
            return $this->rellena_validation(false, 'DFSIM_ID_EMPT', 'IMP_SIM');
        }

        if(!$this->es_numerico($this->simulacro_id)) {
            return $this->rellena_validation(false, 'DFSIM_ID_NOT_NUMERIC', 'IMP_SIM');
        }

        return $this->rellena_validation(true, '00000', 'IMP_SIM');
    }
}
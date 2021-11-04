<?php

include_once 'Definition_Validation.php';

class DefSim_Validation extends Definition_Validation {
    var $simulacro_id;

    function __construct() {

    }

    function validar_atributos_search() {
        $validation = parent::validar_atributos_search();

        if($this->simulacro_id != '') {
            $validation = $this->validar_SIMULACRO_ID();
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

}
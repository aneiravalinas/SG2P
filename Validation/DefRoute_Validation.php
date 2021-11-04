<?php

include_once 'Definition_Validation.php';

class DefRoute_Validation extends Definition_Validation {
    var $ruta_id;

    function __construct() {
    }

    function validar_atributos_search() {
        $validation = parent::validar_atributos_search();
        if(!$validation['ok']) {
            return $validation;
        }

        if($this->ruta_id != '') {
            $validation = $this->validar_RUTA_ID();
        }

        return $validation;
    }


    function validar_RUTA_ID() {
        if(!$this->no_vacio($this->ruta_id)) {
            return $this->rellena_validation(false,'DFROUTE_ID_EMPT','DEF_ROUTE');
        }

        if(!$this->es_numerico($this->ruta_id)) {
            return $this->rellena_validation(false,'DEFROUTE_ID_NOT_NUMERIC','DEF_ROUTE');
        }

        return $this->rellena_validation(true,'00000','DEF_ROUTE');
    }

}
<?php

include_once 'Definition_Validation.php';

class DefFormat_Validation extends Definition_Validation {
    var $formacion_id;


    function __construct(){
    }

    function validar_atributos_search() {
        $validation = parent::validar_atributos_search();
        if(!$validation['ok']) {
            return $validation;
        }

        if($this->formacion_id != '') {
            $validation = $this->validar_FORMACION_ID();
        }

        return $validation;
    }

    function validar_FORMACION_ID() {
        if(!$this->no_vacio($this->formacion_id)) {
            return $this->rellena_validation(false,'DFFRMT_ID_EMPT','DEF_FORMAT');
        }

        if(!$this->es_numerico($this->formacion_id)) {
            return $this->rellena_validation(false,'DEFFRMT_ID_NOT_NUMERIC','DEF_FORMAT');
        }

        return $this->rellena_validation(true,'00000','DEF_FORMAT');
    }

}
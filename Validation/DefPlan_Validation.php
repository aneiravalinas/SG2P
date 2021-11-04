<?php

include_once 'Definition_Validation.php';

class DefPlan_Validation extends Definition_Validation {

    function __construct() {
    }

    function validar_atributos_search() {
        $validation = parent::validar_atributos_search();
        if(!$validation['ok']) {
            return $validation;
        }

        if($this->plan_id != '') {
            $validation = $this->validar_PLAN_ID();
        }

        return $validation;
    }

}
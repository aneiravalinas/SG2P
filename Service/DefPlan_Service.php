<?php

include_once './Model/DefPlan_Model.php';
include_once './Validation/DefPlan_Validation.php';

class DefPlan_Service extends DefPlan_Validation {
    var $atributos;
    var $defPlan_entity;
    var $feedback = array();

    function __construct() {
        $this->atributos = array('plan_id', 'nombre', 'descripcion');
        $this->defPlan_entity = new DefPlan_Model();
        $this->fill_fields();
    }

    function fill_fields() {
        foreach($this->atributos as $atributo) {
            if(isset($_POST[$atributo])) {
                $this->$atributo = $_POST[$atributo];
            } else {
                $this->$atributo = '';
            }
        }
    }

    function SEARCH() {
        $validation = $this->validar_atributos_search();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->defPlan_entity->SEARCH();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'DFPLAN_SEARCH_OK';
        } else {
            $this->feedback['ok'] = 'DFPLAN_SEARCH_KO';
        }

        return $this->feedback;
    }
}
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

    function ADD() {
        $validation = $this->validar_atributos();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->name_plan_not_exist();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $this->feedback = $this->defPlan_entity->ADD();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'DFPLAN_ADD_OK';
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'DFPLAN_ADD_KO';
        }

        return $this->feedback;
    }

    function seek() {
        $validation = $this->validar_PLAN_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        // TODO: make seekByPlanID.
    }

    function seekByPlanID() {
        $feedback = $this->defPlan_entity->seek();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'DFPLANID_NOT_EXST';
            } else {
                $feedback['code'] = 'DFPLANID_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'DFPLANID_KO';
        }

        return $feedback;
    }

    function name_plan_not_exist() {
        $feedback = $this->defPlan_entity->seekNamePlan();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['code'] = 'DFPLAN_NAM_NOT_EXST';
            } else {
                $feedback['ok'] = false;
                $feedback['code'] = 'DFPLAN_NAM_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'DFPLAN_NAM_KO';
        }

        return $feedback;
    }
}
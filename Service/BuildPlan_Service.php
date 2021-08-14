<?php

include_once './Validation/BuildPlan_Validation.php';
include_once './Model/BuildPlan_Model.php';
include_once './Model/DefPlan_Model.php';

class BuildPlan_Service extends BuildPlan_Validation {
    var $atributos;
    var $bldPlan_entity;
    var $defPlan_entity;
    var $feedback = array();

    function __construct() {
        $this->atributos = array('edificio_id','plan_id','fecha_asignacion','fecha_implementacion','estado');
        $this->bldPlan_entity = new BuildPlan_Model();
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
        $this->feedback = $this->seekPlan();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $plan = $this->feedback['resource'];

        $validation = $this->validar_atributos_search();
        if(!$validation['ok']) {
            $validation['plan'] = array('plan_id' => $plan['plan_id']);
            return $validation;
        }

        $this->feedback = $this->bldPlan_entity->SEARCH();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'BLDPLAN_SEARCH_OK';
            $this->feedback['plan'] = array('plan_id' => $plan['plan_id'], 'nombre' => $plan['nombre']);
        } else {
            $this->feedback['plan'] = array('plan_id' => $plan['plan_id']);
            if($this->feedback['code'] == 'QRY_KO') {
                $this->feedback['code'] = 'BLDPLAN_SEARCH_KO';
            }
        }

        return $this->feedback;
    }


    function seekPlan() {
        $validation = $this->validar_PLAN_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        return $this->seekByPlanID();
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
}

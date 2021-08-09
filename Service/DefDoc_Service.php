<?php

include_once './Model/DefDoc_Model.php';
include_once './Model/DefPlan_Model.php';
include_once './Validation/DefDoc_Validation.php';

class DefDoc_Service extends DefDoc_Validation {
    var $atributos;
    var $defDoc_entity;
    var $defPlan_entity;
    var $feedback = array();

    function __construct() {
        $this->atributos = array('documento_id', 'plan_id', 'nombre', 'descripcion', 'visible');
        $this->defDoc_entity = new DefDoc_Model();
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
        $validation = $this->validar_PLAN_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByPlanID();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $plan= $this->feedback['resource'];

        $validation = $this->validar_atributos_search();
        if(!$validation['ok']) {
            $validation['plan'] = array('plan_id' => $plan['plan_id']);
            return $validation;
        }

        $this->feedback = $this->defDoc_entity->SEARCH();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'DFDOC_SEARCH_OK';
            $this->feedback['plan'] = array('plan_id' => $plan['plan_id'], 'nombre' => $plan['nombre']);
        } else {
            $this->feedback['plan'] = array('plan_id' => $plan['plan_id']);
            if($this->feedback['code'] == 'QRY_KO') {
                $this->feedback['code'] = 'DFDOC_SEARCH_KO';
            }
        }

        return $this->feedback;
    }

    function emptyForm() {
        $validation = $this->validar_PLAN_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        return $this->seekByPlanID();
    }

    function ADD() {
        $validation = $this->validar_PLAN_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByPlanID();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $plan = $this->feedback['resource'];

        $validation = $this->validar_atributos();
        if(!$validation['ok']) {
            $validation['plan'] = array('plan_id' => $plan['plan_id']);
            return $validation;
        }

        $this->feedback = $this->name_doc_not_exist();
        if(!$this->feedback['ok']) {
            $this->feedback['plan'] = array('plan_id' => $plan['plan_id']);
            return $this->feedback;
        }

        $this->feedback = $this->defDoc_entity->ADD();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'DFDOC_ADD_OK';
            $this->feedback['plan'] = array('plan_id' => $plan['plan_id'], 'nombre' => $plan['nombre']);
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'DFDOC_ADD_KO';
            $this->feedback['plan'] = array('plan_id' => $plan['plan_id']);
        }

        return $this->feedback;
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

    function name_doc_not_exist() {
        $feedback = $this->defDoc_entity->seekByDocName();
        if($feedback['ok']) {
            if($feedback['code'] != 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'DFDOC_NAME_EXST';
            } else {
                $feedback['code'] = 'DFDOC_NAME_NOT_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'DFDOC_NAME_KO';
        }

        return $feedback;
    }

}
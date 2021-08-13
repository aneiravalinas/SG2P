<?php

include_once './Validation/DefSim_Validation.php';
include_once './Model/DefSim_Model.php';
include_once './Model/DefPlan_Model.php';

class DefSim_Service extends DefSim_Validation {
    var $atributos;
    var $defSim_entity;
    var $defPlan_entity;
    var $feedback = array();

    function __construct() {
        $this->atributos = array('simulacro_id','plan_id','nombre','descripcion');
        $this->defSim_entity = new DefSim_Model();
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

        $this->feedback = $this->defSim_entity->SEARCH();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'DFSIM_SEARCH_OK';
            $this->feedback['plan'] = array('plan_id' => $plan['plan_id'], 'nombre' => $plan['nombre']);
        } else {
            if($this->feedback['code'] == 'QRY_KO') {
                $this->feedback['code'] = 'DFSIM_SEARCH_KO';
            }
            $this->feedback['plan'] = array('plan_id' => $plan['plan_id']);
        }

        return $this->feedback;
    }

    function ADD() {
        $this->feedback = $this->seekPlan();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $plan = $this->feedback['resource'];
        $validation = $this->validar_atributos();
        if(!$validation['ok']) {
            $validation['plan'] = array('plan_id' => $plan['plan_id']);
            return $validation;
        }

        $this->feedback = $this->name_sim_not_exist();
        if(!$this->feedback['ok']) {
            $this->feedback['plan'] = array('plan_id' => $plan['plan_id']);
            return $this->feedback;
        }

        $this->feedback = $this->defSim_entity->ADD();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'DFSIM_ADD_OK';
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'DFSIM_ADD_KO';
        }

        $this->feedback['plan'] = array('plan_id' => $plan['plan_id']);
        return $this->feedback;
    }

    function DELETE() {
        $this->feedback = $this->seek();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $sim = $this->feedback['resource'];
        $this->feedback = $this->imp_sims_not_exist();
        if(!$this->feedback['ok']) {
            $this->feedback['plan'] = array('plan_id' => $sim['plan_id']);
            return $this->feedback;
        }

        $this->feedback = $this->defSim_entity->DELETE();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'DFSIM_DEL_OK';
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'DFSIM_DEL_KO';
        }

        $this->feedback['plan'] = array('plan_id' => $sim['plan_id']);
        return $this->feedback;
    }

    function EDIT() {
        $this->feedback = $this->seek();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $sim = $this->feedback['resource'];
        $validation = $this->validar_atributos();
        if(!$validation['ok']) {
            $validation['plan'] = array('plan_id' => $sim['plan_id']);
            return $validation;
        }

        if($this->nombre != $sim['nombre']) {
            $this->defSim_entity->plan_id = $sim['plan_id'];
            $this->feedback = $this->name_sim_not_exist();
            if(!$this->feedback['ok']) {
                $this->feedback['plan'] = array('plan_id' => $sim['plan_id']);
                return $this->feedback;
            }
        }

        $this->feedback = $this->defSim_entity->EDIT();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'DFSIM_EDT_OK';
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'DFSIM_EDT_KO';
        }

        $this->feedback['plan'] = array('plan_id' => $sim['plan_id']);
        return $this->feedback;
    }


    function seekPlan() {
        $validation = $this->validar_PLAN_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        return $this->seekByPlanID();
    }

    function seek() {
        $validation = $this->validar_SIMULACRO_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekBySimID();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'DFSIM_SEEK_OK';
        } else if($this->feedback['code'] == 'DFSIMID_KO') {
            $this->feedback['code'] = 'DFSIM_SEEK_KO';
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

    function seekBySimID() {
        $feedback = $this->defSim_entity->seek();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'DFSIMID_NOT_EXST';
            } else {
                $feedback['code'] = 'DFSIMID_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'DFSIMID_KO';
        }

        return $feedback;
    }

    function name_sim_not_exist() {
        $feedback = $this->defSim_entity->searchByName();
        if($feedback['ok']) {
            if($feedback['code'] != 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'DFSIM_NAME_EXST';
            } else {
                $feedback['code'] = 'DFSIM_NAME_NOT_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'DFSIM_NAME_KO';
        }

        return $feedback;
    }

    function imp_sims_not_exist() {
        include_once './Model/ImpSim_Model.php';
        $impSim_entity = new ImpSim_Model();
        $feedback = $impSim_entity->searchBySimID();
        if($feedback['ok']) {
            if($feedback['code'] != 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'DFSIM_IMPL_EXST';
            } else {
                $feedback['code'] = 'DFSIM_IMPL_NOT_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'DFSIM_IMPL_KO';
        }

        return $feedback;
    }
}
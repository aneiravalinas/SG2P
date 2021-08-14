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
        } else if($this->feedback['code'] == 'QRY_KO') {
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

    function DELETE() {
        $validation = $this->validar_PLAN_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByPlanID();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $this->feedback = $this->elements_assoc_not_exist();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $this->feedback = $this->defPlan_entity->DELETE();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'DFPLAN_DEL_OK';
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'DFPLAN_DEL_KO';
        }

        return $this->feedback;

    }

    function EDIT() {
        $validation = $this->validar_PLAN_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $validation = $this->validar_atributos();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByPlanID();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $plan = $this->feedback['resource'];
        if($plan['nombre'] != $this->nombre) {
            $this->feedback = $this->name_plan_not_exist();
            if(!$this->feedback['ok']) {
                return $this->feedback;
            }
        }

        $this->feedback = $this->defPlan_entity->EDIT();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'DFPLAN_EDT_OK';
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'DFPLAN_EDT_KO';
        }

        return $this->feedback;
    }


    function seek() {
        $validation = $this->validar_PLAN_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByPlanID();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'DFPLAN_SEEK_OK';
        } else if($this->feedback['code'] == 'DFPLANID_KO') {
            $this->feedback['code'] = 'DFPLAN_SEEK_KO';
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

    function name_plan_not_exist() {
        $feedback = $this->defPlan_entity->seekNamePlan();
        if($feedback['ok']) {
            if($feedback['code'] != 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'DFPLAN_NAM_EXST';
            } else {
                $feedback['code'] = 'DFPLAN_NAM_NOT_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'DFPLAN_NAM_KO';
        }

        return $feedback;
    }


    function elements_assoc_not_exist() {
        $feedback = $this->building_assoc_not_exist();
        if(!$feedback['ok']) {
            return $feedback;
        }

        $feedback = $this->docs_assoc_not_exist();
        if(!$feedback['ok']) {
            return $feedback;
        }

        $feedback = $this->procs_assoc_not_exist();
        if(!$feedback['ok']) {
            return $feedback;
        }

        $feedback = $this->routes_assoc_not_exist();
        if(!$feedback['ok']) {
            return $feedback;
        }

        $feedback = $this->formats_assoc_not_exist();
        if(!$feedback['ok']) {
            return $feedback;
        }

        return $this->sims_assoc_not_exist();

    }

    function building_assoc_not_exist() {
        include_once './Model/BuildPlan_Model.php';
        $build_plan_entity = new BuildPlan_Model();
        $feedback = $build_plan_entity->SEARCH();
        if($feedback['ok']) {
            if($feedback['code'] != 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'DFPLAN_BLD_EXST';
            } else {
                $feedback['code'] = 'DFPLAN_BLD_NOT_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'DFPLAN_BLD_KO';
        }

        return $feedback;
    }

    function docs_assoc_not_exist() {
        include_once './Model/DefDoc_Model.php';
        $defDoc_model = new DefDoc_Model();
        $feedback = $defDoc_model->searchByPlan();
        if($feedback['ok']) {
            if($feedback['code'] != 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'DFPLAN_DOC_EXST';
            } else {
                $feedback['code'] = 'DFPLAN_DOC_NOT_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'DFPLAN_DOC_KO';
        }

        return $feedback;
    }

    function procs_assoc_not_exist() {
        include_once './Model/DefProc_Model.php';
        $defProc_model = new DefProc_Model();
        $feedback = $defProc_model->searchByPlan();
        if($feedback['ok']) {
            if($feedback['code'] != 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'DFPLAN_PROC_EXST';
            } else {
                $feedback['code'] = 'DFPLAN_PROC_NOT_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'DFPLAN_PROC_KO';
        }

        return $feedback;
    }

    function routes_assoc_not_exist() {
        include_once './Model/DefRoute_Model.php';
        $defRoute_model = new DefRoute_Model();
        $feedback = $defRoute_model->searchByPlan();
        if($feedback['ok']) {
            if($feedback['code'] != 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'DFPLAN_ROUTE_EXST';
            } else {
                $feedback['code'] = 'DFPLAN_ROUTE_NOT_EXST';
            }
        } else {
            $feedback['code'] = 'DFPLAN_ROUTE_KO';
        }

        return $feedback;
    }

    function formats_assoc_not_exist() {
        include_once './Model/DefFormat_Model.php';
        $defFormat_model = new DefFormat_Model();
        $feedback = $defFormat_model->searchByPlan();
        if($feedback['ok']) {
            if($feedback['code'] != 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'DFPLAN_FRMT_EXST';
            } else {
                $feedback['code'] = 'DFPLAN_FRMT_NOT_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'DFPLAN_FRMT_KO';
        }

        return $feedback;
    }

    function sims_assoc_not_exist() {
        include_once './Model/DefSim_Model.php';
        $defSim_model = new DefSim_Model();
        $feedback = $defSim_model->searchByPlan();
        if($feedback['ok']) {
            if($feedback['code'] != 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'DFPLAN_SIM_EXST';
            } else {
                $feedback['code'] = 'DFPLAN_SIM_NOT_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'DFPLAN_SIM_KO';
        }

        return $feedback;
    }
}
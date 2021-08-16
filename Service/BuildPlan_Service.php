<?php

include_once './Validation/BuildPlan_Validation.php';
include_once './Model/BuildPlan_Model.php';
include_once './Model/DefPlan_Model.php';
include_once './Service/Uploader_Service.php';

class BuildPlan_Service extends BuildPlan_Validation {
    var $atributos;
    var $bldPlan_entity;
    var $defPlan_entity;
    var $uploader;
    var $feedback = array();

    function __construct() {
        $this->atributos = array('edificio_id','plan_id','fecha_asignacion','fecha_implementacion','estado');
        $this->bldPlan_entity = new BuildPlan_Model();
        $this->defPlan_entity = new DefPlan_Model();
        $this->uploader = new Uploader();
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

        if(isset($_POST['buildings'])) {
            $this->buildings = $_POST['buildings'];
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

    function addForm() {
        $this->feedback = $this->seekPlan();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $plan = $this->feedback['resource'];
        $this->feedback = $this->searchBuildingCandidates();
        if(!$this->feedback['ok']) {
            $this->feedback['plan'] = array('plan_id' => $plan['plan_id']);
            return $this->feedback;
        }

        $this->feedback['plan'] = array('plan_id' => $plan['plan_id'], 'nombre' => $plan['nombre']);
        return $this->feedback;
    }

    function multipleADD() {
        $this->feedback = $this->seekPlan();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $plan = $this->feedback['resource'];
        $validation = $this->validar_atributos_add();
        if(!$validation['ok']) {
            $validation['plan'] = array('plan_id' => $plan['plan_id']);
            return $validation;
        }

        $this->feedback = $this->uploader->dir_exist(plans_path . $plan['nombre']);
        if(!$this->feedback['ok']) {
            $this->feedback = $this->uploader->create_dir(plans_path, $plan['nombre']);
            if(!$this->feedback['ok']) {
                return $this->feedback;
            }

            $this->feedback = $this->ADD($this->buildings);
            if(!$this->feedback['ok']) {
                $this->uploader->delete(plans_path . $plan['nombre']);
                return $this->feedback;
            }
        }

        return $this->ADD($this->buildings);
    }

    function ADD($buildings) {
        if(empty($buildings)) {
            $feedback['ok'] = true;
            $feedback['code'] = 'BLDPLAN_ADD_OK';
            return $feedback;
        }


        $this->edificio_id = array_pop($buildings);
        $feedback = $this->seekByBuildingID();
        if(!$feedback['ok']) {
            return $feedback;
        }

        $edificio = $this->feedback['resource'];
        $this->bldPlan_entity->setADD($edificio['edificio_id'], date('Y-m-d'), default_data, 'pendiente');
        $this->feedback = $this->bldPlan_entity->ADD();
        if($this->feedback['ok']) {
            // TODO: Get Documents and Call function


        } else {
            if($this->feedback['code'] == 'QRY_KO') {
                $this->feedback['code'] = 'BLDPLAN_ADD_KO';
            }
            return $this->feedback;
        }
        
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

    function searchBuildingCandidates() {
        $feedback = $this->bldPlan_entity->searchBuildingsCandidates();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'BLDPLAN_CANDIDATES_EMPT';
            } else {
                $feedback['code'] = 'BLDPLAN_CANDIDATES_OK';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'BLDPLAN_CANDIDATES_KO';
        }

        return $feedback;
    }

    function seekByBuildingID() {
        include_once './Model/Building_Model.php';
        $building_entity = new Building_Model();
        $building_entity->edificio_id = $this->edificio_id;
        $feedback = $building_entity->seek();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'BLDID_NOT_EXST';
            } else {
                $feedback['code'] = 'BLDID_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'BLDID_KO';
        }

        return $feedback;
    }
}

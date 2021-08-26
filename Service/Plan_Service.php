<?php

include_once './Validation/Plan_Validation.php';
include_once './Model/BuildPlan_Model.php';

class Plan_Service extends Plan_Validation {
    var $atributos;
    var $bldPlan_entity;
    var $feedback = array();

    function __construct() {
        $this->atributos = array('edificio_id','plan_id','fecha_asignacion','fecha_cumplimentacion','estado','nombre_edificio','nombre_plan');
        $this->bldPlan_entity = new BuildPlan_Model();
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

        if(es_resp_edificio()) {
            $this->feedback = $this->bldPlan_entity->searchBuildPlansByResp(getUser());
        } else {
            $this->feedback = $this->bldPlan_entity->searchBuildPlans();
        }

        if($this->feedback['ok']) {
            $this->feedback['code'] = 'PLAN_SEARCH_OK';
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'PLAN_SEARCH_KO';
        }

        return $this->feedback;
    }

    function searchPortalPlans() {
        $validation = $this->validar_atributos_search_portal();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByBuildingID();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $building = $this->feedback['resource'];

        $this->feedback = $this->bldPlan_entity->searchPortalPlans();
        if($this->feedback['ok']) {
            $this->feedback['building'] = array('edificio_id' => $building['edificio_id'], 'nombre' => $building['nombre']);
            $this->feedback['code'] = 'PRTL_PLANS_SEARCH_OK';
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'PRTL_PLANS_SEARCH_KO';
        }

        return $this->feedback;
    }

    function seek() {
        $validation = $this->validar_atributos_seek();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByBuildingID();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $building = $this->feedback['resource'];
        if(es_resp_edificio() && (getUser() != $building['username'])) {
            $this->feedback['ok'] = false;
            $this->feedback['code'] = 'PLAN_SEEK_FRBD';
            unset($this->feedback['resource']);
            return $this->feedback;
        }

        $this->feedback = $this->seekByPlanID();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $plan = $this->feedback['resource'];

        $this->feedback = $this->seekBldPlan();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $bld_plan = $this->feedback['resource'];

        include_once './Service/CheckState_Service.php';
        $checkState_service = new CheckState_Service($bld_plan['edificio_id'], $bld_plan['plan_id']);
        $result = $checkState_service->checkStatePlan();
        if(!$result['ok']) {
            return $result;
        }


        $this->feedback['code'] = 'PLAN_SEEK_OK';
        $this->feedback['edificio'] = $building;
        $this->feedback['plan'] = $plan;
        $this->feedback['definiciones'] = array(
            'documentos' => $checkState_service->documentos,
            'procedimientos' => $checkState_service->procedimientos,
            'rutas' => $checkState_service->rutas,
            'formaciones' => $checkState_service->formaciones,
            'simulacros' => $checkState_service->simulacros
        );

        return $this->feedback;
    }

    function seekPortalPlan() {
        $validation = $this->validar_atributos_seek();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByBuildingID();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $building = $this->feedback['resource'];

        $this->feedback = $this->seekByPlanID();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $plan = $this->feedback['resource'];

        $this->feedback = $this->seekBldPlan();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $bld_plan = $this->feedback['resource'];

        include_once './Service/CheckState_Service.php';
        $checkState_service = new CheckState_Service($bld_plan['edificio_id'], $bld_plan['plan_id']);
        $result = $checkState_service->checkStatePlan();
        if(!$result['ok']) {
            return $result;
        }

        $this->feedback['code'] = 'PLAN_SEEK_OK';
        $this->feedback['edificio'] = $building;
        $this->feedback['plan'] = $plan;
        $this->feedback['definiciones'] = array(
            'documentos' => $this->clear_not_visible_or_expired($checkState_service->documentos),
            'procedimientos' => $this->clear_not_visible_or_expired($checkState_service->procedimientos),
            'rutas' => $this->clear_not_visible_or_expired($checkState_service->rutas),
            'formaciones' => $this->clear_not_visible_or_expired($checkState_service->formaciones),
            'simulacros' => $this->clear_not_visible_or_expired($checkState_service->simulacros)
        );

        return $this->feedback;
    }

    function clear_not_visible_or_expired($elements) {
        foreach($elements['elementos'] as $key => $element) {
            if((isset($element['visible']) && $element['visible'] == 'no') || $element['estado'] == 'vencido') {
                unset($elements[$key]);
            }
        }

        return $elements;
    }


    function seekByBuildingID() {
        include_once './Model/Building_Model.php';
        $building_entity = new Building_Model();
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

    function seekByPlanID() {
        include_once './Model/DefPlan_Model.php';
        $defPlan_entity = new DefPlan_Model();
        $feedback = $defPlan_entity->seek();
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

    function seekBldPlan() {
        $feedback = $this->bldPlan_entity->seek();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'BLDPLAN_NOT_EXST';
            } else {
                $feedback['code'] = 'BLDPLAN_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'BLDPLAN_KO';
        }

        return $feedback;
    }

}
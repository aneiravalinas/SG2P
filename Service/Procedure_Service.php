<?php

include_once './Validation/Procedure_Validation.php';
include_once './Model/DefProc_Model.php';
include_once './Model/ImpProc_Model.php';

class Procedure_Service extends Procedure_Validation {
    var $atributos;
    var $defProc_entity;
    var $impProc_entity;
    var $feedback = array();

    function __construct() {
        date_default_timezone_set("Europe/Madrid");
        $this->atributos = array('edificio_procedimiento_id','edificio_id','procedimiento_id','estado','fecha_cumplimentacion','nombre_doc', 'nombre_edificio');
        $this->defProc_entity = new DefProc_Model();
        $this->impProc_entity = new ImpProc_Model();
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
        } else {
            $this->buildings = array();
        }

        if(isset($_FILES['nombre_doc']['name'])) {
            $this->nombre_doc = $_FILES['nombre_doc']['name'];
        }
    }

    function searchImpProcs() {
        $this->feedback = $this->seekProcedure();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $proc = $this->feedback['resource'];
        $validation = $this->validar_atributos_search_implements();
        if(!$validation['ok']) {
            $validation['procedure'] = array('procedimiento_id' => $proc['procedimiento_id']);
            return $validation;
        }

        $this->feedback = $this->impProc_entity->SEARCH();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'IMPPROC_SEARCH_OK';
            $this->feedback['procedure'] = $proc;
        } else {
            $this->feedback['procedure'] = array('procedimiento_id' => $proc['procedimiento_id']);
            if($this->feedback['code'] == 'QRY_KO') {
                $this->feedback['code'] = 'IMPPROC_SEARCH_KO';
            }
        }

        return $this->feedback;
    }

    function searchProcedure() {
        $this->feedback = $this->searchProcAndBuilding();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $procedure = $this->feedback['procedure'];
        $building = $this->feedback['building'];
        if(es_resp_edificio() && $building['username'] != getUser()) {
            $this->feedback['ok'] = false;
            $this->feedback['code'] = 'BLD_FRBD';
            unset($this->feedback['resource'], $this->feedback['document'], $this->feedback['building']);
            return $this->feedback;
        }

        $validation = $this->validar_atributos_search();
        if(!$validation['ok']) {
            $validation['return'] = array('procedimiento_id' => $procedure['procedimiento_id'], 'edificio_id' => $building['edificio_id']);
            return $validation;
        }

        $proc_state = $this->get_procedure_state();
        if(!$proc_state['ok']) {
            $proc_state['return'] = array('procedimiento_id' => $procedure['procedimiento_id'], 'edificio_id' => $building['edificio_id']);
            return $proc_state;
        }

        $procedure['estado'] = $proc_state['estado'];
        $this->feedback = $this->impProc_entity->searchImpProcs();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'IMPPROC_SEARCH_OK';
            $this->feedback['procedure'] = $procedure;
            $this->feedback['building'] = $building;
        } else {
            $this->feedback['return'] = array('procedimiento_id' => $procedure['procedimiento_id'], 'edificio_id' => $building['edificio_id']);
            if($this->feedback['code'] == 'QRY_KO') {
                $this->feedback['code'] = 'IMPPROC_SEARCH_KO';
            }
        }

        return $this->feedback;
    }

    function seekProcedure() {
        $validation = $this->validar_PROCEDIMIENTO_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        return $this->seekByProcID();
    }


    function seekByProcID() {
        $feedback = $this->defProc_entity->seek();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'DFPROCID_NOT_EXST';
            } else {
                $feedback['code'] = 'DFPROCID_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'DFPROCID_KO';
        }

        return $feedback;
    }

    function searchProcAndBuilding() {
        $validation = $this->validar_proc_and_building();
        if(!$validation['ok']) {
            return $validation;
        }

        $feedback = $this->seekByProcID();
        if(!$feedback['ok']) {
            return $feedback;
        }

        $procedure = $feedback['resource'];
        $feedback = $this->seekByBuildingID();
        if(!$feedback['ok']) {
            return $feedback;
        }

        $building = $feedback['resource'];
        $feedback = $this->seekPlanBuilding($procedure['plan_id']);
        if(!$feedback['ok']) {
            return $feedback;
        }

        $feedback['procedure'] = $procedure;
        $feedback['building'] = $building;
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

    function seekPlanBuilding($plan_id) {
        include_once './Model/BuildPlan_Model.php';
        $buildPlan_entity = new BuildPlan_Model();
        $buildPlan_entity->setAttributes(array('plan_id' => $plan_id, 'edificio_id' => $this->edificio_id));
        $feedback = $buildPlan_entity->seek();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'BLDPROC_NOT_EXST';
            } else {
                $feedback['code'] = 'BLDPROC_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'BLDPROC_KO';
        }

        return $feedback;
    }

    function get_procedure_state() {
        $feedback = $this->search_all_impprocs();
        if(!$feedback['ok']) {
            return $feedback;
        }

        include_once './Service/CheckState_Service.php';
        $checkState_service = new CheckState_Service();
        $estado = $checkState_service->check_state($feedback['resource']);
        return array('ok' => true, 'estado' => $estado);
    }

    function search_all_impprocs() {
        $feedback = $this->impProc_entity->searchProcsBuildings();
        if($feedback['ok']) {
            $feedback['code'] = 'BLDPROCS_SEARCH_OK';
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'BLDPROCS_SEARCH_KO';
        }

        return $feedback;
    }
}
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
        $this->feedback = $this->searchDocsByPlan();
        if(!$this->feedback['ok']) {
            if($this->feedback['code'] == 'DFPLAN_DOC_NOT_EXST') {
                $this->feedback['code'] = 'DFPLAN_ADD_NOT_DOCS';
            }
            $this->feedback['plan'] = array('plan_id' => $plan['plan_id']);
            return $this->feedback;
        }

        $docs = $this->feedback['resource'];
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

            $this->feedback = $this->ADD($this->buildings, $docs, plans_path . $plan['nombre']);
            if(!$this->feedback['ok']) {
                $this->uploader->delete(plans_path . $plan['nombre']);
                return $this->feedback;
            }
        }

        return $this->ADD($this->buildings, $docs, plans_path . $plan['nombre']);
    }

    function ADD($buildings, $docs, $path) {
        if(empty($buildings)) {
            $feedback['ok'] = true;
            $feedback['code'] = 'BLDPLAN_ADD_OK';
            return $feedback;
        }


        $edificio_id = array_pop($buildings);
        $this->feedback = $this->seekByBuildingID($edificio_id);
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $this->feedback = $this->uploader->create_dir($path . '/', $edificio_id);
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $this->bldPlan_entity->setADD($edificio_id, date('Y-m-d'), default_data, 'pendiente');
        $this->feedback = $this->bldPlan_entity->ADD();
        if($this->feedback['ok']) {
            $this->feedback = $this->create_impDocs($edificio_id, $docs, $path . '/' . $edificio_id);
            if($this->feedback['ok']) {
                $this->feedback = $this->ADD($buildings, $docs, $path);
                if($this->feedback['ok']) {
                    return $this->feedback;
                }
                // TODO: Delete All implementations
            }

            $this->bldPlan_entity->edificio_id = $edificio_id;
            $this->bldPlan_entity->DELETE();
        } else {
            if($this->feedback['code'] == 'QRY_KO') {
                $this->feedback['code'] = 'BLDPLAN_ADD_KO';
            }
        }

        $this->uploader->delete_all($path . '/' . $edificio_id);
        return $this->feedback;
    }

    function create_impDocs($edificio_id, $docs, $path) {
        if(empty($docs)) {
            $feedback = $this->searchProcsByPlan();
            if($feedback['ok'] || $feedback['code'] == 'DFPLAN_PROC_NOT_EXST') {
                return $this->create_impProcs($edificio_id, $feedback['resource'], $path);
            }

            return $feedback;
        }

        $doc = array_pop($docs);
        $feedback = $this->uploader->create_dir($path . '/', $doc['nombre']);
        if(!$feedback['ok']) {
            return $feedback;
        }

        include_once './Model/ImpDoc_Model.php';
        $impDoc_entity = new ImpDoc_Model();
        $impDoc_entity->setAttributes(array('edificio_id' => $edificio_id, 'documento_id' => $doc['documento_id'],
                                            'estado' => 'pendiente','fecha_implementacion' => default_data, 'nombre_doc' => default_doc));
        $feedback = $impDoc_entity->ADD();
        if($feedback['ok']) {
            $feedback = $this->create_impdocs($edificio_id, $docs, $path);
            if($feedback['ok']) {
                return $feedback;
            }
            $impDoc_entity->DELETE();
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'IMPDOC_ADD_KO';
        }

        return $feedback;
    }

    function create_impProcs($edificio_id, $procs, $path) {
        if(empty($procs)) {
            $feedbackRoutes = $this->searchRoutesByPlan();
            if($feedbackRoutes['ok'] || $feedbackRoutes['code'] == 'DFPLAN_ROUTE_NOT_EXST') {
                $feedbackFloors = $this->searchFloorsByBuilding($edificio_id);
                if($feedbackRoutes['ok'] && $feedbackFloors['code'] == 'BLD_FLR_NOT_EXST') {
                    $feedback['ok'] = false;
                    $feedback['code'] = 'DFROUTE_EXST_FLRS_NOT_EXST';
                    return $feedback;
                } else if(!$feedbackFloors['ok'] && $feedbackFloors['code'] != 'BLD_FLR_NOT_EXST') {
                    return $feedbackFloors;
                }
                return $this->create_impRoutes($edificio_id, $feedbackRoutes['resource'], $feedbackFloors['resource'], $path);
            }

            return $feedbackRoutes;
        }

        $proc = array_pop($procs);
        $feedback = $this->uploader->create_dir($path . '/', $proc['nombre']);
        if(!$feedback['ok']) {
            return $feedback;
        }

        include_once './Model/ImpProc_Model.php';
        $impProc_entity = new ImpProc_Model();
        $impProc_entity->setAttributes(array('edificio_id' => $edificio_id, 'procedimiento_id' => $proc['procedimiento_id'],
                                                'estado' => 'pendiente', 'fecha_implementacion' => default_data, 'nombre_doc' => default_doc));
        $feedback = $impProc_entity->ADD();
        if($feedback['ok']) {
            $feedback = $this->create_impProcs($edificio_id, $procs, $path);
            if($feedback['ok']) {
                return $feedback;
            }
            $impProc_entity->DELETE();
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'IMPPROC_ADD_KO';
        }

        return $feedback;

    }

    function create_impRoutes($edificio_id, $routes, $floors, $path) {
        if(empty($routes)) {
            $feedback = $this->searchFormatsByPlan();
            if($feedback['ok'] || $feedback['code'] == 'DFPLAN_FRMT_NOT_EXST') {
                return $this->create_impFormat($edificio_id, $feedback['resource']);
            }
            return $feedback;
        }

        $route = array_pop($routes);
        $floors_with_routes = array();
        include_once './Model/ImpRoute_Model.php';
        $impRoute_entity = new ImpRoute_Model();
        foreach($floors as $floor) {
            $feedback = $this->uploader->create_dir($path . '/' . $route['nombre'] . '/', $floor['nombre']);
            if(!$feedback['ok']) break;
            $impRoute_entity->setAttributes(array('planta_id' => $floor['planta_id'], 'ruta_id' => $route['ruta_id'],
                                                'estado' => 'pendiente', 'fecha_implementacion' => default_data, 'nombre_doc' => default_doc));
            $feedback = $impRoute_entity->ADD();
            if(!$feedback['ok']) break;
            array_push($floors_with_routes, $floor['planta_id']);
        }

        if(sizeof($floors_with_routes) == sizeof($floors)) {
            $feedback = $this->create_impRoutes($edificio_id, $routes, $floors, $path);
            if($feedback['ok']) {
                return $feedback;
            }
        }

        foreach($floors_with_routes as $floor) {
            $impRoute_entity->setAttributes(array('planta_id' => $floor['planta_id'], 'ruta_id' => $route['ruta_id']));
            $impRoute_entity->DELETE();
        }

        return $feedback;

    }

    function create_impFormat($edificio_id, $formations) {
        if(empty($formations)) {
            $feedback = $this->searchSimsByPlan();
            if($feedback['ok'] || $feedback['code'] == 'DFPLAN_SIM_NOT_EXST') {
                return $this->create_impSims($edificio_id, $feedback['resource']);
            }
            return $feedback;
        }

        
    }

    function create_impSims($edificio_id, $simulacrums) {

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

    function seekByBuildingID($edificio_id) {
        include_once './Model/Building_Model.php';
        $building_entity = new Building_Model();
        $building_entity->edificio_id = $edificio_id;
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

    function searchDocsByPlan() {
        include_once './Model/DefDoc_Model.php';
        $defDoc_model = new DefDoc_Model();
        $feedback = $defDoc_model->searchByPlan();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'DFPLAN_DOC_NOT_EXST';
            } else {
                $feedback['code'] = 'DFPLAN_DOC_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'DFPLAN_DOC_KO';
        }

        return $feedback;
    }

    function searchProcsByPlan() {
        include_once './Model/DefProc_Model.php';
        $defProc_model = new DefProc_Model();
        $feedback = $defProc_model->searchByPlan();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'DFPLAN_PROC_NOT_EXST';
            } else {
                $feedback['code'] = 'DFPLAN_PROC_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'DFPLAN_PROC_KO';
        }

        return $feedback;
    }

    function searchRoutesByPlan() {
        include_once './Model/DefRoute_Model.php';
        $defRoute_model = new DefRoute_Model();
        $feedback = $defRoute_model->searchByPlan();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'DFPLAN_ROUTE_NOT_EXST';
            } else {
                $feedback['code'] = 'DFPLAN_ROUTE_EXST';
            }
        } else {
            $feedback['code'] = 'DFPLAN_ROUTE_KO';
        }

        return $feedback;
    }

    function searchFormatsByPlan() {
        include_once './Model/DefFormat_Model.php';
        $defFormat_model = new DefFormat_Model();
        $feedback = $defFormat_model->searchByPlan();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'DFPLAN_FRMT_NOT_EXST';
            } else {
                $feedback['code'] = 'DFPLAN_FRMT_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'DFPLAN_FRMT_KO';
        }

        return $feedback;
    }

    function searchSimsByPlan() {
        include_once './Model/DefSim_Model.php';
        $defSim_model = new DefSim_Model();
        $feedback = $defSim_model->searchByPlan();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'DFPLAN_SIM_NOT_EXST';
            } else {
                $feedback['code'] = 'DFPLAN_SIM_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'DFPLAN_SIM_KO';
        }

        return $feedback;
    }

    function searchFloorsByBuilding($edificio_id) {
        include_once './Model/Floor_Model.php';
        $floor_entity = new Floor_Model();
        $floor_entity->edificio_id = $edificio_id;
        $feedback = $floor_entity->searchByBuildingID();

        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'BLD_FLR_NOT_EXST';
            } else {
                $feedback['code'] = 'BLD_FLR_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'BLD_SRCH_FLR_KO';
        }

        return $feedback;
    }
}

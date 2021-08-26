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
    var $build_plans = array();
    const msg_notification_add = 'Se ha asignado un nuevo plan';

    function __construct() {
        $this->atributos = array('edificio_id','plan_id','fecha_asignacion','fecha_cumplimentacion','estado','nombre_edificio');
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

    function EDIT() {
        $this->feedback = $this->seek();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $bld_plan = $this->feedback['resource'];
        if($bld_plan['estado'] == 'vencido') {
            $feedback['ok'] = false;
            $feedback['code'] = 'BLDPLAN_ALREADY_EXPIRED';
            return $feedback;
        }

        $this->build_plans = array($bld_plan);
        $this->feedback = $this->expire_assignments();
        $this->feedback['plan'] = array('plan_id' => $bld_plan['plan_id']);

        return $this->feedback;
    }

    function expireAll() {
        $this->feedback = $this->seekPlan();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $plan = $this->feedback['resource'];
        $this->feedback = $this->searchActiveAssignmentsByPlan();
        if(!$this->feedback['ok']) {
            $this->feedback['plan'] = array('plan_id' => $plan['plan_id']);
            return $this->feedback;
        }

        foreach($this->feedback['resource'] as $build_plan) {
            array_push($this->build_plans, $build_plan);
        }
        $this->feedback = $this->expire_assignments();
        $this->feedback['plan'] = array('plan_id' => $plan['plan_id']);
        return $this->feedback;
    }

    function expire_assignments() {
        if(empty($this->build_plans)) {
            $feedback['ok'] = true;
            $feedback['code'] = 'BLDPLAN_EDTSTATE_OK';
            return $feedback;
        }

        $bld_plan = array_pop($this->build_plans);
        $this->bldPlan_entity->setAttributes($bld_plan);
        $this->bldPlan_entity->estado = 'vencido';
        $feedback = $this->bldPlan_entity->EDIT();

        if($feedback['ok']) {
            $feedback = $this->searchDocsByPlan();
            if($feedback['ok'] || $feedback['code'] == 'DFPLAN_DOC_NOT_EXST') {
                $feedback = $this->expire_documents($bld_plan['edificio_id'], $feedback['resource']);
                if($feedback['ok']) {
                    return $feedback;
                }
            }

            $this->bldPlan_entity->setAttributes($bld_plan);
            $this->bldPlan_entity->EDIT();
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'BLDPLAN_EDTSTATE_KO';
        }

        return $feedback;
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
        $validation = $this->validar_BUILDINGS();
        if(!$validation['ok']) {
            $validation['plan'] = array('plan_id' => $plan['plan_id']);
            return $validation;
        }

        $this->feedback = $this->uploader->dir_exist(plans_path . $plan['plan_id']);
        if(!$this->feedback['ok']) {
            $this->feedback = $this->uploader->create_dir(plans_path, $plan['plan_id']);
            if(!$this->feedback['ok']) {
                $this->feedback['plan'] = array('plan_id' => $plan['plan_id']);
                $this->feedback['code'] = 'BLDPLAN_DIRPLAN_KO';
                return $this->feedback;
            }

            $this->feedback = $this->ADD($this->buildings, $docs, plans_path . $plan['plan_id']);
            if(!$this->feedback['ok']) {
                $this->uploader->delete(plans_path . $plan['plan_id']);
            }
        } else {
            $this->feedback = $this->ADD($this->buildings, $docs, plans_path . $plan['plan_id']);
        }

        $this->feedback['plan'] = array('plan_id' => $plan['plan_id']);
        return $this->feedback;
    }

    function ADD($buildings, $docs, $path) {
        if(empty($buildings)) {
            $this->feedback['ok'] = true;
            $this->feedback['code'] = 'BLDPLAN_ADD_OK';
            return $this->feedback;
        }


        $edificio_id = array_pop($buildings);
        $this->feedback = $this->seekByBuildingID($edificio_id);
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $building = $this->feedback['resource'];
        $this->feedback = $this->bldPlan_not_exist($edificio_id);
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $this->feedback = $this->uploader->create_dir($path . '/', $edificio_id);
        if(!$this->feedback['ok']) {
            $this->feedback['code'] = 'BLDPLAN_DIRBLD_KO';
            return $this->feedback;
        }

        $this->bldPlan_entity->setAttributes(array('edificio_id' => $edificio_id, 'fecha_asignacion' => date('Y-m-d'),
                                                'fecha_cumplimentacion' => default_data, 'estado' => 'pendiente'));
        $this->feedback = $this->bldPlan_entity->ADD();
        if($this->feedback['ok']) {
            $this->feedback = $this->create_impDocs($edificio_id, $docs, $path . '/' . $edificio_id);
            if($this->feedback['ok']) {
                $this->feedback = $this->ADD($buildings, $docs, $path);
                if($this->feedback['ok']) {
                    include_once './Model/Notification_Model.php';
                    $notification_entity = new Notification_Model();
                    $notification_entity->setAttributes(array('username' => $building['username'], 'plan_id' => $this->plan_id,
                                                            'edificio_id' => $edificio_id, 'mensaje' => self::msg_notification_add));
                    $notification_entity->ADD();
                    return $this->feedback;
                }
                $this->delete_impDocs($edificio_id, $docs);
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

    function DELETE() {
        $this->feedback = $this->seek();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $bld_plan = $this->feedback['resource'];
        $plan = $this->feedback['plan'];
        $building = $this->feedback['edificio'];

        $this->feedback = $this->bldPlan_entity->DELETE();
        if($this->feedback['ok']) {
            $this->feedback = $this->searchDocsByPlan();
            if($this->feedback['ok']) {
                $docs = $this->feedback['resource'];
                $this->feedback = $this->delete_impDocs($building['edificio_id'], $docs);
                if($this->feedback['ok']) {
                    $this->uploader->delete_all(plans_path . $plan['plan_id'] . '/' . $building['edificio_id']);
                    $this->feedback = $this->uploader->dir_is_empty(plans_path . $plan['plan_id']);
                    if($this->feedback['ok']) {
                        $this->uploader->delete(plans_path . $plan['plan_id']);
                    }
                    $this->feedback['code'] = 'BLDPLAN_DEL_OK';
                    $this->feedback['plan'] = $plan;
                    $this->feedback['edificio'] = $building;
                    return $this->feedback;
                }
            }
            $this->bldPlan_entity->setAttributes($bld_plan);
            $this->bldPlan_entity->ADD();
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'BLDPLAN_DEL_KO';
        }

        $this->feedback['plan'] = $plan;
        return $this->feedback;
    }

    function seek() {
        $this->feedback = $this->seekPlan();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $plan = $this->feedback['resource'];
        $validation = $this->validar_EDIFICIO_ID();
        if(!$validation['ok']) {
            $validation['plan'] = array('plan_id' => $plan['plan_id']);
            return $validation;
        }

        $this->feedback = $this->seekByBuildingID($this->edificio_id);
        if(!$this->feedback['ok']) {
            $this->feedback['plan'] = array('plan_id' => $plan['plan_id']);
            return $this->feedback;
        }

        $building = $this->feedback['resource'];
        $this->feedback = $this->seekBldPlan();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'BLDPLAN_SEEK_OK';
            $this->feedback['plan'] = array('plan_id' => $plan['plan_id'], 'nombre' => $plan['nombre']);
            $this->feedback['edificio'] = array('edificio_id' => $building['edificio_id'], 'nombre' => $building['nombre']);
        } else if($this->feedback['code'] == 'BLDPLAN_KO') {
            $this->feedback['plan'] = array('plan_id' => $plan['plan_id']);
            $this->feedback['code'] = 'BLDPLAN_SEEK_KO';
        }

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
        $feedback = $this->uploader->create_dir($path . '/Documentos/', $doc['documento_id']);
        if(!$feedback['ok']) {
            $feedback['code'] = 'BLDPLAN_DIRDOC_KO';
            return $feedback;
        }

        include_once './Model/ImpDoc_Model.php';
        $impDoc_entity = new ImpDoc_Model();
        $impDoc_entity->setAttributes(array('edificio_id' => $edificio_id, 'documento_id' => $doc['documento_id'],
                                            'estado' => 'pendiente', 'fecha_cumplimentacion' => default_data, 'nombre_doc' => default_doc));
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

    function delete_impDocs($edificio_id, $docs) {
        if(empty($docs)) {
            $feedback = $this->searchProcsByPlan();
            if($feedback['ok'] || $feedback['code'] == 'DFPLAN_PROC_NOT_EXST') {
                return $this->delete_impProcs($edificio_id, $feedback['resource']);
            }
            return $feedback;
        }

        $doc = array_pop($docs);
        $feedback = $this->searchImpDocs($edificio_id, $doc['documento_id']);
        if($feedback['ok']) {
            if($feedback['code'] == 'BLDPLAN_IMPDOCS_EMPT') {
                return $this->delete_impDocs($edificio_id, $docs);
            }

            $imp_docs = $feedback['resource'];
            $imps_deleted = array();
            include_once './Model/ImpDoc_Model.php';
            $impDoc_entity = new ImpDoc_Model();
            foreach($imp_docs as $imp_doc) {
                $impDoc_entity->setAttributes($imp_doc);
                $feedback = $impDoc_entity->DELETE();
                if(!$feedback['ok']) {
                    if($feedback['code'] == 'QRY_KO') {
                        $feedback['code'] = 'IMPDOC_DEL_KO';
                    }
                    break;
                }
                array_push($imps_deleted, $imp_doc);
            }

            if($feedback['ok']) {
                $feedback = $this->delete_impDocs($edificio_id, $docs);
                if($feedback['ok']) {
                    return $feedback;
                }
            }

            foreach($imps_deleted as $imp_deleted) {
                $impDoc_entity->setAttributes($imp_deleted);
                $impDoc_entity->ADD();
            }
        }

        return $feedback;
    }

    function expire_documents($edificio_id,$docs) {
        if(empty($docs)) {
            $feedback = $this->searchProcsByPlan();
            if($feedback['ok'] || $feedback['code'] = 'DFPLAN_PROCS_NOT_EXST') {
                return $this->expire_procedures($edificio_id, $feedback['resource']);
            }
            return $feedback;
        }

        $doc = array_pop($docs);
        $feedback = $this->searchImpDocs($edificio_id, $doc['documento_id']);
        if(!$feedback['ok']) return $feedback;
        if($feedback['code'] == 'BLDPLAN_IMPDOCS_EMPT') return $this->expire_documents($edificio_id,$docs);

        $imp_docs = $feedback['resource'];
        $docs_edited = array();
        include_once './Model/ImpDoc_Model.php';
        $impDoc_entity = new ImpDoc_Model();

        foreach($imp_docs as $imp_doc) {
            if($imp_doc['estado'] == 'vencido') continue;
            $impDoc_entity->setAttributes($imp_doc);
            $impDoc_entity->estado = "vencido";
            $feedback = $impDoc_entity->EDIT();
            if(!$feedback['ok']) {
                if($feedback['code'] == 'QRY_KO') {
                    $feedback['code'] = 'IMPDOC_EDTSTATE_KO';
                }
                break;
            }
            array_push($docs_edited, $imp_doc);
        }

        if($feedback['ok']) {
            $feedback = $this->expire_documents($edificio_id, $docs);
            if($feedback['ok']) return $feedback;
        }

        foreach($docs_edited as $doc_edited) {
            $impDoc_entity->setAttributes($doc_edited);
            $impDoc_entity->EDIT();
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
        $feedback = $this->uploader->create_dir($path . '/Procedimientos/', $proc['procedimiento_id']);
        if(!$feedback['ok']) {
            $feedback['code'] = 'BLDPLAN_DIRPROC_KO';
            return $feedback;
        }

        include_once './Model/ImpProc_Model.php';
        $impProc_entity = new ImpProc_Model();
        $impProc_entity->setAttributes(array('edificio_id' => $edificio_id, 'procedimiento_id' => $proc['procedimiento_id'],
                                                'estado' => 'pendiente', 'fecha_cumplimentacion' => default_data, 'nombre_doc' => default_doc));
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

    function delete_impProcs($edificio_id, $procs) {
        if(empty($procs)) {
            $feedbackRoutes = $this->searchRoutesByPlan();
            if($feedbackRoutes['ok'] || $feedbackRoutes['code'] == 'DFPLAN_ROUTE_NOT_EXST') {
                $feedbackFloors = $this->searchFloorsByBuilding($edificio_id);
                if($feedbackFloors['ok'] || $feedbackFloors['code'] == 'BLD_FLR_NOT_EXST') {
                    return $this->delete_impRoutes($edificio_id, $feedbackRoutes['resource'], $feedbackFloors['resource']);
                } else {
                    return $feedbackFloors;
                }

            }

            return $feedbackRoutes;
        }

        $proc = array_pop($procs);
        $feedback = $this->searchImpProcs($edificio_id, $proc['procedimiento_id']);
        if($feedback['ok']) {
            $imp_procs = $feedback['resource'];
            $imps_deleted = array();
            include_once './Model/ImpProc_Model.php';
            $impProc_entity = new ImpProc_Model();

            foreach($imp_procs as $imp_proc) {
                $impProc_entity->setAttributes($imp_proc);
                $feedback = $impProc_entity->DELETE();
                if(!$feedback['ok']) {
                    if($feedback['code'] == 'QRY_KO') {
                        $feedback['code'] = 'IMPPROC_DEL_KO';
                    }
                    break;
                }
                array_push($imps_deleted, $imp_proc);
            }

            if($feedback['ok']) {
                $feedback = $this->delete_impProcs($edificio_id, $procs);
                if($feedback['ok']) {
                    return $feedback;
                }
            }

            foreach($imp_procs as $imp_proc) {
                $impProc_entity->setAttributes($imp_proc);
                $impProc_entity->ADD();
            }
        }

        return $feedback;
    }

    function expire_procedures($edificio_id, $procs) {
        if(empty($procs)) {
            $feedbackRoutes = $this->searchRoutesByPlan();
            if($feedbackRoutes['ok'] || $feedbackRoutes['code'] == 'DFPLAN_ROUTE_NOT_EXST') {
                $feedbackFloors = $this->searchFloorsByBuilding($edificio_id);
                if($feedbackFloors['ok'] || $feedbackFloors['code'] == 'BLD_FLR_NOT_EXST') {
                    return $this->expire_routes($edificio_id, $feedbackRoutes['resource'], $feedbackFloors['resource']);
                } else {
                    return $feedbackFloors;
                }

            }

            return $feedbackRoutes;
        }

        $proc = array_pop($procs);
        $feedback = $this->searchImpProcs($edificio_id, $proc['procedimiento_id']);
        if(!$feedback['ok']) return $feedback;
        if($feedback['code'] == 'BLDPLAN_IMPPROCS_EMPT') return $this->expire_procedures($edificio_id, $procs);

        $imp_procs = $feedback['resource'];
        $procs_edited = array();
        include_once './Model/ImpProc_Model.php';
        $impProc_entity = new ImpProc_Model();

        foreach($imp_procs as $imp_proc) {
            if($imp_proc['estado'] == 'vencido') continue;
            $impProc_entity->setAttributes($imp_proc);
            $impProc_entity->estado = 'vencido';
            $feedback = $impProc_entity->EDIT();
            if(!$feedback['ok']) {
                if($feedback['code'] == 'QRY_KO') $feedback['code'] = 'IMPPROC_EDTSTATE_KO';
                break;
            }
            array_push($procs_edited, $imp_proc);
        }

        if($feedback['ok']) {
            $feedback = $this->expire_procedures($edificio_id, $procs);
            if($feedback['ok']) return $feedback;
        }

        foreach($procs_edited as $proc_edited) {
            $impProc_entity->setAttributes($proc_edited);
            $impProc_entity->EDIT();
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
        $feedback['ok'] = true;
        foreach($floors as $floor) {
            $feedback = $this->uploader->create_dir($path . '/Rutas/' . $route['ruta_id'] . '/', $floor['planta_id']);
            if(!$feedback['ok']) {
                $feedback['code'] = 'BLDPLAN_DIRROUTE_KO';
                break;
            }
            $impRoute_entity->setAttributes(array('planta_id' => $floor['planta_id'], 'ruta_id' => $route['ruta_id'],
                                                'estado' => 'pendiente', 'fecha_cumplimentacion' => default_data, 'nombre_doc' => default_doc));
            $feedback = $impRoute_entity->ADD();
            if(!$feedback['ok']) {
                if($feedback['code'] == 'QRY_KO') {
                    $feedback['code'] = 'IMPROUTE_ADD_KO';
                }
                break;
            }
            array_push($floors_with_routes, $impRoute_entity->planta_ruta_id);
        }

        if($feedback['ok']) {
            $feedback = $this->create_impRoutes($edificio_id, $routes, $floors, $path);
            if($feedback['ok']) {
                return $feedback;
            }
        }

        foreach($floors_with_routes as $floor_route) {
            $impRoute_entity->planta_ruta_id = $floor_route;
            $impRoute_entity->DELETE();
        }

        return $feedback;

    }

    function delete_impRoutes($edificio_id, $routes, $floors) {
        if(empty($routes)) {
            $feedback = $this->searchFormatsByPlan();
            if($feedback['ok'] || $feedback['code'] == 'DFPLAN_FRMT_NOT_EXST') {
                return $this->delete_impFormats($edificio_id, $feedback['resource']);
            }
            return $feedback;
        }

        $route = array_pop($routes);
        $imps_deleted = array();
        include_once './Model/ImpRoute_Model.php';
        $impRoute_entity = new ImpRoute_Model();
        $feedback['ok'] = true;
        foreach($floors as $floor) {
            $feedback = $this->searchImpRoutes($floor['planta_id'], $route['ruta_id']);
            if($feedback['ok']) {
                $imp_routes = $feedback['resource'];
                foreach($imp_routes as $imp_route) {
                    $impRoute_entity->setAttributes($imp_route);
                    $feedback = $impRoute_entity->DELETE();
                    if(!$feedback['ok']) {
                        if($feedback['code'] == 'QRY_KO') {
                            $feedback['code'] = 'IMPROUTE_DEL_KO';
                        }
                        break;
                    }
                    array_push($imps_deleted, $imp_route);
                }
                if(!$feedback['ok']) break;
            } else {
                return $feedback;
            }
        }

        if($feedback['ok']) {
            $feedback = $this->delete_impRoutes($edificio_id, $routes, $floors);
            if($feedback['ok']) {
                return $feedback;
            }
        }

        foreach($imps_deleted as $imp_deleted) {
            $impRoute_entity->setAttributes($imp_deleted);
            $impRoute_entity->ADD();
        }

        return $feedback;
    }

    function expire_routes($edificio_id, $routes, $floors) {
        if(empty($routes)) {
            $feedback = $this->searchFormatsByPlan();
            if($feedback['ok'] || $feedback['code'] == 'DFPLAN_FRMT_NOT_EXST') {
                return $this->expire_formations($edificio_id, $feedback['resource']);
            }
            return $feedback;
        }

        $route = array_pop($routes);
        $feedback['ok'] = true;
        $routes_edited = array();
        include_once './Model/ImpRoute_Model.php';
        $impRoute_entity = new ImpRoute_Model();

        foreach($floors as $floor) {
            $feedback = $this->searchImpRoutes($floor['planta_id'], $route['ruta_id']);
            if(!$feedback['ok']) break;
            if($feedback['code'] == 'BLDPLAN_IMPROUTE_EMPT') continue;
            $imp_routes = $feedback['resource'];

            foreach($imp_routes as $imp_route) {
                if($imp_route['estado'] == 'vencido') continue;
                $impRoute_entity->setAttributes($imp_route);
                $impRoute_entity->estado = 'vencido';
                $feedback = $impRoute_entity->EDIT();
                if(!$feedback['ok']) {
                    if($feedback['code'] == 'QRY_KO') $feedback['code'] = 'IMPROUTE_EDTSTATE_KO';
                    break;
                }
                array_push($routes_edited, $imp_route);
            }

            if(!$feedback['ok']) break;
        }

        if($feedback['ok']) {
            $feedback = $this->expire_routes($edificio_id, $routes, $floors);
            if($feedback['ok']) return $feedback;
        }

        foreach($routes_edited as $route_edited) {
            $impRoute_entity->setAttributes($route_edited);
            $impRoute_entity->EDIT();
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

        $formation = array_pop($formations);
        include_once './Model/ImpFormat_Model.php';
        $impFormat_entity = new ImpFormat_Model();
        $impFormat_entity->setAttributes(array('edificio_id' => $edificio_id, 'formacion_id' => $formation['formacion_id'],'estado' => 'pendiente',
                                            'fecha_planificacion' => default_data, 'url_recurso' => default_url, 'destinatarios' => default_destinatarios));
        $feedback = $impFormat_entity->ADD();
        if($feedback['ok']) {
            $feedback = $this->create_impFormat($edificio_id, $formations);
            if($feedback['ok']) {
                return $feedback;
            }
            $impFormat_entity->DELETE();
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'IMPFRMT_ADD_KO';
        }

        return $feedback;
    }

    function delete_impFormats($edificio_id, $formations) {
        if(empty($formations)) {
            $feedback = $this->searchSimsByPlan();
            if($feedback['ok'] || $feedback['code'] == 'DFPLAN_SIM_NOT_EXST') {
                return $this->delete_impSims($edificio_id, $feedback['resource']);
            }
            return $feedback;
        }

        $format = array_pop($formations);
        $feedback = $this->searchImpFormats($edificio_id, $format['formacion_id']);
        if($feedback['ok']) {
            include_once './Model/ImpFormat_Model.php';
            $impFormat_entity = new ImpFormat_Model();
            $imp_formats = $feedback['resource'];
            $imps_deleted = array();

            foreach($imp_formats as $imp_format) {
                $impFormat_entity->setAttributes($imp_format);
                $feedback = $impFormat_entity->DELETE();
                if(!$feedback['ok']) {
                    if($feedback['code'] == 'QRY_KO') {
                        $feedback['code'] = 'IMPFRMT_DEL_KO';
                    }
                    break;
                }

                array_push($imps_deleted, $imp_format);
            }

            if($feedback['ok']) {
                $feedback = $this->delete_impFormats($edificio_id, $formations);
                if($feedback['ok']) {
                    return $feedback;
                }
            }

            foreach($imps_deleted as $imp_deleted) {
                $impFormat_entity->setAttributes($imp_deleted);
                $impFormat_entity->ADD();
            }
        }

        return $feedback;
    }

    function expire_formations($edificio_id, $formations) {
        if(empty($formations)) {
            $feedback = $this->searchSimsByPlan();
            if($feedback['ok'] || $feedback['code'] == 'DFPLAN_SIM_NOT_EXST') {
                return $this->expire_simulacrums($edificio_id, $feedback['resource']);
            }
            return $feedback;
        }

        $formation = array_pop($formations);
        $feedback = $this->searchImpFormats($edificio_id, $formation['formacion_id']);
        if(!$feedback['ok']) return $feedback;
        if($feedback['code'] == 'BLDPLAN_IMPFRMT_EMPT') return $this->expire_formations($edificio_id, $formations);

        $formations_edited = array();
        $imp_formations = $feedback['resource'];
        include_once './Model/ImpFormat_Model.php';
        $impFormat_entity = new ImpFormat_Model();

        foreach($imp_formations as $imp_formation) {
            if($imp_formation['estado'] == 'vencido') continue;
            $impFormat_entity->setAttributes($imp_formation);
            $impFormat_entity->estado = 'vencido';
            $feedback = $impFormat_entity->EDIT();
            if(!$feedback['ok']) {
                if($feedback['code'] == 'QRY_KO') $feedback['code'] = 'IMPFRMT_EDTSTATE_KO';
                break;
            }
            array_push($formations_edited, $imp_formation);
        }

        if($feedback['ok']) {
            $feedback = $this->expire_formations($edificio_id, $formations);
            if($feedback['ok']) return $feedback;
        }

        foreach($imp_formations as $imp_formation) {
            $impFormat_entity->setAttributes($imp_formation);
            $impFormat_entity->EDIT();
        }

        return $feedback;
    }

    function create_impSims($edificio_id, $simulacrums) {
        if(empty($simulacrums)) {
            return array('ok' => true, 'code' => 'BLDPLAN_IMPADD_OK');
        }

        $simulacrum = array_pop($simulacrums);
        include_once './Model/ImpSim_Model.php';
        $impSim_entity = new ImpSim_Model();
        $impSim_entity->setAttributes(array('simulacro_id' => $simulacrum['simulacro_id'], 'edificio_id' => $edificio_id, 'estado' => 'pendiente',
                                        'fecha_planificacion' => default_data, 'url_recurso' => default_url, 'destinatarios' => default_destinatarios));
        $feedback = $impSim_entity->ADD();
        if($feedback['ok']) {
            $feedback = $this->create_impSims($edificio_id, $simulacrums);
            if($feedback['ok']) {
                return $feedback;
            }
            $impSim_entity->DELETE();
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'IMPSIM_ADD_KO';
        }

        return $feedback;
    }

    function delete_impSims($edificio_id, $simulacrums) {
        if(empty($simulacrums)) {
            return array('ok' => true, 'code' => 'BLD_IMPDEL_OK');
        }

        $simulacrum = array_pop($simulacrums);
        $feedback = $this->searchImpSims($edificio_id, $simulacrum['simulacro_id']);
        if($feedback['ok']) {
            include_once './Model/ImpSim_Model.php';
            $impSim_entity = new ImpSim_Model();
            $imp_sims = $feedback['resource'];
            $imps_deleted = array();

            foreach($imp_sims as $imp_sim) {
                $impSim_entity->setAttributes($imp_sim);
                $feedback = $impSim_entity->DELETE();
                if(!$feedback['ok']) {
                    if($feedback['code'] == 'QRY_KO') {
                        $feedback['code'] = 'IMPSIM_DEL_KO';
                    }
                    break;
                }
                array_push($imps_deleted, $imp_sim);
            }

            if($feedback['ok']) {
                $feedback = $this->delete_impSims($edificio_id, $simulacrums);
                if($feedback['ok']) {
                    return $feedback;
                }
            }

            foreach($imps_deleted as $imp_deleted) {
                $impSim_entity->setAttributes($imp_deleted);
                $impSim_entity->ADD();
            }
        }

        return $feedback;
    }

    function expire_simulacrums($edificio_id, $simulacrums) {
        if(empty($simulacrums)) {
            return $this->expire_assignments();
        }

        $simulacrum = array_pop($simulacrums);
        $feedback = $this->searchImpSims($edificio_id, $simulacrum['simulacro_id']);
        if(!$feedback['ok']) return $feedback;
        if($feedback['code'] == 'BLDPLAN_IMPSIM_EMPT') return $this->expire_simulacrums($edificio_id, $simulacrums);

        $imp_sims = $feedback['resource'];
        $sims_edited = array();
        include_once './Model/ImpSim_Model.php';
        $impSim_entity = new ImpSim_Model();

        foreach($imp_sims as $imp_sim) {
            if($imp_sim['estado'] == 'vencido') continue;
            $impSim_entity->setAttributes($imp_sim);
            $impSim_entity->estado = 'vencido';
            $feedback = $impSim_entity->EDIT();
            if(!$feedback['ok']) {
                if($feedback['code'] == 'QRY_KO') $feedback['code'] = 'IMPSIM_EDTSTATE_KO';
                break;
            }
            array_push($sims_edited, $imp_sim);
        }

        if($feedback['ok']) {
            $feedback = $this->expire_simulacrums($edificio_id, $simulacrums);
            if($feedback['ok']) return $feedback;
        }

        foreach($imp_sims as $imp_sim) {
            $impSim_entity->setAttributes($imp_sim);
            $impSim_entity->EDIT();
        }

        return $feedback;
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

    function searchImpDocs($edificio_id, $doc_id) {
        include_once './Model/ImpDoc_Model.php';
        $impDoc_entity = new ImpDoc_Model();
        $impDoc_entity->setAttributes(array('edificio_id' => $edificio_id, 'documento_id' => $doc_id));
        $feedback = $impDoc_entity->searchDocsBuildings();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['code'] = 'BLDPLAN_IMPDOCS_EMPT';
            } else {
                $feedback['code'] = 'BLDPLAN_IMPDOCS_OK';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'BLDPLAN_IMPDOCS_KO';
        }

        return $feedback;
    }

    function searchImpProcs($edificio_id, $proc_id) {
        include_once './Model/ImpProc_Model.php';
        $impProc_entity = new ImpProc_Model();
        $impProc_entity->setAttributes(array('edificio_id' => $edificio_id, 'procedimiento_id' => $proc_id));
        $feedback = $impProc_entity->searchProcsBuildings();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['code'] = 'BLDPLAN_IMPPROCS_EMPT';
            } else if($feedback['code'] == 'QRY_KO') {
                $feedback['code'] = 'BLDPLAN_IMPPROCS_KO';
            }
        }

        return $feedback;
    }

    function searchImpRoutes($planta_id, $ruta_id) {
        include_once './Model/ImpRoute_Model.php';
        $impRoute_entity = new ImpRoute_Model();
        $impRoute_entity->setAttributes(array('planta_id' => $planta_id, 'ruta_id' => $ruta_id));
        $feedback = $impRoute_entity->searchRoutesFloors();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['code'] = 'BLDPLAN_IMPROUTE_EMPT';
            } else {
                $feedback['code'] = 'BLDPLAN_IMPROUTE_OK';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'BLDPLAN_IMPROUTES_KO';
        }

        return $feedback;
    }

    function searchImpFormats($edificio_id, $format_id) {
        include_once './Model/ImpFormat_Model.php';
        $impFormat_entity = new ImpFormat_Model();
        $impFormat_entity->setAttributes(array('edificio_id' => $edificio_id, 'formacion_id' => $format_id));
        $feedback = $impFormat_entity->searchFormatsBuildings();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['code'] = 'BLDPLAN_IMPFRMT_EMPT';
            } else {
                $feedback['code'] = 'BLDPLAN_IMPFRMT_OK';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'BLDPLAN_IMPFRMT_KO';
        }

        return $feedback;
    }

    function searchImpSims($edificio_id, $sim_id) {
        include_once './Model/ImpSim_Model.php';
        $impSim_entity = new ImpSim_Model();
        $impSim_entity->setAttributes(array('edificio_id' => $edificio_id, 'simulacro_id' => $sim_id));
        $feedback = $impSim_entity->searchSimsBuildings();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['code'] = 'BLDPLAN_IMPSIM_EMPT';
            } else {
                $feedback['code'] = 'BLDPLAN_IMPSIM_OK';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'BLDPLAN_IMPSIM_KO';
        }

        return $feedback;
    }


    function bldPlan_not_exist($edificio_id) {
        $this->bldPlan_entity->edificio_id = $edificio_id;
        $feedback = $this->bldPlan_entity->seek();
        if($feedback['ok']) {
            if($feedback['code'] != 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'BLDPLAN_EXST';
            } else {
                $feedback['code'] = 'BLDPLAN_NOT_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'BLDPLAN_KO';
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

    function searchActiveAssignmentsByPlan() {
        $feedback = $this->bldPlan_entity->searchActivesByPlanID();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'BLDPLAN_ASSIGN_ACTIVES_NOT_EXST';
            } else {
                $feedback['code'] = 'BLDPLAN_ASSIGN_ACTIVES_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'BLDPLAN_ASSIGN_ACTIVES_KO';
        }

        return $feedback;
    }

}

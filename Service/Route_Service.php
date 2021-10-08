<?php

include_once './Validation/Route_Validation.php';
include_once './Model/DefRoute_Model.php';
include_once './Model/ImpRoute_Model.php';

class Route_Service extends Route_Validation {
    var $atributos;
    var $impRoute_entity;
    var $defRoute_entity;
    var $feedback = array();

    function __construct() {
        date_default_timezone_set("Europe/Madrid");
        $this->atributos = array('planta_ruta_id','planta_id','ruta_id','estado','fecha_cumplimentacion','fecha_vencimiento','nombre_doc','nombre_planta', 'nombre_edificio', 'edificio_id');
        $this->impRoute_entity = new ImpRoute_Model();
        $this->defRoute_entity = new DefRoute_Model();
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

    function searchImpRoutes() {
        $this->feedback = $this->seekRoute();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $route = $this->feedback['resource'];
        $validation = $this->validar_atributos_search_implements();
        if(!$validation['ok']) {
            $validation['route'] = array('ruta_id' => $route['ruta_id']);
            return $validation;
        }

        $this->feedback = $this->impRoute_entity->SEARCH();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'IMPROUTE_SEARCH_OK';
            $this->feedback['route'] = $route;
        } else {
            $this->feedback['route'] = array('ruta_id' => $route['ruta_id']);
            if($this->feedback['code'] == 'QRY_KO') {
                $this->feedback['code'] = 'IMPROUTE_SEARCH_KO';
            }
        }

        return $this->feedback;
    }

    function searchRoute() {
        $this->feedback = $this->searchRouteAndBuilding();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $route = $this->feedback['route'];
        $building = $this->feedback['building'];
        if(es_resp_edificio() && $building['username'] != getUser()) {
            $this->feedback['ok'] = false;
            $this->feedback['code'] = 'BLD_FRBD';
            unset($this->feedback['resource'], $this->feedback['route'], $this->feedback['building']);
            return $this->feedback;
        }

        $validation = $this->validar_atributos_search();
        if(!$validation['ok']) {
            $validation['return'] = array('ruta_id' => $route['ruta_id'], 'edificio_id' => $building['edificio_id']);
            return $validation;
        }

        $route_state = $this->get_route_state();
        if(!$route_state['ok']) {
            $route_state['return'] = array('ruta_id' => $route['ruta_id'], 'edificio_id' => $building['edificio_id']);
            return $route_state;
        }

        $route['estado'] = $route_state['estado'];
        $this->feedback = $this->impRoute_entity->searchImpRoutes();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'IMPROUTE_SEARCH_OK';
            $this->feedback['route'] = $route;
            $this->feedback['building'] = $building;
        } else {
            $this->feedback['return'] = array('ruta_id' => $route['ruta_id'], 'edificio_id' => $building['edificio_id']);
            if($this->feedback['code'] == 'QRY_KO') {
                $this->feedback['code'] = 'IMPROUTE_SEARCH_KO';
            }
        }

        return $this->feedback;
    }

    function seekPortalRoute() {
        $this->feedback = $this->searchRouteAndBuilding();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $route = $this->feedback['route'];
        $building = $this->feedback['building'];
        $bld_plan = $this->feedback['resource'];

        if($bld_plan['estado'] == 'vencido') {
            $this->feedback['ok'] = false;
            $this->feedback['code'] = 'BLDROUTE_NOT_EXST';
            unset($this->feedback['resource'], $this->feedback['route'], $this->feedback['building']);
            return $this->feedback;
        }

        $route_state = $this->get_route_state();
        if(!$route_state['ok']) {
            return $route_state;
        }

        if($route_state['estado'] == 'vencido') {
            $this->feedback['ok'] = false;
            $this->feedback['code'] = 'DFROUTEID_NOT_EXST';
            unset($this->feedback['resource'], $this->feedback['route'], $this->feedback['building']);
            return $this->feedback;
        }

        $route['estado'] = $route_state['estado'];
        $validation = $this->validar_atributos_search_portal();
        if(!$validation['ok']) {
            $validation['return'] = array('ruta_id' => $route['ruta_id'], 'edificio_id' => $building['edificio_id']);
            return $validation;
        }

        $this->feedback = $this->impRoute_entity->searchActiveImpRoutes();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'PRTL_IMPROUTE_SEARCH_OK';
            $this->feedback['route'] = $route;
            $this->feedback['building'] = $building;
        } else {
            $this->feedback['return'] = array('ruta_id' => $route['ruta_id'], 'edificio_id' => $building['edificio_id']);
            if($this->feedback['code'] == 'QRY_KO') {
                $this->feedback['code'] = 'PRTL_IMPROUTE_SEARCH_KO';
            }
        }

        return $this->feedback;
    }

    function dataRouteForm() {
        $this->feedback = $this->searchRouteAndBuilding();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $building = $this->feedback['building'];
        $route = $this->feedback['route'];
        if(es_resp_edificio() && $building['username'] != getUser()) {
            $this->feedback['ok'] = false;
            $this->feedback['code'] = 'BLD_FRBD';
            unset($this->feedback['resource'], $this->feedback['building'], $this->feedback['route']);
            return $this->feedback;
        }

        $this->feedback = $this->searchBuildingFloors();

        if($this->feedback['ok']) {
            $this->feedback['route'] = $route;
            $this->feedback['building'] = $building;
        } else {
            $this->feedback['return'] = array('ruta_id' => $route['ruta_id'], 'edificio_id' => $building['edificio_id']);
        }

        return $this->feedback;
    }

    function searchPortalRouteForm() {
        $this->feedback = $this->searchRouteAndBuilding();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $route = $this->feedback['route'];
        $building = $this->feedback['building'];
        $bld_plan = $this->feedback['resource'];
        if($bld_plan['estado'] == 'vencido') {
            $this->feedback['ok'] = false;
            $this->feedback['code'] = 'BLDROUTE_NOT_EXST';
            unset($this->feedback['resource'], $this->feedback['route'], $this->feedback['building']);
            return $this->feedback;
        }

        $this->feedback = $this->searchBuildingFloors();
        $this->feedback['building'] = $building;
        $this->feedback['route'] = $route;

        return $this->feedback;
    }

    function addRoute() {
        $validation = $this->validar_atributos_addRoute();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByRouteID();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $route = $this->feedback['resource'];
        $this->feedback = $this->seekByFloorID();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $floor = $this->feedback['resource'];
        $this->edificio_id = $floor['edificio_id'];
        $this->feedback = $this->seekByBuildingID();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $building = $this->feedback['resource'];
        if(es_resp_edificio() && $building['username'] != getUser()) {
            $this->feedback['code'] = false;
            $this->feedback['code'] = 'BLD_FRBD';
            unset($this->feedback['resource']);
            return $this->feedback;
        }

        $this->feedback = $this->seekPlanBuilding($route['plan_id']);
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $this->impRoute_entity->setAttributes(array('nombre_doc' => default_doc, 'fecha_cumplimentacion' => default_data,
                                                        'fecha_vencimiento' => default_data, 'estado' => 'pendiente'));
        $this->feedback = $this->impRoute_entity->ADD();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'IMPROUTE_ADD_OK';
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'IMPROUTE_ADD_KO';
        }

        $this->feedback['return'] = array('edificio_id' => $building['edificio_id'], 'ruta_id' => $route['ruta_id']);
        return $this->feedback;
    }

    function addImpRouteForm() {
        $this->feedback = $this->seekRoute();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $route = $this->feedback['resource'];
        $this->feedback = $this->searchActiveBuildPlans($route['plan_id']);
        if($this->feedback['ok']) {
            $this->feedback['route'] = $route;
        } else {
            $this->feedback['route'] = array('ruta_id' => $route['ruta_id']);
        }

        return $this->feedback;
    }

    function addImpRoute() {
        $validation = $this->validar_atributos_add();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByRouteID();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $route = $this->feedback['resource'];
        $this->feedback = $this->ADD($route);
        $this->feedback['route'] = array('ruta_id' => $route['ruta_id']);
        return $this->feedback;
    }

    function ADD($route) {
        if(empty($this->buildings)) {
            $feedback['ok'] = true;
            $feedback['code'] = 'IMPROUTE_ADD_OK';
            return $feedback;
        }

        $this->edificio_id = array_pop($this->buildings);
        $feedback = $this->seekByBuildingID();
        if(!$feedback['ok']) {
            return $feedback;
        }

        $building = $feedback['resource'];
        if(es_resp_edificio() && $building['username'] != getUser()) {
            $feedback['ok'] = false;
            $feedback['code'] = 'BLD_FRBD';
            unset($feedback['resource']);
            return $feedback;
        }

        $feedback = $this->seekPlanBuilding($route['plan_id']);
        if(!$feedback['ok']) {
            return $feedback;
        }

        $bld_plan = $feedback['resource'];
        if($bld_plan['estado'] == 'vencido') {
            $feedback['ok'] = false;
            $feedback['code'] = 'BLDPLAN_EXPIRED';
            $feedback['building'] = array('edificio_id' => $building['edificio_id']);
            return $feedback;
        }

        $feedback = $this->searchBuildingFloors();
        if(!$feedback['ok']) {
            if($feedback['code'] == 'BLD_FLOORS_SEARCH_EMPT') {
                $feedback['code'] = 'BLD_NOT_FLOORS';
            }
            return $feedback;
        }

        $floors = $feedback['resource'];
        include_once './Service/Uploader_Service.php';
        $uploader = new Uploader();
        $path = plans_path . $route['plan_id'] . '/' . $this->edificio_id . '/Rutas/';
        $def_dir_created = false;
        if(!$uploader->dir_exist($path . $route['ruta_id'])['ok']) {
            $feedback = $uploader->create_dir($path, $this->ruta_id);
            if(!$feedback['ok']) {
                $feedback['building'] = array('edificio_id' => $building['edificio_id']);
                $feedback['code'] = 'BLDPLAN_DIRROUTE_KO';
                return $feedback;
            }
            $def_dir_created = true;
        }

        $created_imp_floors = array();
        foreach($floors as $floor) {
            $this->impRoute_entity->setAttributes(array('ruta_id' => $route['ruta_id'], 'planta_id' => $floor['planta_id'], 'nombre_doc' => default_doc,
                                                                'fecha_cumplimentacion' => default_data, 'fecha_vencimiento' => default_data, 'estado' => 'pendiente'));
            $feedback = $this->impRoute_entity->ADD();
            if(!$feedback['ok']) {
                if($feedback['code'] == 'QRY_KO') {
                    $feedback['code'] = 'IMPROUTE_ADD_KO';
                }
                break;
            }
            array_push($created_imp_floors, $this->impRoute_entity->planta_ruta_id);
        }

        if(sizeof($floors) == sizeof($created_imp_floors)) {
            $feedback = $this->ADD($route);
            if($feedback['ok']) {
                return $feedback;
            }
        }

        foreach($created_imp_floors as $imp_floor) {
            $this->impRoute_entity->planta_ruta_id = $imp_floor;
            $this->impRoute_entity->DELETE();
        }

        if($def_dir_created) {
            $uploader->delete($path . $route['ruta_id']);
        }

        return $feedback;
    }

    function seek() {
        $validation = $this->validar_PLANTA_RUTA_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByImpRouteID();
        if($this->feedback['ok']) {
            $imp_route = $this->feedback['resource'];
            if(es_resp_edificio() && $imp_route['username'] != getUser()) {
                $this->feedback['ok'] = false;
                $this->feedback['code'] = 'BLD_FRBD';
                unset($this->feedback['resource']);
                return $this->feedback;
            }

            $this->feedback['resource']['path'] = plans_path . $imp_route['plan_id'] . '/' . $imp_route['edificio_id'] . '/Rutas/' .
                                                        $imp_route['ruta_id'] . '/' . $imp_route['planta_ruta_id'];
            $this->feedback['code'] = 'IMPROUTE_SEEK_OK';
        } else if($this->feedback['code'] == 'IMPROUTEID_KO') {
            $this->feedback['code'] = 'IMPROUTE_SEEK_KO';
        }

        return $this->feedback;
    }

    function seekPortalImpRoute() {
        $validation = $this->validar_PLANTA_RUTA_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByImpRouteID();
        if($this->feedback['ok']) {
            $imp_route = $this->feedback['resource'];
            if($imp_route['estado'] == 'vencido') {
                $this->feedback['ok'] = false;
                $this->feedback['code'] = 'IMPROUTEID_NOT_EXST';
                unset($this->feedback['resource']);
                return $this->feedback;
            }
            $this->feedback['code'] = 'PRTL_IMPROUTE_SEEK_OK';
            $this->feedback['resource']['path'] = plans_path . $imp_route['plan_id'] . '/' . $imp_route['edificio_id'] . '/Rutas/' .
                                                    $imp_route['ruta_id'] . '/' . $imp_route['planta_ruta_id'];
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'PRTL_IMPROUTE_SEEK_KO';
        }

        return $this->feedback;
    }

    function expire() {
        $this->feedback = $this->seek();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $imp_route = $this->feedback['resource'];
        $this->impRoute_entity->estado = 'vencido';
        $this->impRoute_entity->fecha_vencimiento = date('Y-m-d');
        $this->feedback = $this->impRoute_entity->EDIT();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'IMPROUTE_EXPIRE_OK';
            $this->update_plan_state($imp_route['edificio_id'], $imp_route['plan_id']);
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'IMPROUTE_EXPIRE_KO';
        }

        $this->feedback['return'] = array('edificio_id' => $imp_route['edificio_id'], 'ruta_id' => $imp_route['ruta_id']);
        return $this->feedback;
    }

    function implement() {
        $this->feedback = $this->seek();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $imp_route = $this->feedback['resource'];
        if($imp_route['estado'] == 'vencido') {
            $this->feedback['ok'] = false;
            $this->feedback['code'] = 'COMPL_EXPIRED';
            $this->feedback['return'] = array('edificio_id' => $imp_route['edificio_id'], 'ruta_id' => $imp_route['ruta_id']);
            return $this->feedback;
        }

        $validation = $this->validar_NOMBRE_DOC();
        if(!$validation['ok']) {
            $validation['return'] = array('edificio_id' => $imp_route['edificio_id'], 'ruta_id' => $imp_route['ruta_id']);
            return $validation;
        }

        include_once './Service/Uploader_Service.php';
        $uploader = new Uploader();
        if(!$_SESSION['test']) {
            $this->feedback = $uploader->uploadFile($imp_route['path'], $this->nombre_doc);
            if(!$this->feedback['ok']) {
                $this->feedback['return'] = array('edificio_id' => $imp_route['edificio_id'], 'ruta_id' => $imp_route['ruta_id']);
                return $this->feedback;
            }
        }

        $this->impRoute_entity->setAttributes(array('fecha_cumplimentacion' => date('Y-m-d'),
                                                        'nombre_doc' => $this->nombre_doc, 'estado' => 'cumplimentado'));
        $this->feedback = $this->impRoute_entity->EDIT();
        if($this->feedback['ok']) {
            if($imp_route['nombre_doc'] != default_doc && $imp_route['nombre_doc'] != $this->nombre_doc) {
                $uploader->delete($imp_route['path'] . '/' . $imp_route['nombre_doc']);
            }
            $this->feedback['code'] = 'IMPROUTE_IMPL_OK';
            $this->update_plan_state($imp_route['edificio_id'], $imp_route['plan_id']);
        } else {
            $uploader->delete($imp_route['path'] . '/' . $this->nombre_doc);
            if($uploader->dir_is_empty($imp_route['path'])['ok']) {
                $uploader->delete($imp_route['path']);
            }
            if($this->feedback['code'] == 'QRY_KO') {
                $this->feedback['code'] = 'IMPROUTE_IMPL_KO';
            }
        }

        $this->feedback['return'] = array('edificio_id' => $imp_route['edificio_id'], 'ruta_id' => $imp_route['ruta_id']);
        return $this->feedback;
    }

    function DELETE() {
        $this->feedback = $this->seek();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $imp_route = $this->feedback['resource'];
        $path = $imp_route['path'];

        if(es_resp_edificio()) {
            $this->feedback = $this->check_more_than_one_improutes($imp_route['edificio_id'], $imp_route['ruta_id']);
            if(!$this->feedback['ok']) {
                $this->feedback['return'] = array('edificio_id' => $imp_route['edificio_id'], 'ruta_id' => $imp_route['ruta_id']);
                return $this->feedback;
            }
        }

        $this->feedback = $this->impRoute_entity->DELETE();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'IMPROUTE_DEL_OK';
            include_once './Service/Uploader_Service.php';
            $uploader = new Uploader();
            if($uploader->dir_exist($path)['ok']) {
                $uploader->delete_all($path);
            }
            $this->update_plan_state($imp_route['edificio_id'], $imp_route['plan_id']);
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'IMPROUTE_DEL_KO';
        }

        $this->feedback['return'] = array('edificio_id' => $imp_route['edificio_id'], 'ruta_id' => $imp_route['ruta_id']);
        return $this->feedback;
    }

    function seekRoute() {
        $validation = $this->validar_RUTA_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        return $this->seekByRouteID();
    }

    function searchRouteAndBuilding() {
        $validation = $this->validar_route_and_building();
        if(!$validation['ok']) {
            return $validation;
        }

        $feedback = $this->seekByRouteID();
        if(!$feedback['ok']) {
            return $feedback;
        }

        $route = $feedback['resource'];
        $feedback = $this->seekByBuildingID();
        if(!$feedback['ok']) {
            return $feedback;
        }

        $building = $feedback['resource'];
        $feedback = $this->seekPlanBuilding($route['plan_id']);
        if(!$feedback['ok']) {
            return $feedback;
        }

        $feedback['route'] = $route;
        $feedback['building'] = $building;
        return $feedback;
    }

    function seekByRouteID() {
        $feedback = $this->defRoute_entity->seek();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'DFROUTEID_NOT_EXST';
            } else {
                $feedback['code'] = 'DFROUTEID_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'DFROUTEID_KO';
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

    function seekPlanBuilding($plan_id) {
        include_once './Model/BuildPlan_Model.php';
        $buildPlan_entity = new BuildPlan_Model();
        $buildPlan_entity->setAttributes(array('plan_id' => $plan_id, 'edificio_id' => $this->edificio_id));
        $feedback = $buildPlan_entity->seek();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'BLDROUTE_NOT_EXST';
            } else {
                $feedback['code'] = 'BLDROUTE_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'BLDROUTE_KO';
        }

        return $feedback;
    }

    function searchActiveBuildPlans($plan_id) {
        include_once './Model/BuildPlan_Model.php';
        $bldPlan_entity = new BuildPlan_Model();
        $bldPlan_entity->plan_id = $plan_id;
        $feedback = $bldPlan_entity->searchActivesByPlanID();
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

    function searchBuildingFloors() {
        include_once './Model/Floor_Model.php';
        $floor_entity = new Floor_Model();
        $floor_entity->edificio_id = $this->edificio_id;
        $feedback = $floor_entity->searchByBuildingID();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'BLD_FLOORS_SEARCH_EMPT';
            } else {
                $feedback['code'] = 'BLD_FLOORS_OK';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'BLD_FLOORS_KO';
        }

        return $feedback;
    }

    function get_route_state() {
        $feedback = $this->searchBuildingFloors();
        if(!$feedback['ok'] && $feedback['code'] != 'BLD_FLOORS_SEARCH_EMPT') {
            return $feedback;
        }

        include_once './Service/CheckState_Service.php';
        $checkState_service = new CheckState_Service();
        return $checkState_service->get_state_route($this->ruta_id, $feedback['resource']);
    }


    function seekByFloorID() {
        include_once './Model/Floor_Model.php';
        $floor_entity = new Floor_Model();
        $feedback = $floor_entity->seek();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'FLRID_NOT_EXST';
            } else {
                $feedback['code'] = 'FLRID_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'FLRID_KO';
        }

        return $feedback;
    }

    function seekByImpRouteID() {
        $feedback = $this->impRoute_entity->seek();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'IMPROUTEID_NOT_EXST';
            } else {
                $feedback['code'] = 'IMPROUTEID_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'IMPROUTEID_KO';
        }

        return $feedback;
    }

    function update_plan_state($edificio_id, $plan_id) {
        include_once './Service/CheckState_Service.php';
        $checkState_service = new CheckState_Service($edificio_id, $plan_id);
        $checkState_service->update_plan_state();
    }

    function check_more_than_one_improutes($edificio_id, $ruta_id) {
        $this->impRoute_entity->ruta_id = $ruta_id;
        $feedback = $this->impRoute_entity->searchRoutesBuildings($edificio_id);
        if($feedback['ok']) {
            if(count($feedback['resource']) <= 1) {
                $feedback['ok'] = false;
                $feedback['code'] = 'IMPROUTE_UNIQ';
            } else {
                $feedback['code'] = 'IMPROUTE_NOT_UNIQ';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'IMPROUTE_SEARCH_KO';
        }

        return $feedback;
    }
}
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
        $this->atributos = array('planta_ruta_id','planta_id','ruta_id','estado','fecha_cumplimentacion','nombre_doc','nombre_planta', 'nombre_edificio', 'edificio_id');
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
            $this->feedback['return'] = array('plan_id' => $route['plan_id'], 'edificio_id' => $building['edificio_id']);
            return $this->feedback;
        }

        $route['estado'] = $route_state['estado'];
        $validation = $this->validar_atributos_search_portal();
        if(!$validation['ok']) {
            $validation['return'] = array('plan_id' => $route['plan_id'], 'edificio_id' => $building['edificio_id']);
            return $validation;
        }

        $this->feedback = $this->impRoute_entity->searchActiveImpRoutes();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'PRTL_IMPROUTE_SEARCH_OK';
            $this->feedback['route'] = $route;
            $this->feedback['building'] = $building;
        } else {
            $this->feedback['return'] = array('plan_id' => $route['plan_id'], 'edificio_id' => $building['edificio_id']);
            if($this->feedback['code'] == 'QRY_KO') {
                $this->feedback['code'] = 'PRTL_IMPROUTE_SEARCH_KO';
            }
        }

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

    function get_route_state() {
        $feedback = $this->search_all_improutes();
        if(!$feedback['ok']) {
            return $feedback;
        }

        include_once './Service/CheckState_Service.php';
        $checkState_service = new CheckState_Service();
        $estado = $checkState_service->check_state($feedback['resource']);
        return array('ok' => true, 'estado' => $estado);
    }

    function search_all_improutes() {
        $feedback = $this->impRoute_entity->searchRoutesBuildings($this->edificio_id);
        if($feedback['ok']) {
            $feedback['code'] = 'BLDROUTES_SEARCH_OK';
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'BLDROUTES_SEARCH_KO';
        }

        return $feedback;
    }
}
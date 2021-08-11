<?php

include_once './Validation/DefRoute_Validation.php';
include_once './Model/DefRoute_Model.php';
include_once './Model/DefPlan_Model.php';

class DefRoute_Service extends DefRoute_Validation {
    var $atributos;
    var $defRoute_entity;
    var $defPlan_entity;
    var $feedback = array();

    function __construct() {
        $this->atributos = array('ruta_id','plan_id','nombre','descripcion');
        $this->defRoute_entity = new DefRoute_Model();
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

        $this->feedback = $this->defRoute_entity->SEARCH();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'DFROUTE_SEARCH_OK';
            $this->feedback['plan'] = array('plan_id' => $plan['plan_id'], 'nombre' => $plan['nombre']);
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'DFROUTE_SEARCH_KO';
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

        $this->feedback = $this->name_route_not_exist();
        if(!$this->feedback['ok']) {
            $this->feedback['plan'] = array('plan_id' => $plan['plan_id']);
            return $this->feedback;
        }

        $this->feedback = $this->defRoute_entity->ADD();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'DFROUTE_ADD_OK';
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'DFROUTE_ADD_KO';
        }

        $this->feedback['plan'] = array('plan_id' => $plan['plan_id']);
        return $this->feedback;
    }

    function seek() {
        $validation = $this->validar_RUTA_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByRouteID();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'DFROUTE_SEEK_OK';
        } else if($this->feedback['code'] == 'DFROUTEID_KO') {
            $this->feedback['code'] = 'DFROUTE_SEEK_KO';
        }

        return $this->feedback;
    }

    function DELETE() {
        $this->feedback = $this->seek();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $route = $this->feedback['resource'];
        $this->feedback = $this->imp_routes_not_exist();
        if(!$this->feedback['ok']) {
            $this->feedback['plan'] = array('plan_id' => $route['plan_id']);
            return $this->feedback;
        }

        $this->feedback = $this->defRoute_entity->DELETE();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'DFROUTE_DEL_OK';
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'DFROUTE_DEL_KO';
        }

        $this->feedback['plan'] = array('plan_id' => $route['plan_id']);
        return $this->feedback;
    }

    function seekPlan() {
        $validation = $this->validar_PLAN_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        return $this->seekByPlanID();
    }

    function EDIT() {
        $this->feedback = $this->seek();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $route = $this->feedback['resource'];
        $validation = $this->validar_atributos();
        if(!$validation['ok']) {
            $validation['plan'] = array('plan_id' => $route['plan_id']);
            return $validation;
        }

        if($this->nombre != $route['nombre']) {
            $this->defRoute_entity->plan_id = $route['plan_id'];
            $this->feedback = $this->name_route_not_exist();
            if(!$this->feedback['ok']) {
                $this->feedback['plan'] = array('plan_id' => $route['plan_id']);
                return $this->feedback;
            }
        }

        $this->feedback = $this->defRoute_entity->EDIT();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'DFROUTE_EDT_OK';
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'DFROUTE_EDT_KO';
        }

        $this->feedback['plan'] = array('plan_id' => $route['plan_id']);
        return $this->feedback;
    }


    function name_route_not_exist() {
        $feedback = $this->defRoute_entity->searchByRouteName();
        if($feedback['ok']) {
            if($feedback['code'] != 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'DFROUTE_NAME_EXST';
            } else {
                $feedback['code'] = 'DFROUTE_NAME_NOT_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'DFROUTE_NAME_KO';
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

    function imp_routes_not_exist() {
        include_once './Model/ImpRoute_Model.php';
        $impRoute_entity = new ImpRoute_Model();
        $feedback = $impRoute_entity->searchByRouteID();
        if($feedback['ok']) {
            if($feedback['code'] != 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'DFROUTE_IMPL_EXST';
            } else {
                $feedback['code'] = 'DFROUTE_IMPL_NOT_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'DFROUTE_IMPL_KO';
        }

        return $feedback;
    }
}
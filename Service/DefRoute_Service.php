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

    /*
     *  - Recupera las definiciones de rutas de un plan.
     *      1. Valida y busca un plan por ID, comprobando que existe.
     *      2. Valida los datos recibidos que se usarán como filtro en la búsqueda.
     *      3. Recupera las definiciones de rutas.
     */
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
        } else {
            if($this->feedback['code'] == 'QRY_KO') {
                $this->feedback['code'] = 'DFROUTE_SEARCH_KO';
            }
            $this->feedback['plan'] = array('plan_id' => $plan['plan_id']);
        }

        return $this->feedback;
    }

    /*
     *  - Añade la definición de una Ruta.
     *      1. Valida y busca la definición de la ruta que se asocia a la ruta, comprobando que existe.
     *      2. Valida que los atributos que conforman la definición de la ruta.
     *      3. Comprueba que el plan no tiene una definición de ruta con el mismo nombre.
     *      4. Añade la definición de la ruta.
     */
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

    // Recupera la información de la definición de una ruta por ID.
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

    /*
     *  - Elimina la definición de una ruta.
     *      1. Valida y busca la definición de una ruta por ID, comprobando que existe.
     *      2. Verifica que no existen cumplimentaciones de esa ruta en algún edificio.
     *      3. Elimina la definición de la ruta.
     */
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

    // Valida y busca la definición de un plan por ID.
    function seekPlan() {
        $validation = $this->validar_PLAN_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        return $this->seekByPlanID();
    }

    /*
     *  - Modifica los datos de la definición de una ruta.
     *      1. Valida y busca la definición de una ruta por ID, comprobando que existe.
     *      2. Valida los nuevos datos recibidos.
     *      3. En caso de que se haya recibido un nuevo nombre, verifica que no exista una definición de ruta en el mismo plan con ese nombre.
     *      4. Modifica los datos de la definición de la ruta.
     */
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

    // Comprueba que no existe una ruta con el nombre indicado.
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

    // Recupera los datos de la definición de un plan por ID.
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

    // Recupera los datos de la definición de una ruta por ID.
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

    // Verifica que no existen cumplimentaciones de un procedimiento.
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
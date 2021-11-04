<?php

include_once './Validation/DefSim_Validation.php';
include_once './Model/DefSim_Model.php';
include_once './Model/DefPlan_Model.php';

class DefSim_Service extends DefSim_Validation {
    var $atributos;
    var $defSim_entity;
    var $defPlan_entity;
    var $feedback = array();

    function __construct() {
        $this->atributos = array('simulacro_id','plan_id','nombre','descripcion');
        $this->defSim_entity = new DefSim_Model();
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
     *  - Recupera las definiciones de simulacros de un plan.
     *      1. Valida y busca un plan por ID, comprobando que existe.
     *      2. Valida los datos recibidos que se usarán como filtro en la búsqueda.
     *      3. Recupera las definiciones de simulacros.
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

        $this->feedback = $this->defSim_entity->SEARCH();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'DFSIM_SEARCH_OK';
            $this->feedback['plan'] = array('plan_id' => $plan['plan_id'], 'nombre' => $plan['nombre']);
        } else {
            if($this->feedback['code'] == 'QRY_KO') {
                $this->feedback['code'] = 'DFSIM_SEARCH_KO';
            }
            $this->feedback['plan'] = array('plan_id' => $plan['plan_id']);
        }

        return $this->feedback;
    }

    /*
     *  - Añade la definición de un Simulacro.
     *      1. Valida y busca la definición del plan al que se asocia el simulacro, comprobando que existe.
     *      2. Valida los atributos que conforman la definición del simulacro.
     *      3. Comprueba que el plan no tiene una definición de simulacro con el mismo nombre.
     *      4. Añade la definición del simulacro.
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

        $this->feedback = $this->name_sim_not_exist();
        if(!$this->feedback['ok']) {
            $this->feedback['plan'] = array('plan_id' => $plan['plan_id']);
            return $this->feedback;
        }

        $this->feedback = $this->defSim_entity->ADD();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'DFSIM_ADD_OK';
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'DFSIM_ADD_KO';
        }

        $this->feedback['plan'] = array('plan_id' => $plan['plan_id']);
        return $this->feedback;
    }

    /*
     *  - Elimina la definición de un simulacro.
     *      1. Valida y busca la definición de un simulacro por ID, comprobando que existe.
     *      2. Verifica que no existan cumplimentaciones de ese simulacro en algún edificio.
     *      3. Elimina la definición del simulacro.
     */
    function DELETE() {
        $this->feedback = $this->seek();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $sim = $this->feedback['resource'];
        $this->feedback = $this->imp_sims_not_exist();
        if(!$this->feedback['ok']) {
            $this->feedback['plan'] = array('plan_id' => $sim['plan_id']);
            return $this->feedback;
        }

        $this->feedback = $this->defSim_entity->DELETE();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'DFSIM_DEL_OK';
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'DFSIM_DEL_KO';
        }

        $this->feedback['plan'] = array('plan_id' => $sim['plan_id']);
        return $this->feedback;
    }

    /*
     *  - Modifica los datos de la definición de un simulacro.
     *      1. Valida y busca la definición de un simulacro por ID, comprobando qeu existe.
     *      2. Valida los nuevos datos recibidos.
     *      3. En caso de que se haya recibido un nuevo nombre, verifica que exista una definición de simulacro en el mismo plan con ese nombre.
     *      4. Modifica los datos de la definición del simulacro.
     */
    function EDIT() {
        $this->feedback = $this->seek();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $sim = $this->feedback['resource'];
        $validation = $this->validar_atributos();
        if(!$validation['ok']) {
            $validation['plan'] = array('plan_id' => $sim['plan_id']);
            return $validation;
        }

        if($this->nombre != $sim['nombre']) {
            $this->defSim_entity->plan_id = $sim['plan_id'];
            $this->feedback = $this->name_sim_not_exist();
            if(!$this->feedback['ok']) {
                $this->feedback['plan'] = array('plan_id' => $sim['plan_id']);
                return $this->feedback;
            }
        }

        $this->feedback = $this->defSim_entity->EDIT();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'DFSIM_EDT_OK';
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'DFSIM_EDT_KO';
        }

        $this->feedback['plan'] = array('plan_id' => $sim['plan_id']);
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

    // Recupera la información de la definición de un simulacro por ID.
    function seek() {
        $validation = $this->validar_SIMULACRO_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekBySimID();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'DFSIM_SEEK_OK';
        } else if($this->feedback['code'] == 'DFSIMID_KO') {
            $this->feedback['code'] = 'DFSIM_SEEK_KO';
        }

        return $this->feedback;
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

    // Recupera los datos de la definición de un simulacro por ID.
    function seekBySimID() {
        $feedback = $this->defSim_entity->seek();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'DFSIMID_NOT_EXST';
            } else {
                $feedback['code'] = 'DFSIMID_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'DFSIMID_KO';
        }

        return $feedback;
    }

    // Comprueba que no existe un simulacro con el nombre indicado.
    function name_sim_not_exist() {
        $feedback = $this->defSim_entity->searchByName();
        if($feedback['ok']) {
            if($feedback['code'] != 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'DFSIM_NAME_EXST';
            } else {
                $feedback['code'] = 'DFSIM_NAME_NOT_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'DFSIM_NAME_KO';
        }

        return $feedback;
    }

    // Verifica que no existen cumplimentaciones de un simulacro.
    function imp_sims_not_exist() {
        include_once './Model/ImpSim_Model.php';
        $impSim_entity = new ImpSim_Model();
        $feedback = $impSim_entity->searchBySimID();
        if($feedback['ok']) {
            if($feedback['code'] != 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'DFSIM_IMPL_EXST';
            } else {
                $feedback['code'] = 'DFSIM_IMPL_NOT_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'DFSIM_IMPL_KO';
        }

        return $feedback;
    }
}
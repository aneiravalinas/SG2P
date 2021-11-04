<?php

include_once './Validation/DefFormat_Validation.php';
include_once './Model/DefFormat_Model.php';
include_once './Model/DefPlan_Model.php';

class DefFormat_Service extends DefFormat_Validation {
    var $atributos;
    var $defFormat_entity;
    var $defPlan_entity;
    var $feedback = array();

    function __construct() {
        $this->atributos = array('formacion_id','plan_id','nombre','descripcion');
        $this->defFormat_entity = new DefFormat_Model();
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
     *  - Recupera las definiciones de formaciones de un plan.
     *      1. Valida y busca un plan por ID, comprobando que existe.
     *      2. Valida los datos recibidos que se usarán como filtro en la búsqueda.
     *      3. Recupera las definiciones de formaciones.
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

        $this->feedback = $this->defFormat_entity->SEARCH();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'DFFRMT_SEARCH_OK';
            $this->feedback['plan'] = array('plan_id' => $plan['plan_id'], 'nombre' => $plan['nombre']);
        } else {
            if($this->feedback['code'] == 'QRY_KO') {
                $this->feedback['code'] = 'DFFRMT_SEARCH_KO';
            }
            $this->feedback['plan'] = array('plan_id' => $plan['plan_id']);
        }

        return $this->feedback;
    }

    /*
     *  - Añade la definición de una formación.
     *      1. Valida y busca la definición del plan al que se asocia la formación, comprobando que existe.
     *      2. Valida los atributos que conforman la definición de la formación.
     *      3. Comprueba que el plan no tiene una definición de formación con el mismo nombre.
     *      4. Añade la definición de la formación.
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

        $this->feedback = $this->name_format_not_exist();
        if(!$this->feedback['ok']) {
            $this->feedback['plan'] = array('plan_id' => $plan['plan_id']);
            return $this->feedback;
        }

        $this->feedback = $this->defFormat_entity->ADD();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'DFFRMT_ADD_OK';
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'DFFRMT_ADD_KO';
        }

        $this->feedback['plan'] = array('plan_id' => $plan['plan_id']);
        return $this->feedback;
    }

    /*
     *  - Elimina la definición de una formación.
     *      1. Valida y busca la definición de una formación por ID, comprobando que existe.
     *      2. Verifica que no existen cumplimentaciones de esa formación en algún edificio.
     *      3. Elimina la definición de la formación.
     */
    function DELETE() {
        $this->feedback = $this->seek();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $format = $this->feedback['resource'];
        $this->feedback = $this->imp_formats_not_exist();
        if(!$this->feedback['ok']) {
            $this->feedback['plan'] = array('plan_id' => $format['plan_id']);
            return $this->feedback;
        }

        $this->feedback = $this->defFormat_entity->DELETE();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'DFFRMT_DEL_OK';
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'DFFRMT_DEL_KO';
        }

        $this->feedback['plan'] = array('plan_id' => $format['plan_id']);
        return $this->feedback;
    }

    /*
     *  - Modifica los datos de la definición de una formación.
     *      1. Valida y busca la definición de una formación por ID, comprobando que existe.
     *      2. Valida los nuevos datos recibidos.
     *      3. En caso de que se haya recibido un nuevo nombre, verifica que no exista una definición de formación en el mismo plan con ese nombre.
     *      4. Modifica los datos de la definición de la formación.
     */
    function EDIT() {
        $this->feedback = $this->seek();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $format = $this->feedback['resource'];
        $validation = $this->validar_atributos();
        if(!$validation['ok']) {
            $validation['plan'] = array('plan_id' => $format['plan_id']);
            return $validation;
        }

        if($this->nombre != $format['nombre']) {
            $this->defFormat_entity->plan_id = $format['plan_id'];
            $this->feedback = $this->name_format_not_exist();
            if(!$this->feedback['ok']) {
                $this->feedback['plan'] = array('plan_id' => $format['plan_id']);
                return $this->feedback;
            }
        }

        $this->feedback = $this->defFormat_entity->EDIT();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'DFFRMT_EDT_OK';
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'DFFRMT_EDIT_KO';
        }

        $this->feedback['plan'] = array('plan_id' => $format['plan_id']);
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

    // Recupera la información de la definción de la formación por ID.
    function seek() {
        $validation = $this->validar_FORMACION_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByFormatID();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'DFFRMT_SEEK_OK';
        } else if($this->feedback['code'] == 'DFFRMTID_KO') {
            $this->feedback['code'] = 'DFFRMT_SEEK_KO';
        }

        return $this->feedback;
    }

    // Verifica que no existen cumplimentaciones de una formación.
    function imp_formats_not_exist() {
        include_once './Model/ImpFormat_Model.php';
        $impFormat_entity = new ImpFormat_Model();
        $feedback = $impFormat_entity->searchByFormatID();
        if($feedback['ok']) {
            if($feedback['code'] != 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'DFFRMT_IMPL_EXST';
            } else {
                $feedback['code'] = 'DFFRMT_IMPL_NOT_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'DFFRMT_IMPL_KO';
        }

        return $feedback;
    }

    // Recupera los datos de la definición de una formación por ID.
    function seekByFormatID() {
        $feedback = $this->defFormat_entity->seek();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'DFFRMTID_NOT_EXST';
            } else {
                $feedback['code'] = 'DFFRMTID_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'DFFRMTID_KO';
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

    // Comprueba que no existe una formación con el nombre indicado.
    function name_format_not_exist() {
        $feedback = $this->defFormat_entity->searchByName();
        if($feedback['ok']) {
            if($feedback['code'] != 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'DFFRMT_NAME_EXST';
            } else {
                $feedback['code'] = 'DFFRMT_NAME_NOT_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'DFFRMT_NAME_KO';
        }

        return $feedback;
    }
}
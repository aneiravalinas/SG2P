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

    function DELETE() {
        $this->feedback = $this->seek();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $format = $this->feedback['resource'];
        $this->feedback = $this->imp_formats_not_exist();
        if(!$this->feedback['ok']) {
            $this->feedback['plan'] = array('plan_id' => $format['plan']);
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

    function seekPlan() {
        $validation = $this->validar_PLAN_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        return $this->seekByPlanID();
    }


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
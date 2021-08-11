<?php

include_once './Validation/DefProc_Validation.php';
include_once './Model/DefProc_Model.php';
include_once './Model/DefPlan_Model.php';

class DefProc_Service extends DefProc_Validation {
    var $atributos;
    var $defProc_entity;
    var $defPlan_entity;
    var $feedback = array();

    function __construct() {
        $this->atributos = array('procedimiento_id','plan_id','nombre','descripcion');
        $this->defProc_entity = new DefProc_Model();
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

        $this->feedback = $this->defProc_entity->SEARCH();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'DFPROC_SEARCH_OK';
            $this->feedback['plan'] = array('plan_id' => $plan['plan_id'], 'nombre' => $plan['nombre']);
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'DFPROC_SEARCH_KO';
            $this->feedback['plan'] = array('plan_id' => $plan['plan_id']);
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

        $this->feedback = $this->name_proc_not_exist();
        if(!$this->feedback['ok']) {
            $this->feedback['plan'] = array('plan_id' => $plan['plan_id']);
            return $this->feedback;
        }

        $this->feedback = $this->defProc_entity->ADD();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'DFPROC_ADD_OK';
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'DFPROC_ADD_KO';
        }

        $this->feedback['plan'] = array('plan_id' => $plan['plan_id']);
        return $this->feedback;
    }

    function seek() {
        $validation = $this->validar_PROCEDIMIENTO_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByProcID();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'DFPROC_SEEK_OK';
        } else if($this->feedback['code'] == 'DFPROCID_KO') {
            $this->feedback['code'] = 'DFPROC_SEEK_KO';
        }

        return $this->feedback;
    }

    function DELETE() {
        $this->feedback = $this->seek();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $proc = $this->feedback['resource'];

        $this->feedback = $this->imp_procs_not_exist();
        if(!$this->feedback['ok']) {
            $this->feedback['plan'] = array('plan_id' => $proc['plan_id']);
            return $this->feedback;
        }

        $this->feedback = $this->defProc_entity->DELETE();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'DFPROC_DEL_OK';
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'DFPROC_DEL_KO';
        }

        $this->feedback['plan'] = array('plan_id' => $proc['plan_id']);
        return $this->feedback;
    }

    function EDIT() {
        $this->feedback = $this->seek();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $proc = $this->feedback['resource'];

        $validation = $this->validar_atributos();
        if(!$validation['ok']) {
            $validation['plan'] = array('plan_id' => $proc['plan_id']);
            return $validation;
        }

        if($this->nombre != $proc['nombre']) {
            $this->defProc_entity->plan_id = $proc['plan_id'];
            $this->feedback = $this->name_proc_not_exist();
            if(!$this->feedback['ok']) {
                $this->feedback['plan'] = array('plan_id' => $proc['plan_id']);
                return $this->feedback;
            }
        }

        $this->feedback = $this->defProc_entity->EDIT();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'DFPROC_EDT_OK';
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'DFPROC_EDT_KO';
        }

        $this->feedback['plan'] = array('plan_id' => $proc['plan_id']);
        return $this->feedback;
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

    function name_proc_not_exist() {
        $feedback = $this->defProc_entity->seekByProcName();
        if($feedback['ok']) {
            if($feedback['code'] != 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'DFPROC_NAME_EXST';
            } else {
                $feedback['code'] = 'DFPROC_NAME_NOT_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'DFPROC_NAME_KO';
        }

        return $feedback;
    }

    function imp_procs_not_exist() {
        include_once './Model/ImpProc_Model.php';
        $impProc_entity = new ImpProc_Model();
        $feedback = $impProc_entity->searchByProcID();
        if($feedback['ok']) {
            if($feedback['code'] != 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'DFPROC_IMPL_EXST';
            } else {
                $feedback['code'] = 'DFPROC_IMPL_NOT_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'DFPROC_IMPL_KO';
        }

        return $feedback;
    }
}
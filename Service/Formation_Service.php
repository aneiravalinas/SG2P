<?php

include_once './Validation/Formation_Validation.php';
include_once './Model/DefFormat_Model.php';
include_once './Model/ImpFormat_Model.php';

class Formation_Service extends Formation_Validation {
    var $atributos;
    var $defFormat_entity;
    var $impFormat_entity;
    var $feedback = array();

    function __construct() {
        date_default_timezone_set("Europe/Madrid");
        $this->atributos = array('edificio_formacion_id', 'edificio_id', 'formacion_id', 'estado', 'fecha_planificacion', 'url_recurso', 'destinatarios', 'nombre_edificio');
        $this->defFormat_entity = new DefFormat_Model();
        $this->impFormat_entity = new ImpFormat_Model();
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
    }

    function searchImpFormats() {
        $this->feedback = $this->seekFormation();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $format = $this->feedback['resource'];
        $validation = $this->validar_atributos_search_implements();
        if(!$validation['ok']) {
            $validation['formation'] = array('formacion_id' => $format['formacion_id']);
            return $validation;
        }

        $this->feedback = $this->impFormat_entity->SEARCH();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'IMPFORMAT_SEARCH_OK';
            $this->feedback['formation'] = $format;
        } else {
            $this->feedback['formation'] = array('formacion_id' => $format['formacion_id']);
            if($this->feedback['code'] == 'QRY_KO') {
                $this->feedback['code'] = 'IMPFORMAT_SEARCH_KO';
            }
        }

        return $this->feedback;
    }

    function searchFormation() {
        $this->feedback = $this->searchFormatAndBuilding();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $building = $this->feedback['building'];
        $formation = $this->feedback['formation'];
        if(es_resp_edificio() && $building['username'] != getUser()) {
            $this->feedback['ok'] = false;
            $this->feedback['code'] = 'BLD_FRBD';
            unset($this->feedback['resource'], $this->feedback['building'], $this->feedback['formation']);
            return $this->feedback;
        }

        $validation = $this->validar_atributos_search();
        if(!$validation['ok']) {
            $validation['return'] = array('formacion_id' => $formation['formacion_id'], 'edificio_id' => $building['edificio_id']);
            return $validation;
        }

        $format_state = $this->get_formation_state();
        if(!$format_state['ok']) {
            $format_state['return'] = array('formacion_id' => $formation['formacion_id'], 'edificio_id' => $building['edificio_id']);
            return $format_state;
        }

        $formation['estado'] = $format_state['estado'];
        $this->feedback = $this->impFormat_entity->searchImpFormats();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'IMPFORMAT_SEARCH_OK';
            $this->feedback['formation'] = $formation;
            $this->feedback['building'] = $building;
        } else {
            $this->feedback['return'] = array('formacion_id' => $formation['formacion_id'], 'edificio_id' => $building['edificio_id']);
            if($this->feedback['code'] == 'QRY_KO') {
                $this->feedback['code'] = 'IMPFORMAT_SEARCH_KO';
            }
        }

        return $this->feedback;
    }

    function seekPortalFormation() {
        $this->feedback = $this->searchFormatAndBuilding();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $bld_plan = $this->feedback['resource'];
        $building = $this->feedback['building'];
        $formation = $this->feedback['formation'];

        if($bld_plan['estado'] == 'vencido') {
            $this->feedback['ok'] = false;
            $this->feedback['code'] = 'BLDFORMAT_NOT_EXST';
            unset($this->feedback['resource'], $this->feedback['formation'], $this->feedback['building']);
            return $this->feedback;
        }

        $format_state = $this->get_formation_state();
        if(!$format_state['ok']) {
            return $format_state;
        }

        if($format_state['estado'] == 'vencido') {
            $this->feedback['ok'] = false;
            $this->feedback['code'] = 'DFFRMTID_NOT_EXST';
            unset($this->feedback['resource'], $this->feedback['formation'], $this->feedback['building']);
            $this->feedback['return'] = array('formacion_id' => $formation['formacion_id'], 'edificio_id' => $building['edificio_id']);
            return $this->feedback;
        }

        $formation['estado'] = $format_state['estado'];
        $this->feedback = $this->impFormat_entity->searchActiveImpFormats();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'PRTL_IMPFORMAT_SEARCH_OK';
            $this->feedback['formation'] = $formation;
            $this->feedback['building'] = $building;
        } else {
            $this->feedback['return'] = array('formacion_id' => $formation['formacion_id'], 'edificio_id' => $building['edificio_id']);
            if($this->feedback['code'] == 'QRY_KO') {
                $this->feedback['code'] = 'PRTL_IMPFORMAT_SEARCH_KO';
            }
        }

        return $this->feedback;
    }

    function addImpFormatForm() {
        $this->feedback = $this->seekFormation();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $formation = $this->feedback['resource'];
        $this->feedback = $this->searchBuildPlans($formation['plan_id']);
        if($this->feedback['ok']) {
            $this->feedback['formation'] = $formation;
        } else {
            $this->feedback['formation'] = array('formacion_id' => $formation['formacion_id']);
        }

        return $this->feedback;
    }

    function addFormationForm() {
        $this->feedback = $this->searchFormatAndBuilding();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $building = $this->feedback['building'];
        if(es_resp_edificio() && $building['username'] != getUser()) {
            $this->feedback['ok'] = false;
            $this->feedback['code'] = 'BLD_FRBD';
            unset($this->feedback['resource'], $this->feedback['formation'], $this->feedback['building']);
        }

        return $this->feedback;
    }

    function addImpFormat() {
        $validation = $this->validar_atributos_add();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByFormatID();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $formation = $this->feedback['resource'];
        $this->feedback = $this->ADD($formation);
        $this->feedback['formation'] = array('formacion_id' => $formation['formacion_id']);
        return $this->feedback;
    }

    function ADD($formation) {
        if(empty($this->buildings)) {
            $feedback['ok'] = true;
            $feedback['code'] = 'IMPFORMAT_ADD_OK';
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

        $feedback = $this->seekPlanBuilding($formation['plan_id']);
        if(!$feedback['ok']) {
            return $feedback;
        }

        $this->impFormat_entity->setAttributes(array('edificio_id' => $this->edificio_id, 'fecha_planificacion' => default_data, 'destinatarios' => default_destinatarios,
                                                            'url_recurso' => default_url, 'estado' => 'pendiente'));
        $feedback = $this->impFormat_entity->ADD();
        if($feedback['ok']) {
            $edificio_formacion_id = $this->impFormat_entity->edificio_formacion_id;
            $feedback = $this->ADD($formation);
            if($feedback['ok']) {
                $feedback['building'] = array('edificio_id' => $building['edificio_id']);
                $this->update_plan_state($building['edificio_id'], $formation['plan_id']);
                return $feedback;
            }
            $this->impFormat_entity->edificio_formacion_id = $edificio_formacion_id;
            $this->impFormat_entity->DELETE();
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'IMPFORMAT_ADD_KO';
        }

        $feedback['building'] = array('edificio_id' => $building['edificio_id']);
        return $feedback;
    }

    function DELETE() {
        $this->feedback = $this->seek();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $imp_format = $this->feedback['resource'];
        $this->feedback = $this->check_more_than_one_impformats($imp_format['edificio_id'], $imp_format['formacion_id']);
        if(!$this->feedback['ok']) {
            $this->feedback['return'] = array('edificio_id' => $imp_format['edificio_id'], 'formacion_id' => $imp_format['formacion_id']);
            return $this->feedback;
        }

        $this->feedback = $this->impFormat_entity->DELETE();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'IMPFORMAT_DEL_OK';
            $this->update_plan_state($imp_format['edificio_id'], $imp_format['plan_id']);
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'IMPFORMAT_DEL_KO';
        }

        $this->feedback['return'] = array('edificio_id' => $imp_format['edificio_id'], 'formacion_id' => $imp_format['formacion_id']);
        return $this->feedback;
    }

    function seek() {
        $validation = $this->validar_EDIFICIO_FORMACION_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByImpFormatID();
        if($this->feedback['ok']) {
            $imp_format = $this->feedback['resource'];
            if(es_resp_edificio() && $imp_format['username'] != getUser()) {
                $this->feedback['ok'] = false;
                $this->feedback['code'] = 'BLD_FRBD';
                unset($this->feedback['resource']);
                return $this->feedback;
            }

            $this->feedback['code'] = 'IMPFORMAT_SEEK_OK';
        } else if($this->feedback['code'] = 'IMPFORMATID_KO') {
            $this->feedback['code'] = 'IMPFORMAT_SEEK_KO';
        }

        return $this->feedback;
    }

    function expire() {
        $this->feedback = $this->seek();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $imp_format = $this->feedback['resource'];
        $this->impFormat_entity->estado = 'vencido';
        $this->feedback = $this->impFormat_entity->EDIT();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'IMPFORMAT_EXPIRE_OK';
            $this->update_plan_state($imp_format['edificio_id'], $imp_format['plan_id']);
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'IMPFORMAT_EXPIRE_KO';
        }

        $this->feedback['return'] = array('edificio_id' => $imp_format['edificio_id'], 'formacion_id' => $imp_format['formacion_id']);
        return $this->feedback;
    }

    function implement() {
        $this->feedback = $this->seek();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $imp_format = $this->feedback['resource'];
        if($imp_format['estado'] == 'vencido') {
            $this->feedback['ok'] = false;
            $this->feedback['code'] = 'COMPL_EXPIRED';
            $this->feedback['return'] = array('edificio_id' => $imp_format['edificio_id'], 'formacion_id' => $imp_format['formacion_id']);
            return $this->feedback;
        }

        $validation = $this->validar_atributos_implement();
        if(!$validation['ok']) {
            $validation['return'] = array('edificio_id' => $imp_format['edificio_id'], 'formacion_id' => $imp_format['formacion_id']);
            return $validation;
        }

        $this->impFormat_entity->estado = 'cumplimentado';
        $this->feedback = $this->impFormat_entity->EDIT();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'IMPFORMAT_IMPL_OK';
            $this->update_plan_state($imp_format['edificio_id'], $imp_format['plan_id']);
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'IMPFORMAT_IMPL_KO';
        }

        $this->feedback['return'] = array('edificio_id' => $imp_format['edificio_id'], 'formacion_id' => $imp_format['formacion_id']);
        return$this->feedback;
    }

    function searchFormatAndBuilding() {
        $validation = $this->validar_format_and_building();
        if(!$validation['ok']) {
            return $validation;
        }

        $feedback = $this->seekByFormatID();
        if(!$feedback['ok']) {
            return $feedback;
        }

        $formation = $feedback['resource'];
        $feedback = $this->seekByBuildingID();
        if(!$feedback['ok']) {
            return $feedback;
        }

        $building = $feedback['resource'];
        $feedback = $this->seekPlanBuilding($formation['plan_id']);
        if(!$feedback['ok']) {
            return $feedback;
        }

        $feedback['formation'] = $formation;
        $feedback['building'] = $building;
        return $feedback;
    }

    function seekFormation() {
        $validation = $this->validar_FORMACION_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        return $this->seekByFormatID();
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
                $feedback['code'] = 'BLDFORMAT_NOT_EXST';
            } else {
                $feedback['code'] = 'BLDFORMAT_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'BLDFORMAT_KO';
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

    function seekByImpFormatID() {
        $feedback = $this->impFormat_entity->seek();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'IMPFORMATID_NOT_EXST';
            } else {
                $feedback['code'] = 'IMPFORMATID_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'IMPFORMATID_KO';
        }

        return $feedback;
    }

    function get_formation_state() {
        $feedback = $this->search_all_impformats();
        if(!$feedback['ok']) {
            return $feedback;
        }

        include_once './Service/CheckState_Service.php';
        $checkState_service = new CheckState_Service();
        $estado = $checkState_service->check_state($feedback['resource']);
        return array('ok' => true, 'estado' => $estado);
    }

    function search_all_impformats() {
        $feedback = $this->impFormat_entity->searchFormatsBuildings();
        if($feedback['ok']) {
            $feedback['code'] = 'BLDFORMATS_SEARCH_OK';
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'BLDFORMATS_SEARCH_KO';
        }

        return $feedback;
    }

    function update_plan_state($edificio_id, $plan_id) {
        include_once './Service/CheckState_Service.php';
        $checkState_service = new CheckState_Service($edificio_id, $plan_id);
        $checkState_service->update_plan_state();
    }

    function searchBuildPlans($plan_id) {
        include_once './Model/BuildPlan_Model.php';
        $bldPlan_entity = new BuildPlan_Model();
        $bldPlan_entity->plan_id = $plan_id;
        $feedback = $bldPlan_entity->searchByPlanID();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'BLDPLAN_ASSIGN_NOT_EXST';
            } else {
                $feedback['code'] = 'BLDPLAN_ASSIGN_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'BLDPLAN_KO';
        }

        return $feedback;
    }

    function check_more_than_one_impformats($edificio_id, $formacion_id) {
        $this->impFormat_entity->setAttributes(array('edificio_id' => $edificio_id, 'formacion_id' => $formacion_id));
        $feedback = $this->impFormat_entity->searchFormatsBuildings();
        if($feedback['ok']) {
            if(count($feedback['resource']) <= 1) {
                $feedback['ok'] = false;
                $feedback['code'] = 'IMPFORMAT_UNIQ';
            } else {
                $feedback['code'] = 'IMPFORMAT_NOT_UNIQ';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'IMPFORMAT_SEARCH_KO';
        }

        return $feedback;
    }
}
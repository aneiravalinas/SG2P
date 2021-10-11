<?php

include_once './Validation/Simulacrum_Validation.php';
include_once './Model/ImpSim_Model.php';
include_once './Model/DefSim_Model.php';

class Simulacrum_Service extends Simulacrum_Validation {
    var $atributos;
    var $defSim_entity;
    var $impSim_entity;
    var $feedback = array();

    function __construct() {
        date_default_timezone_set("Europe/Madrid");
        $this->atributos = array('edificio_simulacro_id','simulacro_id','edificio_id','estado','fecha_planificacion', 'fecha_planificacion_inicio','fecha_planificacion_fin',
            'fecha_vencimiento', 'fecha_vencimiento_inicio', 'fecha_vencimiento_fin', 'url_recurso','destinatarios','nombre_edificio');
        $this->defSim_entity = new DefSim_Model();
        $this->impSim_entity = new ImpSim_Model();
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

    function searchImpSims() {
        $this->feedback = $this->seekSimulacrum();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $simulacrum = $this->feedback['resource'];
        $validation = $this->validar_atributos_search_implements();
        if(!$validation['ok']) {
            $validation['return'] = array('simulacro_id' => $simulacrum['simulacro_id']);
            return $validation;
        }

        $this->feedback = $this->impSim_entity->SEARCH();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'IMPSIM_SEARCH_OK';
            $this->feedback['simulacrum'] = $simulacrum;
        } else {
            $this->feedback['simulacrum'] = array('simulacro_id' => $simulacrum['simulacro_id']);
            if($this->feedback['code'] == 'QRY_KO') {
                $this->feedback['code'] = 'IMPSIM_SEARCH_KO';
            }
        }

        return $this->feedback;
    }

    function searchSimulacrum() {
        $this->feedback = $this->searchSimAndBuilding();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $building = $this->feedback['building'];
        $simulacrum = $this->feedback['simulacrum'];
        if(es_resp_edificio() && $building['username'] != getUser()) {
            $this->feedback['ok'] = false;
            $this->feedback['code'] = 'BLD_FRBD';
            unset($this->feedback['resource'], $this->feedback['building'], $this->feedback['simulacrum']);
            return $this->feedback;
        }

        $validation = $this->validar_atributos_search();
        if(!$validation['ok']) {
            $validation['return'] = array('simulacro_id' => $simulacrum['simulacro_id'], 'edificio_id' => $building['edificio_id']);
            return $validation;
        }

        $sim_state = $this->get_simulacrum_state();
        if(!$sim_state['ok']) {
            $sim_state['return'] = array('simulacro_id' => $simulacrum['simulacro_id'], 'edificio_id' => $building['edificio_id']);
            return $sim_state;
        }

        $simulacrum['estado'] = $sim_state['estado'];
        $this->feedback = $this->impSim_entity->searchImpSims();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'IMPSIM_SEARCH_OK';
            $this->feedback['simulacrum'] = $simulacrum;
            $this->feedback['building'] = $building;
        } else {
            $this->feedback['return'] = array('simulacro_id' => $simulacrum['simulacro_id'], 'edificio_id' => $building['edificio_id']);
            if($this->feedback['code'] == 'QRY_KO') {
                $this->feedback['code'] = 'IMPSIM_SEARCH_KO';
            }
        }

        return $this->feedback;
    }

    function seekPortalSimulacrum() {
        $this->feedback = $this->searchSimAndBuilding();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $bld_plan = $this->feedback['resource'];
        $building = $this->feedback['building'];
        $simulacrum = $this->feedback['simulacrum'];

        if($bld_plan['estado'] == 'vencido') {
            $this->feedback['ok'] = false;
            $this->feedback['code'] = 'BLDSIM_NOT_EXST';
            unset($this->feedback['resource'], $this->feedback['simulacrum'], $this->feedback['building']);
            return $this->feedback;
        }

        $sim_state = $this->get_simulacrum_state();
        if(!$sim_state['ok']) {
            return $sim_state;
        }

        if($sim_state['estado'] == 'vencido') {
            $this->feedback['ok'] = false;
            $this->feedback['code'] = 'DFSIMID_NOT_EXST';
            unset($this->feedback['resource'], $this->feedback['simulacrum'], $this->feedback['building']);
            return $this->feedback;
        }

        $simulacrum['estado'] = $sim_state['estado'];
        $validation = $this->validar_atributos_search_portal();
        if(!$validation['ok']) {
            $validation['return'] = array('simulacro_id' => $simulacrum['simulacro_id'], 'edificio_id' => $building['edificio_id']);
            return $validation;
        }

        $this->feedback = $this->impSim_entity->searchActiveImpSims();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'PRTL_IMPSIM_SEARCH_OK';
            $this->feedback['simulacrum'] = $simulacrum;
            $this->feedback['building'] = $building;
        } else {
            $this->feedback['return'] = array('simulacro_id' => $simulacrum['simulacro_id'], 'edificio_id' => $building['edificio_id']);
            if($this->feedback['code'] == 'QRY_KO') {
                $this->feedback['code'] = 'PRTL_IMPSIM_SEARCH_KO';
            }
        }

        return $this->feedback;
    }

    function searchPortalSimulacrumForm() {
        $this->feedback = $this->searchSimAndBuilding();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $bld_plan = $this->feedback['resource'];
        if($bld_plan['estado'] == 'vencido') {
            $this->feedback['ok'] = false;
            $this->feedback['code'] = 'BLDSIM_NOT_EXST';
            unset($this->feedback['resource'], $this->feedback['simulacrum'], $this->feedback['building']);
        }

        return $this->feedback;
    }

    function addImpSimForm() {
        $this->feedback = $this->seekSimulacrum();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $simulacrum = $this->feedback['resource'];
        $this->feedback = $this->searchActiveBuildPlans($simulacrum['plan_id']);
        if($this->feedback['ok']) {
            $this->feedback['simulacrum'] = $simulacrum;
        } else {
            $this->feedback['simulacrum'] = array('simulacro_id' => $simulacrum['simulacro_id']);
        }

        return $this->feedback;
    }

    function simulacrumForm() {
        $this->feedback = $this->searchSimAndBuilding();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $building = $this->feedback['resource'];
        if(es_resp_edificio() && $building['username'] != getUser()) {
            $this->feedback['ok'] = false;
            $this->feedback['code'] = 'BLD_FRBD';
            unset($this->feedback['resource'], $this->feedback['simulacrum'], $this->feedback['building']);
        }

        return $this->feedback;
    }

    function addImpSim() {
        $validation = $this->validar_atributos_add();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekBySimID();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $simulacrum = $this->feedback['resource'];
        $this->feedback = $this->ADD($simulacrum);
        $this->feedback['simulacrum'] = array('simulacro_id' => $simulacrum['simulacro_id']);
        return $this->feedback;
    }

    function ADD($simulacrum) {
        if(empty($this->buildings)) {
            $feedback['ok'] = true;
            $feedback['code'] = 'IMPSIM_ADD_OK';
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

        $feedback = $this->seekPlanBuilding($simulacrum['plan_id']);
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

        $this->impSim_entity->setAttributes(array('edificio_id' => $this->edificio_id, 'fecha_planificacion' => default_data, 'destinatarios' => default_destinatarios,
                                                    'fecha_vencimiento' => default_data, 'url_recurso' => default_url, 'estado' => 'pendiente'));
        $feedback = $this->impSim_entity->ADD();
        if($feedback['ok']) {
            $edificio_simulacro_id = $this->impSim_entity->edificio_simulacro_id;
            $feedback = $this->ADD($simulacrum);
            if($feedback['ok']) {
                $feedback['building'] = array('edificio_id' => $building['edificio_id']);
                $this->update_plan_state($building['edificio_id'], $simulacrum['plan_id']);
                return $feedback;
            }
            $this->impSim_entity->edificio_simulacro_id = $edificio_simulacro_id;
            $this->impSim_entity->DELETE();
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'IMPSIM_ADD_KO';
        }

        $feedback['building'] = array('edificio_id' => $building['edificio_id']);
        return $feedback;
    }

    function DELETE() {
        $this->feedback = $this->seek();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $imp_sim = $this->feedback['resource'];
        if(es_resp_edificio()) {
            $this->feedback = $this->check_more_than_one_impsims($imp_sim['edificio_id'], $imp_sim['simulacro_id']);
            if(!$this->feedback['ok']) {
                $this->feedback['return'] = array('edificio_id' => $imp_sim['edificio_id'], 'simulacro_id' => $imp_sim['simulacro_id']);
                return $this->feedback;
            }
        }

        $this->feedback = $this->impSim_entity->DELETE();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'IMPSIM_DEL_OK';
            $this->update_plan_state($imp_sim['edificio_id'], $imp_sim['plan_id']);
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'IMPSIM_DEL_KO';
        }

        $this->feedback['return'] = array('edificio_id' => $imp_sim['edificio_id'], 'simulacro_id' => $imp_sim['simulacro_id']);
        return $this->feedback;
    }

    function expire() {
        $this->feedback = $this->seek();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $imp_sim = $this->feedback['resource'];
        $this->impSim_entity->estado = 'vencido';
        $this->impSim_entity->fecha_vencimiento = date('Y-m-d');
        $this->feedback = $this->impSim_entity->EDIT();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'IMPSIM_EXPIRE_OK';
            $this->update_plan_state($imp_sim['edificio_id'], $imp_sim['plan_id']);
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'IMPSIM_EXPIRE_KO';
        }

        $this->feedback['return'] = array('edificio_id' => $imp_sim['edificio_id'], 'simulacro_id' => $imp_sim['simulacro_id']);
        return $this->feedback;
    }

    function implement() {
        $this->feedback = $this->seek();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $imp_sim = $this->feedback['resource'];
        if($imp_sim['estado'] == 'vencido') {
            $this->feedback['ok'] = false;
            $this->feedback['code'] = 'COMPL_EXPIRED';
            $this->feedback['return'] = array('edificio_id' => $imp_sim['edificio_id'], 'simulacro_id' => $imp_sim['simulacro_id']);
            return $this->feedback;
        }

        $validation = $this->validar_atributos_implement();
        if(!$validation['ok']) {
            $validation['return'] = array('edificio_id' => $imp_sim['edificio_id'], 'simulacro_id' => $imp_sim['simulacro_id']);
            return $validation;
        }

        $this->impSim_entity->estado = 'cumplimentado';
        $this->feedback = $this->impSim_entity->EDIT();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'IMPSIM_IMPL_OK';
            $this->update_plan_state($imp_sim['edificio_id'], $imp_sim['plan_id']);
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'IMPSIM_IMPL_KO';
        }

        $this->feedback['return'] = array('edificio_id' => $imp_sim['edificio_id'], 'simulacro_id' => $imp_sim['simulacro_id']);
        return $this->feedback;
    }

    function seek() {
        $validation = $this->validar_EDIFICIO_SIMULACRO_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByImpSimID();
        if($this->feedback['ok']) {
            $imp_sim = $this->feedback['resource'];
            if(es_resp_edificio() && $imp_sim['username'] != getUser()) {
                $this->feedback['ok'] = false;
                $this->feedback['code'] = 'BLD_FRBD';
                unset($this->feedback['resource']);
                return $this->feedback;
            }

            $this->feedback['code'] = 'IMPSIM_SEEK_OK';
        } else if($this->feedback['code'] == 'IMPSIMID_KO') {
            $this->feedback['code'] = 'IMPSIM_SEEK_KO';
        }

        return $this->feedback;
    }

    function seekPortalImpSim() {
        $validation = $this->validar_EDIFICIO_SIMULACRO_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByImpSimID();
        if($this->feedback['ok']) {
            $imp_sim = $this->feedback['resource'];
            if($imp_sim['estado'] == 'vencido') {
                $this->feedback['ok'] = false;
                $this->feedback['code'] = 'IMPSIMID_NOT_EXST';
                unset($this->feedback['resource']);
            } else {
                $this->feedback['code'] = 'PRTL_IMPSIM_SEEK_OK';
            }
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'PRTL_IMPSIM_SEEK_KO';
        }

        return $this->feedback;
    }

    function searchSimAndBuilding() {
        $validation = $this->validar_sim_and_building();
        if(!$validation['ok']) {
            return $validation;
        }

        $feedback = $this->seekBySimID();
        if(!$feedback['ok']) {
            return $feedback;
        }

        $simulacrum = $feedback['resource'];
        $feedback = $this->seekByBuildingID();
        if(!$feedback['ok']) {
            return $feedback;
        }

        $building = $feedback['resource'];
        $feedback = $this->seekPlanBuilding($simulacrum['plan_id']);
        if(!$feedback['ok']) {
            return $feedback;
        }

        $feedback['simulacrum'] = $simulacrum;
        $feedback['building'] = $building;
        return $feedback;
    }

    function seekSimulacrum() {
        $validation = $this->validar_SIMULACRO_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        return $this->seekBySimID();
    }

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
                $feedback['code'] = 'BLDSIM_NOT_EXST';
            } else {
                $feedback['code'] = 'BLDSIM_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'BLDSIM_KO';
        }

        return $feedback;
    }

    function seekByImpSimID() {
        $feedback = $this->impSim_entity->seek();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'IMPSIMID_NOT_EXST';
            } else {
                $feedback['code'] = 'IMPSIMID_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'IMPSIMID_KO';
        }

        return $feedback;
    }

    function get_simulacrum_state() {
        $feedback = $this->search_all_impsims();
        if(!$feedback['ok']) {
            return $feedback;
        }

        include_once './Service/CheckState_Service.php';
        $checkState_service = new CheckState_Service();
        $estado = $checkState_service->get_state_element($feedback['resource']);
        return array('ok' => true, 'estado' => $estado);
    }

    function search_all_impsims() {
        $feedback = $this->impSim_entity->searchSimsBuildings();
        if($feedback['ok']) {
            $feedback['code'] = 'BLDSIMS_SEARCH_OK';
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'BLDSIMS_SEARCH_KO';
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

    function update_plan_state($edificio_id, $plan_id) {
        include_once './Service/CheckState_Service.php';
        $checkState_service = new CheckState_Service($edificio_id, $plan_id);
        $checkState_service->update_plan_state();
    }

    function check_more_than_one_impsims($edificio_id, $simulacro_id) {
        $this->impSim_entity->setAttributes(array('edificio_id' => $edificio_id, 'simulacro_id' => $simulacro_id));
        $feedback = $this->impSim_entity->searchSimsBuildings();
        if($feedback['ok']) {
            if(count($feedback['resource']) <= 1) {
                $feedback['ok'] = false;
                $feedback['code'] = 'IMPSIM_UNIQ';
            } else {
                $feedback['code'] = 'IMPSIM_NOT_UNIQ';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'IMPSIM_SEARCH_KO';
        }

        return $feedback;
    }

}
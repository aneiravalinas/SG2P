<?php

include_once './Validation/Procedure_Validation.php';
include_once './Model/DefProc_Model.php';
include_once './Model/ImpProc_Model.php';

class Procedure_Service extends Procedure_Validation {
    var $atributos;
    var $defProc_entity;
    var $impProc_entity;
    var $feedback = array();

    function __construct() {
        date_default_timezone_set("Europe/Madrid");
        $this->atributos = array('edificio_procedimiento_id','edificio_id','procedimiento_id','estado','fecha_cumplimentacion', 'fecha_cumplimentacion_inicio', 'fecha_cumplimentacion_fin',
            'fecha_vencimiento','fecha_vencimiento_inicio', 'fecha_vencimiento_fin','nombre_doc', 'nombre_edificio');
        $this->defProc_entity = new DefProc_Model();
        $this->impProc_entity = new ImpProc_Model();
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

    function searchImpProcs() {
        $this->feedback = $this->seekProcedure();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $proc = $this->feedback['resource'];
        $validation = $this->validar_atributos_search_implements();
        if(!$validation['ok']) {
            $validation['procedure'] = array('procedimiento_id' => $proc['procedimiento_id']);
            return $validation;
        }

        $this->feedback = $this->impProc_entity->SEARCH();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'IMPPROC_SEARCH_OK';
            $this->feedback['procedure'] = $proc;
        } else {
            $this->feedback['procedure'] = array('procedimiento_id' => $proc['procedimiento_id']);
            if($this->feedback['code'] == 'QRY_KO') {
                $this->feedback['code'] = 'IMPPROC_SEARCH_KO';
            }
        }

        return $this->feedback;
    }

    function searchProcedure() {
        $this->feedback = $this->searchProcAndBuilding();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $procedure = $this->feedback['procedure'];
        $building = $this->feedback['building'];
        if(es_resp_edificio() && $building['username'] != getUser()) {
            $this->feedback['ok'] = false;
            $this->feedback['code'] = 'BLD_FRBD';
            unset($this->feedback['resource'], $this->feedback['document'], $this->feedback['building']);
            return $this->feedback;
        }

        $validation = $this->validar_atributos_search();
        if(!$validation['ok']) {
            $validation['return'] = array('procedimiento_id' => $procedure['procedimiento_id'], 'edificio_id' => $building['edificio_id']);
            return $validation;
        }

        $proc_state = $this->get_procedure_state();
        if(!$proc_state['ok']) {
            $proc_state['return'] = array('procedimiento_id' => $procedure['procedimiento_id'], 'edificio_id' => $building['edificio_id']);
            return $proc_state;
        }

        $procedure['estado'] = $proc_state['estado'];
        $this->feedback = $this->impProc_entity->searchImpProcs();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'IMPPROC_SEARCH_OK';
            $this->feedback['procedure'] = $procedure;
            $this->feedback['building'] = $building;
        } else {
            $this->feedback['return'] = array('procedimiento_id' => $procedure['procedimiento_id'], 'edificio_id' => $building['edificio_id']);
            if($this->feedback['code'] == 'QRY_KO') {
                $this->feedback['code'] = 'IMPPROC_SEARCH_KO';
            }
        }

        return $this->feedback;
    }

    function seekPortalProcedure() {
        $this->feedback = $this->searchProcAndBuilding();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $bld_plan = $this->feedback['resource'];
        $building = $this->feedback['building'];
        $procedure = $this->feedback['procedure'];

        if($bld_plan['estado'] == 'vencido') {
            $this->feedback['ok'] = false;
            $this->feedback['code'] = 'BLDPROC_NOT_EXST';
            unset($this->feedback['resource'], $this->feedback['procedure'], $this->feedback['building']);
            return $this->feedback;
        }

        $proc_state = $this->get_procedure_state();
        if(!$proc_state['ok']) {
            return $proc_state;
        }

        if($proc_state['estado'] == 'vencido') {
            $this->feedback['ok'] = false;
            $this->feedback['code'] = 'DFPROCID_NOT_EXST';
            unset($this->feedback['resource'], $this->feedback['procedure'], $this->feedback['building']);
            $this->feedback['return'] = array('plan_id' => $procedure['plan_id'], 'edificio_id' => $building['edificio_id']);
            return $this->feedback;
        }

        $procedure['estado'] = $proc_state['estado'];
        $this->feedback = $this->impProc_entity->searchActiveImpProcs();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'PRTL_IMPPROC_SEARCH_OK';
            $this->feedback['procedure'] = $procedure;
            $this->feedback['building'] = $building;
        } else {
            $this->feedback['return'] = array('plan_id' => $procedure['plan_id'], 'edificio_id' => $building['edificio_id']);
            if($this->feedback['code'] == 'QRY_KO') {
                $this->feedback['code'] = 'PRTL_IMPPROC_SEARCH_KO';
            }
        }

        return $this->feedback;
    }

    function searchProcedureForm() {
        $this->feedback = $this->searchProcAndBuilding();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        if(es_resp_edificio()) {
            $building = $this->feedback['building'];
            if($building['username'] != getUser()) {
                $this->feedback['ok'] = false;
                $this->feedback['code'] = 'BLD_FRBD';
                unset($this->feedback['resource'], $this->feedback['procedure'], $this->feedback['building']);
            }
        }

        return $this->feedback;
    }

    function addImpProcForm() {
        $this->feedback = $this->seekProcedure();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $procedure = $this->feedback['resource'];
        $this->feedback = $this->searchActiveBuildPlans($procedure['plan_id']);
        if($this->feedback['ok']) {
            $this->feedback['procedure'] = $procedure;
        } else {
            $this->feedback['procedure'] = array('procedimiento_id' => $procedure['procedimiento_id']);
        }

        return $this->feedback;
    }

    function addImpProc() {
        $validation = $this->validar_atributos_add();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByProcID();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $procedure = $this->feedback['resource'];
        $this->feedback = $this->ADD($procedure);
        $this->feedback['procedure'] = array('procedimiento_id' => $procedure['procedimiento_id']);
        return $this->feedback;
    }

    function addProcedureForm() {
        $this->feedback = $this->searchProcAndBuilding();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $building = $this->feedback['building'];
        if(es_resp_edificio() && $building['username'] != getUser()) {
            $this->feedback['ok'] = false;
            $this->feedback['code'] = 'BLD_FRBD';
            unset($this->feedback['resource'], $this->feedback['procedure'], $this->feedback['building']);
        }

        return $this->feedback;
    }

    function ADD($procedure) {
        if(empty($this->buildings)) {
            $feedback['ok'] = true;
            $feedback['code'] = 'IMPPROC_ADD_OK';
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

        $feedback = $this->seekPlanBuilding($procedure['plan_id']);
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

        $feedback = $this->proc_building_actives_not_exist();
        if(!$feedback['ok']) {
            $feedback['building'] = array('edificio_id' => $building['edificio_id']);
            return $feedback;
        }

        include_once './Service/Uploader_Service.php';
        $uploader = new Uploader();
        $path = plans_path . $procedure['plan_id'] . '/' . $this->edificio_id . '/Procedimientos/';
        $def_dir_crated = false;
        if(!$uploader->dir_exist($path . $this->procedimiento_id)['ok']) {
            $feedback = $uploader->create_dir($path, $this->procedimiento_id);
            if(!$feedback['ok']) {
                $feedback['building'] = array('edificio_id' => $building['edificio_id']);
                $feedback['code'] = 'BLDPLAN_DIRPROC_KO';
                return $feedback;
            }
            $def_dir_crated = true;
        }

        $this->impProc_entity->setAttributes(array('edificio_id' => $this->edificio_id, 'nombre_doc' => default_doc, 'fecha_vencimiento' => default_data,
                                                    'fecha_cumplimentacion' => default_data, 'estado' => 'pendiente'));
        $feedback = $this->impProc_entity->ADD();
        if($feedback['ok']) {
            $imp_proc_id = $this->impProc_entity->edificio_procedimiento_id;
            $feedback = $this->ADD($procedure);
            if($feedback['ok']) {
                $feedback['building'] = array('edificio_id' => $building['edificio_id']);
                $this->update_plan_state($building['edificio_id'], $procedure['plan_id']);
                return $feedback;
            }
            $this->impProc_entity->edificio_procedimiento_id = $imp_proc_id;
            $this->impProc_entity->DELETE();
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'IMPPROC_ADD_KO';
        }

        if($def_dir_crated) {
            $uploader->delete($path . $this->procedimiento_id);
        }

        $feedback['building'] = array('edificio_id' => $building['edificio_id']);
        return $feedback;
    }

    function DELETE() {
        $this->feedback = $this->seek();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $imp_proc = $this->feedback['resource'];
        $path = $imp_proc['path'];

        if(es_resp_edificio()) {
            $this->feedback = $this->check_more_than_one_impprocs($imp_proc['edificio_id'], $imp_proc['procedimiento_id']);
            if(!$this->feedback['ok']) {
                $this->feedback['return'] = array('edificio_id' => $imp_proc['edificio_id'], 'procedimiento_id' => $imp_proc['procedimiento_id']);
                return $this->feedback;
            }
        }

        $this->feedback = $this->impProc_entity->DELETE();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'IMPPROC_DEL_OK';
            include_once './Service/Uploader_Service.php';
            $uploader = new Uploader();
            if($uploader->dir_exist($path)['ok']) {
                $uploader->delete_all($path);
            }
            $this->update_plan_state($imp_proc['edificio_id'], $imp_proc['plan_id']);
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'IMPPROC_DEL_KO';
        }

        $this->feedback['return'] = array('edificio_id' => $imp_proc['edificio_id'], 'procedimiento_id' => $imp_proc['procedimiento_id']);
        return $this->feedback;
    }


    function seek() {
        $validation = $this->validar_EDIFICIO_PROCEDIMIENTO_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByImpProcID();
        if($this->feedback['ok']) {
            $imp_proc = $this->feedback['resource'];
            if(es_resp_edificio() && $imp_proc['username'] != getUser()) {
                $this->feedback['ok'] = false;
                $this->feedback['code'] = 'BLD_FRBD';
                unset($this->feedback['resource']);
                return $this->feedback;
            }

            $this->feedback['resource']['path'] = plans_path . $imp_proc['plan_id'] . '/' . $imp_proc['edificio_id'] . '/Procedimientos/' .
                                                    $imp_proc['procedimiento_id'] . '/' . $imp_proc['edificio_procedimiento_id'];
            $this->feedback['code'] = 'IMPPROC_SEEK_OK';
        } else if($this->feedback['code'] == 'IMPPROCID_KO') {
            $this->feedback['code'] = 'IMPPROC_SEEK_KO';
        }

        return $this->feedback;
    }

    function seekPortalImpProc() {
        $validation = $this->validar_EDIFICIO_PROCEDIMIENTO_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByImpProcID();
        if($this->feedback['ok']) {
            $imp_proc = $this->feedback['resource'];
            if($imp_proc['estado'] == 'vencido') {
                $this->feedback['ok'] = false;
                $this->feedback['code'] = 'IMPPROCID_NOT_EXST';
                unset($this->feedback['resource']);
                return $this->feedback;
            }
            $this->feedback['code'] = 'PRTL_IMPPROC_SEEK_OK';
            $this->feedback['resource']['path'] = plans_path . $imp_proc['plan_id'] . '/' . $imp_proc['edificio_id'] . '/Procedimientos/' .
                                                    $imp_proc['procedimiento_id'] . '/' . $imp_proc['edificio_procedimiento_id'];
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'PRTL_IMPPROC_SEEK_KO';
        }

        return $this->feedback;
    }

    function expire() {
        $this->feedback = $this->seek();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $imp_proc = $this->feedback['resource'];
        $this->impProc_entity->estado = 'vencido';
        $this->impProc_entity->fecha_vencimiento = date('Y-m-d');
        $this->feedback = $this->impProc_entity->EDIT();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'IMPPROC_EXPIRE_OK';
            $this->update_plan_state($imp_proc['edificio_id'], $imp_proc['plan_id']);
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'IMPPROC_EXPIRE_KO';
        }

        $this->feedback['return'] = array('edificio_id' => $imp_proc['edificio_id'], 'procedimiento_id' => $imp_proc['procedimiento_id']);
        return $this->feedback;
    }

    function implement() {
        $this->feedback = $this->seek();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $imp_proc = $this->feedback['resource'];
        if($imp_proc['estado'] == 'vencido') {
            $this->feedback['ok'] = false;
            $this->feedback['code'] = 'COMPL_EXPIRED';
            $this->feedback['return'] = array('edificio_id' => $imp_proc['edificio_id'], 'procedimiento_id' => $imp_proc['procedimiento_id']);
            return $this->feedback;
        }

        $validation = $this->validar_NOMBRE_DOC();
        if(!$validation['ok']) {
            $validation['return'] = array('edificio_id' => $imp_proc['edificio_id'], 'procedimiento_id' => $imp_proc['procedimiento_id']);
            return $validation;
        }

        include_once './Service/Uploader_Service.php';
        $uploader = new Uploader();
        if(!$_SESSION['test']) {
            $this->feedback = $uploader->uploadFile($imp_proc['path'], $this->nombre_doc);
            if(!$this->feedback['ok']) {
                $this->feedback['return'] = array('edificio_id' => $imp_proc['edificio_id'], 'procedimiento_id' => $imp_proc['procedimiento_id']);
                return $this->feedback;
            }
        }

        $this->impProc_entity->setAttributes(array('fecha_cumplimentacion' => date('Y-m-d'),
                                                    'nombre_doc' => $this->nombre_doc, 'estado' => 'cumplimentado'));
        $this->feedback = $this->impProc_entity->EDIT();
        if($this->feedback['ok']) {
            if($imp_proc['nombre_doc'] != default_doc && $imp_proc['nombre_doc'] != $this->nombre_doc) {
                $uploader->delete($imp_proc['path'] . '/' . $imp_proc['nombre_doc']);
            }
            $this->feedback['code'] = 'IMPPROC_IMPL_OK';
            $this->update_plan_state($imp_proc['edificio_id'], $imp_proc['plan_id']);
        } else {
            $uploader->delete($imp_proc['path'] . '/' . $this->nombre_doc);
            if($uploader->dir_is_empty($imp_proc['path'])['ok']) {
                $uploader->delete($imp_proc['path']);
            }
            if($this->feedback['code'] == 'QRY_KO') {
                $this->feedback['code'] = 'IMPPROC_IMPL_KO';
            }
        }

        $this->feedback['return'] = array('edificio_id' => $imp_proc['edificio_id'], 'procedimiento_id' => $imp_proc['procedimiento_id']);
        return $this->feedback;
    }

    function seekProcedure() {
        $validation = $this->validar_PROCEDIMIENTO_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        return $this->seekByProcID();
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

    function searchProcAndBuilding() {
        $validation = $this->validar_proc_and_building();
        if(!$validation['ok']) {
            return $validation;
        }

        $feedback = $this->seekByProcID();
        if(!$feedback['ok']) {
            return $feedback;
        }

        $procedure = $feedback['resource'];
        $feedback = $this->seekByBuildingID();
        if(!$feedback['ok']) {
            return $feedback;
        }

        $building = $feedback['resource'];
        $feedback = $this->seekPlanBuilding($procedure['plan_id']);
        if(!$feedback['ok']) {
            return $feedback;
        }

        $feedback['procedure'] = $procedure;
        $feedback['building'] = $building;
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
                $feedback['code'] = 'BLDPROC_NOT_EXST';
            } else {
                $feedback['code'] = 'BLDPROC_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'BLDPROC_KO';
        }

        return $feedback;
    }

    function update_plan_state($edificio_id, $plan_id) {
        include_once './Service/CheckState_Service.php';
        $checkState_service = new CheckState_Service($edificio_id, $plan_id);
        $checkState_service->update_plan_state();
    }

    function get_procedure_state() {
        $feedback = $this->search_all_impprocs();
        if(!$feedback['ok']) {
            return $feedback;
        }

        include_once './Service/CheckState_Service.php';
        $checkState_service = new CheckState_Service();
        $estado = $checkState_service->get_state_element($feedback['resource']);
        return array('ok' => true, 'estado' => $estado);
    }

    function search_all_impprocs() {
        $feedback = $this->impProc_entity->searchProcsBuildings();
        if($feedback['ok']) {
            $feedback['code'] = 'BLDPROCS_SEARCH_OK';
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'BLDPROCS_SEARCH_KO';
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

    function proc_building_actives_not_exist() {
        $this->impProc_entity->edificio_id = $this->edificio_id;
        $feedback = $this->impProc_entity->searchActiveImpProcs();
        if($feedback['ok']) {
            if($feedback['code'] != 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'IMPPROC_ACTIVE_EXST';
            } else {
                $feedback['code'] = 'IMPPROC_ACTITVE_NOT_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'IMPPROC_ACTIVE_KO';
        }

        return $feedback;
    }

    function seekByImpProcID() {
        $feedback = $this->impProc_entity->seek();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'IMPPROCID_NOT_EXST';
            } else {
                $feedback['code'] = 'IMPPROCID_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'IMPPROCID_KO';
        }

        return $feedback;
    }

    function check_more_than_one_impprocs($edificio_id, $proc_id) {
        $this->impProc_entity->setAttributes(array('edificio_id' => $edificio_id, 'procedimiento_id' => $proc_id));
        $feedback = $this->impProc_entity->searchProcsBuildings();
        if($feedback['ok']) {
            if(count($feedback['resource']) <= 1) {
                $feedback['ok'] = false;
                $feedback['code'] = 'IMPPROC_UNIQ';
            } else {
                $feedback['code'] = 'IMPPROC_NOT_UNIQ';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'IMPPROC_SEARCH_KO';
        }

        return $feedback;
    }
}
<?php

class CheckState_Service {
    const definiciones = array('documentos', 'procedimientos', 'rutas', 'formaciones', 'simulacros');
    const msg_cump = 'El plan ha sido cumplimentado';
    var $edificio_id;
    var $plan_id;
    var $documentos;
    var $procedimientos;
    var $rutas;
    var $formaciones;
    var $simulacros;
    var $resultado;

    function __construct($edificio_id = '', $plan_id = '') {
        $this->edificio_id = $edificio_id;
        $this->plan_id = $plan_id;
        $this->init_attributes();
    }

    function init_attributes() {
        foreach(self::definiciones as $definicion) {
            $this->$definicion = array(
                'ok' => true,
                'code' => '',
                'estado' => '',
                'elementos' => array()
            );
        }

        $this->resultado = array(
            'ok' => true,
            'code' => '',
            'estado' => '',
            'elementos' => array()
        );
    }

    function update_plan_state() {
        $feedback = $this->checkStatePlan();
        if($feedback['ok']) {
            include_once './Model/BuildPlan_Model.php';
            $buildPlan_entity = new BuildPlan_Model();
            $buildPlan_entity->setAttributes(array('edificio_id' => $this->edificio_id, 'plan_id' => $this->plan_id));
            $build_plan = $buildPlan_entity->seek()['resource'];
            if($feedback['estado'] == 'pendiente') {
                $buildPlan_entity->setAttributes(array('fecha_cumplimentacion' => default_data, 'estado' => 'pendiente'));
            } else if($feedback['estado'] == 'cumplimentado') {
                $buildPlan_entity->setAttributes(array('fecha_cumplimentacion' => date('Y-m-d'), 'estado' => 'cumplimentado'));
            } else {
                $buildPlan_entity->estado = 'vencido';
            }
            $buildPlan_entity->EDIT();
            if($feedback['estado'] == 'cumplimentado' && $feedback['estado'] != $build_plan['estado']) {
                $this->notificate_resp_org();
            }
        }
    }

    function notificate_resp_org() {
        include_once './Model/User_Model.php';
        $user_entity = new User_Model();
        $feedback = $user_entity->searchByRol('organizacion');
        if($feedback['ok']) {
            include_once './Model/Notification_Model.php';
            $notification_entity = new Notification_Model();
            $notification_entity->setAttributes(array('edificio_id' => $this->edificio_id, 'plan_id' => $this->plan_id, 'mensaje' => self::msg_cump));
            $managers = $feedback['resource'];
            foreach($managers as $manager) {
                $notification_entity->username = $manager['username'];
                $notification_entity->ADD();
            }
        }
    }

    function checkStatePlan() {
        $this->documentos = $this->checkStateDocuments();
        if(!$this->documentos['ok']) {
            if($this->documentos['code'] != 'DFDOCS_SEARCH_EMPT') {
                return $this->documentos;
            }
        } else {
            array_push($this->resultado['elementos'], $this->documentos);
        }

        $this->procedimientos = $this->checkStateProcedures();
        if(!$this->procedimientos['ok']) {
            if($this->procedimientos['code'] != 'DFPROCS_SEARCH_EMPT') {
                return $this->procedimientos;
            }
        } else {
            array_push($this->resultado['elementos'], $this->procedimientos);
        }

        $this->rutas = $this->checkStateRoutes();
        if(!$this->rutas['ok']) {
            if($this->rutas['code'] != 'DFROUTE_SEARCH_EMPT') {
                return $this->rutas;
            }
        } else {
            array_push($this->resultado['elementos'], $this->rutas);
        }

        $this->formaciones = $this->checkStateFormations();
        if(!$this->formaciones['ok']) {
            if($this->formaciones['code'] != 'DFFRMT_SEARCH_EMPT') {
                return $this->formaciones;
            }
        } else {
            array_push($this->resultado['elementos'], $this->formaciones);
        }

        $this->simulacros = $this->checkStateSimulacrums();
        if(!$this->simulacros['ok']) {
            if($this->simulacros['code'] != 'DFSIM_SEARCH_EMPT') {
                return $this->simulacros;
            }
        } else {
            array_push($this->resultado['elementos'], $this->simulacros);
        }

        $this->resultado['estado'] = $this->check_state($this->resultado['elementos']);
        return $this->resultado;
    }

    function checkStateDocuments() {
        $feedback = $this->searchBuildingPlanDocuments();
        if(!$feedback['ok']) {
            $this->documentos['ok'] = false;
            $this->documentos['code'] = $feedback['code'];
            return $this->documentos;
        }

        $this->documentos['elementos'] = $feedback['resource'];
        foreach($this->documentos['elementos'] as $index => $documento) {
            $feedback = $this->searchBuildingImpDocuments($documento['documento_id']);
            if(!$feedback['ok']) {
                $this->documentos['ok'] = false;
                $this->documentos['code'] = $feedback['code'];
                return $this->documentos;
            }
            $this->documentos['elementos'][$index]['estado'] = $this->check_state($feedback['resource']);
        }

        $this->documentos['estado'] = $this->check_state($this->documentos['elementos']);
        return $this->documentos;
    }

    function checkStateProcedures() {
        $feedback = $this->searchBuildingPlanProcedures();
        if(!$feedback['ok']) {
            $this->procedimientos['ok'] = false;
            $this->procedimientos['code'] = $feedback['code'];
            return $this->procedimientos;
        }

        $this->procedimientos['elementos'] = $feedback['resource'];
        foreach($this->procedimientos['elementos'] as $index => $procedimiento) {
            $feedback = $this->searchBuildingImpProcedures($procedimiento['procedimiento_id']);
            if(!$feedback['ok']) {
                $this->procedimientos['ok'] = false;
                $this->procedimientos['code'] = $feedback['code'];
                return $this->procedimientos;
            }
            $this->procedimientos['elementos'][$index]['estado'] = $this->check_state($feedback['resource']);
        }

        $this->procedimientos['estado'] = $this->check_state($this->procedimientos['elementos']);
        return $this->procedimientos;
    }

    /*function checkStateRoutes() {
        $feedback = $this->searchBuildingPlanRoutes();
        if(!$feedback['ok']) {
            $this->rutas['ok'] = false;
            $this->rutas['code'] = $feedback['code'];
            return $this->rutas;
        }

        $this->rutas['elementos'] = $feedback['resource'];
        foreach($this->rutas['elementos'] as $index => $ruta) {
            $feedback = $this->searchBuildingImpRoutes($ruta['ruta_id']);
            if(!$feedback['ok']) {
                $this->rutas['ok'] = false;
                $this->rutas['code'] = $feedback['code'];
                return $this->rutas;
            }
            $this->rutas['elementos'][$index]['estado'] = $this->check_state($feedback['resource']);
        }

        $this->rutas['estado'] = $this->check_state($this->rutas['elementos']);
        return $this->rutas;
    }*/

    function checkStateRoutes() {
        $feedback = $this->searchBuildingPlanRoutes();
        if(!$feedback['ok']) {
            $this->rutas['ok'] = false;
            $this->rutas['code'] = $feedback['code'];
            return $this->rutas;
        }

        $this->rutas['elementos'] = $feedback['resource'];
        $floors = $this->searchBuildingFloors();
        if(!$floors['ok']) {
            $this->rutas['ok'] = false;
            $this->rutas['code'] = $floors['code'];
            return $this->rutas;
        }

        foreach($this->rutas['elementos'] as $index => $ruta) {
            $feedback = $this->get_state_route($ruta['ruta_id'], $floors['resource']);
            if(!$feedback['ok']) {
                $this->rutas['ok'] = false;
                $this->rutas['code'] = $feedback['code'];
                return $this->rutas;
            }
            $this->rutas['elementos'][$index]['estado'] = $feedback['estado'];
        }

        $this->rutas['estado'] = $this->check_state($this->rutas['elementos']);
        return $this->rutas;
    }

    function get_state_route($ruta_id, $floors) {
        $floors_states = array();
        foreach($floors as $floor) {
            $feedback = $this->searchImpRoutesByFloor($ruta_id, $floor['planta_id']);
            if(!$feedback['ok']) {
                return $feedback;
            }
            array_push($floors_states, $this->check_state($feedback['resource']));
        }

        $state = array('ok' => true, 'estado' => '');
        if(!empty($floors_states)) {
            foreach($floors_states as $floor_state) {
                if($floor_state == 'pendiente') {
                    $state['estado'] = 'pendiente';
                    return $state;
                }

                if($state['estado'] != '') {
                    if($state['estado'] != $floor_state) {
                        $state['estado'] = 'pendiente';
                        return $state;
                    }
                } else {
                    $state['estado'] = $floor_state;
                }
            }
        } else {
            $state['estado'] = 'vencido';
        }

        return $state;
    }


    function checkStateFormations() {
        $feedback = $this->searchBuildingPlanFormations();
        if(!$feedback['ok']) {
            $this->formaciones['ok'] = false;
            $this->formaciones['code'] = $feedback['code'];
            return $this->formaciones;
        }

        $this->formaciones['elementos'] = $feedback['resource'];
        foreach($this->formaciones['elementos'] as $index => $formacion) {
            $feedback = $this->searchBuildingImpFormations($formacion['formacion_id']);
            if(!$feedback['ok']) {
                $this->formaciones['ok'] = false;
                $this->formaciones['code'] = $feedback['code'];
                return $this->formaciones;
            }
            $this->formaciones['elementos'][$index]['estado'] = $this->check_state($feedback['resource']);
        }

        $this->formaciones['estado'] = $this->check_state($this->formaciones['elementos']);
        return $this->formaciones;
    }

    function checkStateSimulacrums() {
        $feedback = $this->searchBuildingPlanSimulacrums();
        if(!$feedback['ok']) {
            $this->simulacros['ok'] = false;
            $this->simulacros['code'] = $feedback['code'];
            return $this->simulacros;
        }

        $this->simulacros['elementos'] = $feedback['resource'];
        foreach($this->simulacros['elementos'] as $index => $simulacro) {
            $feedback = $this->searchBuildingImpSimulacrums($simulacro['simulacro_id']);
            if(!$feedback['ok']) {
                $this->simulacros['ok'] = false;
                $this->simulacros['code'] = $feedback['code'];
                return $this->simulacros;
            }
            $this->simulacros['elementos'][$index]['estado'] = $this->check_state($feedback['resource']);
        }

        $this->simulacros['estado'] = $this->check_state($this->simulacros['elementos']);
        return $this->simulacros;
    }

    function check_state($elements) {
        if(empty($elements)) {
            return 'vencido';
        }

        $element = array_pop($elements);
        if($element['estado'] == 'pendiente') {
            return 'pendiente';
        }

        if($element['estado'] == 'cumplimentado') {
            $estado = $this->check_state($elements);
            if($estado != 'pendiente') {
                return 'cumplimentado';
            }
        }

        return $this->check_state($elements);
    }

    function searchBuildingPlanDocuments() {
        include_once './Model/DefDoc_Model.php';
        $defDoc_entity = new DefDoc_Model();
        $defDoc_entity->plan_id = $this->plan_id;
        $feedback = $defDoc_entity->searchBuildingPlanDocuments($this->edificio_id);
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'DFDOCS_SEARCH_EMPT';
            } else {
                $feedback['code'] = 'DFDOCS_SEARCH_OK';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'DFDOCS_SEARCH_KO';
        }

        return $feedback;
    }

    function searchBuildingPlanProcedures() {
        include_once './Model/DefProc_Model.php';
        $defProc_entity = new DefProc_Model();
        $defProc_entity->plan_id = $this->plan_id;
        $feedback = $defProc_entity->searchBuildingPlanProcedures($this->edificio_id);
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'DFPROCS_SEARCH_EMPT';
            } else {
                $feedback['code'] = 'DFPROCS_SEARCH_OK';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'DFPROCS_SEARCH_KO';
        }

        return $feedback;
    }

    function searchBuildingPlanRoutes() {
        include_once './Model/DefRoute_Model.php';
        $defRoute_entity = new DefRoute_Model();
        $defRoute_entity->plan_id = $this->plan_id;
        $feedback = $defRoute_entity->searchBuildingPlanRoutes($this->edificio_id);
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'DFROUTE_SEARCH_EMPT';
            } else {
                $feedback['code'] = 'DFROUTE_SEARCH_OK';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'DFROUTE_SEACH_KO';
        }

        return $feedback;
    }

    function searchBuildingPlanFormations() {
        include_once './Model/DefFormat_Model.php';
        $defFormat_entity = new DefFormat_Model();
        $defFormat_entity->plan_id = $this->plan_id;
        $feedback = $defFormat_entity->searchBuildingPlanFormations($this->edificio_id);
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'DFFRMT_SEARCH_EMPT';
            } else {
                $feedback['code'] = 'DFFRMT_SEARCH_OK';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'DFFRMT_SEARCH_KO';
        }

        return $feedback;
    }

    function searchBuildingPlanSimulacrums() {
        include_once './Model/DefSim_Model.php';
        $defSim_entity = new DefSim_Model();
        $defSim_entity->plan_id = $this->plan_id;
        $feedback = $defSim_entity->searchBuildingPlanSimulacrums($this->edificio_id);
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'DFSIM_SEARCH_EMPT';
            } else {
                $feedback['code'] = 'DFSIM_SEARCH_OK';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'DFSIM_SEARCH_KO';
        }

        return $feedback;
    }

    function searchBuildingImpDocuments($documento_id) {
        include_once './Model/ImpDoc_Model.php';
        $impDoc_entity = new ImpDoc_Model();
        $impDoc_entity->setAttributes(array('edificio_id' => $this->edificio_id,
                                                'documento_id' => $documento_id));
        $feedback = $impDoc_entity->searchDocsBuildings();
        if($feedback['ok']) {
            $feedback['code'] = 'IMPDOC_SEARCH_OK';
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'IMPDOC_SEARCH_KO';
        }

        return $feedback;
    }

    function searchBuildingImpProcedures($procedimiento_id) {
        include_once './Model/ImpProc_Model.php';
        $impProc_entity = new ImpProc_Model();
        $impProc_entity->setAttributes(array('edificio_id' => $this->edificio_id,
                                                'procedimiento_id' => $procedimiento_id));
        $feedback = $impProc_entity->searchProcsBuildings();
        if($feedback['ok']) {
            $feedback['code'] = 'IMPPROC_SEARCH_OK';
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'IMPPROC_SERACH_KO';
        }

        return $feedback;
    }

    /*function searchBuildingImpRoutes($ruta_id) {
        include_once './Model/ImpRoute_Model.php';
        $impRoute_entity = new ImpRoute_Model();
        $impRoute_entity->ruta_id = $ruta_id;
        $feedback = $impRoute_entity->searchRoutesBuildings($this->edificio_id);
        if($feedback['ok']) {
            $feedback['code'] = 'IMPROUTE_SEARCH_OK';
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'IMPROUTE_SEARCH_KO';
        }

        return $feedback;
    }*/

    function searchBuildingImpFormations($formacion_id) {
        include_once './Model/ImpFormat_Model.php';
        $impFormat_entity = new ImpFormat_Model();
        $impFormat_entity->setAttributes(array('edificio_id' => $this->edificio_id,
                                                'formacion_id' => $formacion_id));
        $feedback = $impFormat_entity->searchFormatsBuildings();
        if($feedback['ok']) {
            $feedback['code'] = 'IMPFORMAT_SEARCH_OK';
        } else {
            $feedback['code'] = 'IMPFORMAT_SEARCH_KO';
        }

        return $feedback;
    }

    function searchBuildingImpSimulacrums($simulacro_id) {
        include_once './Model/ImpSim_Model.php';
        $impSim_entity = new ImpSim_Model();
        $impSim_entity->setAttributes(array('edificio_id' => $this->edificio_id,
                                            'simulacro_id' => $simulacro_id));
        $feedback = $impSim_entity->searchSimsBuildings();
        if($feedback['ok']) {
            $feedback['code'] = 'IMPSIM_SEARCH_OK';
        } else {
            $feedback['code'] = 'IMPSIM_SEARCH_KO';
        }

        return $feedback;
    }

    function searchBuildingFloors() {
        include_once './Model/Floor_Model.php';
        $floor_entity = new Floor_Model();
        $floor_entity->edificio_id = $this->edificio_id;
        $feedback = $floor_entity->searchByBuildingID();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['code'] = 'FLRID_NOT_EXST';
            } else {
                $feedback['code'] = 'FLR_SRCH_OK';
            }
        } else {
            $feedback['code'] = 'FLR_SRCH_KO';
        }

        return $feedback;
    }

    function searchImpRoutesByFloor($ruta_id, $planta_id) {
        include_once './Model/ImpRoute_Model.php';
        $impRoute_entity = new ImpRoute_Model();
        $impRoute_entity->setAttributes(array('ruta_id' => $ruta_id, 'planta_id' => $planta_id));
        $feedback = $impRoute_entity->searchRoutesFloors();
        if($feedback['ok']) {
            $feedback['code'] = 'IMPROUTE_SEARCH_OK';
        } else {
            $feedback['code'] = 'IMPROUTE_SEARCH_KO';
        }

        return $feedback;
    }

}
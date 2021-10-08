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
            if($build_plan['estado'] != 'vencido') {
                if($feedback['estado'] == 'pendiente' || $feedback['estado'] == 'vencido') {
                    $buildPlan_entity->setAttributes(array('fecha_cumplimentacion' => default_data, 'estado' => 'pendiente'));
                } else {
                    $buildPlan_entity->setAttributes(array('fecha_cumplimentacion' => date('Y-m-d'), 'estado' => 'cumplimentado'));
                }

                $buildPlan_entity->EDIT();
                if($feedback['estado'] == 'cumplimentado' && $feedback['estado'] != $build_plan['estado']) {
                    $this->notificate_resp_org();
                }
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

        $this->resultado['estado'] = $this->get_general_state_elements($this->resultado['elementos']);
        return $this->resultado;
    }

    /*
     *  Determina el estado GENERAL de los Documentos de un Plan en un Edificio a partir del estado de cada uno de los Documentos específicos del Edificio.
     *      1. Para determinar el estado, únicamente se tiene en cuenta los Documentos del Plan que tengan cumplimentaciones en el edificio (en cualquier estado).
     *      2. El estado se obtiene a partir de la siguiente lógica:
     *          2a. Se obtienen los Documentos del Plan que tengan cumplimentaciones en el edificio (y por lo tanto, necesiten ser cumplimentados).
     *          2b. Para cada uno de los Documentos obtenidos, se obtienen TODAS las cumplimentaciones en el edificio y se determina su estado.
     *                  - PENDIENTE: Si alguna cumplimentación está pendiente.
     *                  - CUMPLIMENTADO: Si existe al menos una cumplimentación CUMPLIMENTADA y no se encuentra ninguna cumplimentación PENDIENTE.
     *                  - VENCIDA: Si TODAS las cumplimentaciones están vencidas.
     *          2c. Una vez calculado el estado de cada uno de los documentos, se obtiene el estado GENERAL de los Documentos del Plan en el Edificio
     *                  - PENDIENTE: Si el estado de algún Documento es PENDIENTE.
     *                  - CUMPLIMENTADO: Si el estado de un Documento es CUMPLIMENTADO y no hay Documentos en estado PENDIENTE.
     *                  - VENCIDO: Si todos los Documentos están en estado VENCIDO.
     */
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
            $this->documentos['elementos'][$index]['estado'] = $this->get_state_element($feedback['resource']);
        }

        $this->documentos['estado'] = $this->get_general_state_elements($this->documentos['elementos']);
        return $this->documentos;
    }

    /*
     *  Determina el estado GENERAL de los Procedimientos de un Plan en un Edificio a partir del estado de cada uno de los Procedimientos específicos del Edificio.
     *      1. Para determinar el estado, únicamente se tiene en cuenta los Procedimientos del Plan que tengan cumplimentaciones en el edificio (en cualquier estado).
     *      2. El estado se obtiene a partir de la siguiente lógica:
     *          2a. Se obtienen los Procedimientos del Plan que tengan cumplimentaciones en el edificio (y por lo tanto, necesiten ser cumplimentados).
     *          2b. Para cada uno de los Procedimientos obtenidos, se obtienen TODAS las cumplimentaciones en el edificio y se determina su estado.
     *                  - PENDIENTE: Si alguna cumplimentación está pendiente.
     *                  - CUMPLIMENTADO: Si existe al menos una cumplimentación CUMPLIMENTADA y no se encuentra ninguna cumplimentación PENDIENTE.
     *                  - VENCIDA: Si TODAS las cumplimentaciones están vencidas.
     *          2c. Una vez calculado el estado de cada uno de los procedimientos, se obtiene el estado GENERAL de los Procedimientos del Plan en el Edificio
     *                  - PENDIENTE: Si el estado de algún Procedimiento es PENDIENTE.
     *                  - CUMPLIMENTADO: Si el estado de un Procedimiento es CUMPLIMENTADO y no hay Procedimientos en estado PENDIENTE.
     *                  - VENCIDO: Si todos los Procedimientos están en estado VENCIDO.
     */
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
            $this->procedimientos['elementos'][$index]['estado'] = $this->get_state_element($feedback['resource']);
        }

        $this->procedimientos['estado'] = $this->get_general_state_elements($this->procedimientos['elementos']);
        return $this->procedimientos;
    }


        /*
         *  Determina el estado GENERAL de las Rutas de un Plan en un Edificio a partir del estado de cada una de las Rutas específicas del Edificio.
         *      1. Para determinar el estado, únicamente se tiene en cuenta las Rutas del Plan que tengan cumplimentaciones en alguna de las plantas del edificio (en cualquier estado).
         *      2. El estado se obtiene a partir de la siguiente lógica:
         *          2a. Se obtienen las Rutas del Plan que tengan cumplimentaciones en alguna de las plantas el edificio (y por lo tanto, necesiten ser cumplimentados).
         *          2b. Se obtienen las Plantas del Edificio
         *          2c. Se determina el estado de cada una de las Rutas en el Edificio.
         *              - CUMPLIMENTADO: El estado de la Ruta en TODAS las Plantas es CUMPLIMENTADO.
         *              - VENCIDO: El estado de la Ruta en TODAS las Plantas es VENCIDO.
         *              - PENDIENTE: En cualquier otro caso.
         *          2d. Una vez calculado el estado de cada una de las rutas, se obtiene el estado GENERAL de las Rutas del Plan en el Edificio
         *                  - PENDIENTE: Si alguna de las Rutas es PENDIENTE.
         *                  - CUMPLIMENTADO: Si el estado de una Ruta es CUMPLIMENTADO y no hay Rutas en estado PENDIENTE.
         *                  - VENCIDO: Si todas las Rutas están en estado VENCIDO.
         */

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

        $this->rutas['estado'] = $this->get_general_state_elements($this->rutas['elementos']);
        return $this->rutas;
    }

    /*
     *  Determina el estado de UNA Ruta en un Edificio.
     *      1. Para cada una de las Plantas del Edificio, se obtienen las cumplimentaciones de la Ruta en esa Planta.
     *      2. Se calcula el estado de la Ruta en esa Planta. Este estado de una Ruta en una Planta será:
     *           - PENDIENTE: Si alguna cumplimentación está pendiente.
     *           - CUMPLIMENTADO: Si existe al menos una cumplimentación CUMPLIMENTADA y no se encuentra ninguna cumplimentación PENDIENTE.
     *           - VENCIDA: Si TODAS las cumplimentaciones están vencidas.
     *      3. Una vez determinado el estado de la Ruta en cada una de las Plantas, se calcula el estado de la Ruta en el Edificio:
     *             - CUMPLIMENTADO: El estado de la Ruta en TODAS las Plantas es CUMPLIMENTADO.
     *             - VENCIDO: El estado de la Ruta en TODAS las Plantas es VENCIDO.
     *             - PENDIENTE: En cualquier otro caso.
     *      4. En caso de que el edificio no tenga Plantas, se determina el estado por defecto VENCIDO.
     */
    function get_state_route($ruta_id, $floors) {
        $floors_states = array();
        $state = array('ok' => true, 'estado' => '');

        foreach($floors as $floor) {
            $feedback = $this->searchImpRoutesByFloor($ruta_id, $floor['planta_id']);
            if(!$feedback['ok']) {
                if($feedback['code'] == 'IMPROUTE_SEARCH_EMPT') {
                    $state['estado'] = 'pendiente';
                    return $state;
                } else {
                    return $feedback;
                }
            }
            array_push($floors_states, $this->get_state_element($feedback['resource']));
        }

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


    /*
     *  Determina el estado GENERAL de las Formaciones de un Plan en un Edificio a partir del estado de cada uno de las Formaciones específicas del Edificio.
     *      1. Para determinar el estado, únicamente se tiene en cuenta las Formaciones del Plan que tengan cumplimentaciones en el edificio (en cualquier estado).
     *      2. El estado se obtiene a partir de la siguiente lógica:
     *          2a. Se obtienen las Formaciones del Plan que tengan cumplimentaciones en el edificio (y por lo tanto, necesiten ser cumplimentados).
     *          2b. Para cada una de las Formaciones obtenidos, se obtienen TODAS las cumplimentaciones en el edificio y se determina su estado.
     *                  - PENDIENTE: Si alguna cumplimentación está pendiente.
     *                  - CUMPLIMENTADO: Si existe al menos una cumplimentación CUMPLIMENTADA y no se encuentra ninguna cumplimentación PENDIENTE.
     *                  - VENCIDA: Si TODAS las cumplimentaciones están vencidas.
     *          2c. Una vez calculado el estado de cada una de las formaciones, se obtiene el estado GENERAL de las Formaciones del Plan en el Edificio
     *                  - PENDIENTE: Si el estado de alguna Formación es PENDIENTE.
     *                  - CUMPLIMENTADO: Si el estado de una Formación es CUMPLIMENTADO y no hay Formaciones en estado PENDIENTE.
     *                  - VENCIDO: Si todas las Formaciones están en estado VENCIDO.
     */
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
            $this->formaciones['elementos'][$index]['estado'] = $this->get_state_element($feedback['resource']);
        }

        $this->formaciones['estado'] = $this->get_general_state_elements($this->formaciones['elementos']);
        return $this->formaciones;
    }

    /*
     *  Determina el estado GENERAL de los Simulacros de un Plan en un Edificio a partir del estado de cada uno de los Simulacros específicos del Edificio.
     *      1. Para determinar el estado, únicamente se tiene en cuenta los Simulacros del Plan que tengan cumplimentaciones en el edificio (en cualquier estado).
     *      2. El estado se obtiene a partir de la siguiente lógica:
     *          2a. Se obtienen los Simulacros del Plan que tengan cumplimentaciones en el edificio (y por lo tanto, necesiten ser cumplimentados).
     *          2b. Para cada uno de los Simulacros obtenidos, se obtienen TODAS las cumplimentaciones en el edificio y se determina su estado.
     *                  - PENDIENTE: Si alguna cumplimentación está pendiente.
     *                  - CUMPLIMENTADO: Si existe al menos una cumplimentación CUMPLIMENTADA y no se encuentra ninguna cumplimentación PENDIENTE.
     *                  - VENCIDA: Si TODAS las cumplimentaciones están vencidas.
     *          2c. Una vez calculado el estado de cada uno de los Simulacros, se obtiene el estado GENERAL de los Simulacros del Plan en el Edificio
     *                  - PENDIENTE: Si el estado de algún Simulacro es PENDIENTE.
     *                  - CUMPLIMENTADO: Si el estado de un Simulacro es CUMPLIMENTADO y no hay Simulacros en estado PENDIENTE.
     *                  - VENCIDO: Si todos los Simulacros están en estado VENCIDO.
     */

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
            $this->simulacros['elementos'][$index]['estado'] = $this->get_state_element($feedback['resource']);
        }

        $this->simulacros['estado'] = $this->get_general_state_elements($this->simulacros['elementos']);
        return $this->simulacros;
    }


    /*
     *  Función genérica que devuelve un estado a partir de las cumplimentaciones de ese Elemento. Devuelve
     *      - PENDIENTE: Si alguna cumplimentación está pendiente.
     *      - CUMPLIMENTADO: Si existe al menos una cumplimentación CUMPLIMENTADA y no se encuentra ninguna cumplimentación PENDIENTE.
     *      - VENCIDA: Si TODAS las cumplimentaciones están vencidas o si no hay cumplimentaciones.
     */
    function get_state_element($elements) {
        if(empty($elements)) {
            return 'vencido';
        }

        $element = array_pop($elements);
        if($element['estado'] == 'pendiente') {
            return 'pendiente';
        }

        if($element['estado'] == 'cumplimentado') {
            $estado = $this->get_state_element($elements);
            if($estado != 'pendiente') {
                return 'cumplimentado';
            }
        }

        return $this->get_state_element($elements);
    }

    function get_general_state_elements($elements) {
        if(empty($elements)) {
            return 'vencido';
        }

        $first_element = array_pop($elements);
        if($first_element['estado'] == 'pendiente') {
            return 'pendiente';
        }

        foreach($elements as $element) {
            if($first_element['estado'] != $element['estado']) {
                return 'pendiente';
            }
        }

        return $first_element['estado'];
    }


    /*
     * Recupera las Definiciones de Documentos de un Plan que tengan cumplimentaciones en el edificio en cualquier estado.
     * Devuelve:
     *      - TRUE: En caso de que se encuentren definiciones de documentos que cumplan el criterio mencionado.
     *      - FALSE: En caso de que no se encuentre ninguna definición o se produzca error de gestor.
     */
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

    /*
     * Recupera las Definiciones de Procedimientos de un Plan que tengan cumplimentaciones en el edificio en cualquier estado.
     * Devuelve:
     *      - TRUE: En caso de que se encuentren definiciones de procedimientos que cumplan el criterio mencionado.
     *      - FALSE: En caso de que no se encuentre ninguna definición o se produzca error de gestor.
     */
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

    /*
     * Recupera las Definiciones de Rutas de un Plan que tengan cumplimentaciones en alguna de las plantas del edificio en cualquier estado.
     * Devuelve:
     *      - TRUE: En caso de que se encuentren definiciones de rutas que cumplan el criterio mencionado.
     *      - FALSE: En caso de que no se encuentre ninguna definición o se produzca error de gestor.
     */
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

    /*
     * Recupera las Definiciones de Formaciones de un Plan que tengan cumplimentaciones en el edificio en cualquier estado.
     * Devuelve:
     *      - TRUE: En caso de que se encuentren definiciones de formaciones que cumplan el criterio mencionado.
     *      - FALSE: En caso de que no se encuentre ninguna definición o se produzca error de gestor.
     */
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

    /*
     * Recupera las Definiciones de Simulacros de un Plan que tengan cumplimentaciones en el edificio en cualquier estado.
     * Devuelve:
     *      - TRUE: En caso de que se encuentren definiciones de simulacros que cumplan el criterio mencionado.
     *      - FALSE: En caso de que no se encuentre ninguna definición o se produzca error de gestor.
     */
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

    /*
     * Recupera las cumplimentaciones en cualquier estado de un Documento en un Edificio.
     * Devuelve:
     *      - TRUE: En caso de que la consulta se realice con éxito.
     *      - FALSE: En caso de fallo del gestor.
     */
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

    /*
     * Recupera las cumplimentaciones en cualquier estado de un Procedimiento en un Edificio.
     * Devuelve:
     *      - TRUE: En caso de que la consulta se realice con éxito.
     *      - FALSE: En caso de fallo del gestor.
     */
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

    /*
     * Recupera las cumplimentaciones en cualquier estado de una Formación en un Edificio.
     * Devuelve:
     *      - TRUE: En caso de que la consulta se realice con éxito.
     *      - FALSE: En caso de fallo del gestor.
     */
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

    /*
     * Recupera las cumplimentaciones en cualquier estado de un Simulacro en un Edificio.
     * Devuelve:
     *      - TRUE: En caso de que la consulta se realice con éxito.
     *      - FALSE: En caso de fallo del gestor.
     */
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

    /*
     * Recupera las plantas de un edificio.
     * Devuelve:
     *      - TRUE: En caso de que la consulta se realice con éxito.
     *      - FALSE: En caso de fallo del gestor.
     */
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

    /*
     * Recupera las cumplimentaciones en cualquier estado de una Ruta en una Planta.
     * Devuelve:
     *      - TRUE: En caso de que la consulta se realice con éxito y devuelva datos.
     *      - FALSE: En caso de fallo del gestor o no se encuentren cumplimentaciones.
     */
    function searchImpRoutesByFloor($ruta_id, $planta_id) {
        include_once './Model/ImpRoute_Model.php';
        $impRoute_entity = new ImpRoute_Model();
        $impRoute_entity->setAttributes(array('ruta_id' => $ruta_id, 'planta_id' => $planta_id));
        $feedback = $impRoute_entity->searchRoutesFloors();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'IMPROUTE_SEARCH_EMPT';
            } else {
                $feedback['code'] = 'IMPROUTE_SEARCH_OK';
            }
        } else {
            $feedback['code'] = 'IMPROUTE_SEARCH_KO';
        }

        return $feedback;
    }

}
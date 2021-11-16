<?php

include_once './Validation/Simulacrum_Validation.php';
include_once './Model/ImpSim_Model.php';
include_once './Model/DefSim_Model.php';

class Simulacrum_Service extends Simulacrum_Validation {
    var $atributos;
    var $defSim_entity;
    var $impSim_entity;
    var $feedback = array();
    const msg_new_sim = 'Se ha añadido un nuevo simulacro a cumplimentar';

    function __construct() {
        date_default_timezone_set("Europe/Madrid");
        $this->atributos = array('cumplimentacion_id','simulacro_id','edificio_id','estado','fecha_planificacion', 'fecha_planificacion_inicio','fecha_planificacion_fin',
            'fecha_vencimiento', 'fecha_vencimiento_inicio', 'fecha_vencimiento_fin', 'url_recurso','destinatarios','nombre_edificio', 'fecha_cumplimentacion',
            'fecha_cumplimentacion_inicio', 'fecha_cumplimentacion_fin');
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

    /*
     *  - Busca Cumplimentaciones de un Simulacro.
     *      1. Valida y busca un simulacro por ID.
     *      2. Valida el resto de atribtuos utilizados como filtro.
     *      3. Recupera las cumplimentaciones del Simulacro que cumplan con los datos de filtrado.
     */
    function searchCompletions() {
        $this->feedback = $this->seekSimulacrum();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $simulacrum = $this->feedback['resource'];
        $validation = $this->validar_atributos_searchCompletions();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->impSim_entity->searchCompletions();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'IMPSIM_SEARCH_OK';
            $this->feedback['simulacrum'] = $simulacrum;
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'IMPSIM_SEARCH_KO';
        }

        return $this->feedback;
    }

    /*
     *  - Recupera los detalles de un Simulacro en un Edificio.
     *  - Los detalles del Simulacro incluyen los datos de la Definición del Simulacro junto con sus cumplimentaciones en el Edificio.
     *      1. Valida y busca el simulacro y el edificio por ID, y comprueba que el plan del simulacro está asociado al edificio.
     *      2. Comprueba que el usuario tenga permisos sobre el edificio (es el responsable del edificio o el rol del usuario es 'organizacion' o 'administrador').
     *      3. Valida el resto de atributos utilizados en la búsqueda (filtrado).
     *      4. Calcula el estado del Simulacro en el Edificio.
     *      5. Realiza la búsqueda.
     */
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
            return $validation;
        }

        $sim_state = $this->get_simulacrum_state();
        if(!$sim_state['ok']) {
            return $sim_state;
        }

        $simulacrum['estado'] = $sim_state['estado'];
        $this->feedback = $this->impSim_entity->SEARCH();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'IMPSIM_SEARCH_OK';
            $this->feedback['simulacrum'] = $simulacrum;
            $this->feedback['building'] = $building;
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'IMPSIM_SEARCH_KO';
        }

        return $this->feedback;
    }

    /*
     *  - Recupera los detalles del Simulacro en el Edificio del Portal.
     *  - Los detalles del Simulacro incluyen los datos de la Definición del Simulacro junto con sus cumplimentaciones ACTIVAS en el Edificio.
     *      1. Valida y busca el simulacro y el edificio por ID, y comprueba que el plan del simulacro tenga una asociación ACTIVA con el Edificio.
     *      2. Se obtiene dinámicamente el estado del Simulacro en el Edificio, y comprueba que este esté ACTIVO.
     *      3. Valida los atributos utilizados como filtrado.
     *      4. Recupera las cumplimentaciones ACITVAS que cumplan con los datos de filtrado.
     */
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
            return $validation;
        }

        $this->feedback = $this->impSim_entity->searchActiveImpSims();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'PRTL_IMPSIM_SEARCH_OK';
            $this->feedback['simulacrum'] = $simulacrum;
            $this->feedback['building'] = $building;
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'PRTL_IMPSIM_SEARCH_KO';
        }

        return $this->feedback;
    }

    // Valida y busca el simulacro y el edificio por ID, y comprueba que el plan del simulacro tenga una asociación ACTIVA con el Edificio.
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

    // Valida y busca una Definición de Simulacro por ID, y recupera los Edificios que tengan una asignación ACTIVA con el Plan del Simulacro.
    function addImpSimForm() {
        $this->feedback = $this->seekSimulacrum();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $simulacrum = $this->feedback['resource'];
        $this->feedback = $this->searchActiveBuildPlans($simulacrum['plan_id']);
        if($this->feedback['ok']) {
            $this->feedback['simulacrum'] = $simulacrum;
        }

        return $this->feedback;
    }

    /*
     *  Valida y busca un Simulacro y un Edificio por ID, comprueba que existe una asociación entre el Plan del Simulacro y el Edificio,
     *  y comprueba que el usuario tenga permisos sobre el edificio.
     */
    function simulacrumForm() {
        $this->feedback = $this->searchSimAndBuilding();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $building = $this->feedback['building'];
        if(es_resp_edificio() && $building['username'] != getUser()) {
            $this->feedback['ok'] = false;
            $this->feedback['code'] = 'BLD_FRBD';
            unset($this->feedback['resource'], $this->feedback['simulacrum'], $this->feedback['building']);
        }

        return $this->feedback;
    }

    /*
     *  1. Valida y busca una Definición de Simulacro por ID.
     *  2. Valida los Edificios por ID.
     *  3. Llama a la función ADD para añadir las cumplimentaciones del Simulacro en los Edificios.
     */
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
        return $this->ADD($simulacrum);
    }

    /*
     *  - Crea una Cumplimentación en estado PENDIENTE del Simulacro que se pasa como parámetro en cada uno de los Edificios.
     *  - Para cada uno de los Edificios:
     *      1. Comprueba que el edificio existe.
     *      2. Valida que el usuario que realiza la acción tiene permisos sobre el edificio.
     *      3. Comprueba que exista una asociación ACTIVA entre el Plan del Simulacro y el Edificio.
     *      4. Añade la cumplimentación y recalcula el estado del Plan en el Edificio.
     */
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
            return $feedback;
        }

        $this->impSim_entity->edificio_id = $this->edificio_id;
        $feedback = $this->search_all_impsims();
        if(!$feedback['ok']) {
            return $feedback;
        }

        $new_element = ($feedback['code'] == 'BLDSIMS_SEARCH_EMPT');
        $this->impSim_entity->setAttributes(array('edificio_id' => $this->edificio_id, 'fecha_planificacion' => default_data, 'destinatarios' => default_destinatarios,
                                                    'fecha_vencimiento' => default_data, 'fecha_cumplimentacion' => default_data, 'url_recurso' => default_url,
                                                    'estado' => 'pendiente'));
        $feedback = $this->impSim_entity->ADD();
        if($feedback['ok']) {
            $cumplimentacion_id = $this->impSim_entity->cumplimentacion_id;
            $feedback = $this->ADD($simulacrum);
            if($feedback['ok']) {
                $feedback['building'] = array('edificio_id' => $building['edificio_id']);
                $this->update_plan_state($building['edificio_id'], $simulacrum['plan_id']);
                if($new_element) {
                    $this->notify_manager($building, $simulacrum['plan_id']);
                }
                return $feedback;
            }
            $this->impSim_entity->cumplimentacion_id = $cumplimentacion_id;
            $this->impSim_entity->DELETE();
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'IMPSIM_ADD_KO';
        }

        return $feedback;
    }

    /*
     *  - Elimina la cumplimentación de un Simulacro.
     *      1. Valida y busca la cumplimentación por ID.
     *      2. Comprueba que el usuario tiene permisos sobre el edificio (es el responsable del edificio o el rol del usuario es 'organizacion' o 'administrador')
     *      3. En caso de que el rol del usuario sea 'edificio', verifica que la cumplimentación a eliminar no sea la única cumplimentación del Simulacro en el Edificio.
     *      4. Elimina la cumplimentación y actualiza el estado del Plan en el Edificio.
     */
    function DELETE() {
        $this->feedback = $this->seek();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $imp_sim = $this->feedback['resource'];
        if(es_resp_edificio()) {
            $this->feedback = $this->check_more_than_one_impsims($imp_sim['edificio_id'], $imp_sim['simulacro_id']);
            if(!$this->feedback['ok']) {
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

        return $this->feedback;
    }

    /*
     *  - Modifica el estado de la cumplimentación de un Simulacro a 'vencido'.
     *      1. Valida y busca la cumplimentación por ID.
     *      2. Comprueba que el usuario tiene permisos sobre el edificio (es el responsable del edificio o el rol del usuario es 'organizacion' o 'administrador').
     *      3. Modifica el estado de la cumplimentación y añade la fecha actual como fecha de vencimiento.
     *      4. Actualiza el estado del Plan en el Edificio.
     */
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

        return $this->feedback;
    }

    /*
     *  - Cumplimenta la cumplimentación de un Simulacro.
     *      1. Valida y busca la cumplimentación por ID.
     *      2. Comprueba que el usuario tiene permisos sobre el edificio (es el responsable del edificio o el rol del usuario es 'organizacion' o 'administrador')
     *      3. Verifica que la cumplimentación esté ACTIVA (estado Pendiente o Cumplimentado).
     *      4. Valida los valores de los atributos necesarios para la cumplimentación.
     *      5. Modifica la cumplimentación y actualiza el estado del Plan en el Edificio.
     */
    function implement() {
        $this->feedback = $this->seek();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $imp_sim = $this->feedback['resource'];
        if($imp_sim['estado'] == 'vencido') {
            $this->feedback['ok'] = false;
            $this->feedback['code'] = 'COMPL_EXPIRED';
            return $this->feedback;
        }

        $validation = $this->validar_atributos_implement();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->impSim_entity->setAttributes(array('estado' => 'cumplimentado', 'fecha_cumplimentacion' => date('Y-m-d')));
        $this->feedback = $this->impSim_entity->EDIT();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'IMPSIM_IMPL_OK';
            $this->update_plan_state($imp_sim['edificio_id'], $imp_sim['plan_id']);
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'IMPSIM_IMPL_KO';
        }

        return $this->feedback;
    }

    function seek() {
        $validation = $this->validar_CUMPLIMENTACION_ID();
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

    /*
     *  - Consulta la información de la cumplimentación de un Simulacro del Portal.
     *      1. Valida y busca la cumplimentación por ID.
     *      2. Verifica que la cumplimentación está ACTIVA (Pendiente o Cumplimentada).
     */
    function seekPortalImpSim() {
        $validation = $this->validar_CUMPLIMENTACION_ID();
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

    // Valida y busca un Simulacro y un Edificio por ID, y comprueba que existe una asociación entre el Plan del Simulacro y el Edificio.
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

    // Valida y busca la definición de un Simulacro por ID.
    function seekSimulacrum() {
        $validation = $this->validar_SIMULACRO_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        return $this->seekBySimID();
    }

    // Busca un Simulacro por ID.
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

    // Busca un Edificio por ID.
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

    // Busca la asociación entre un Plan y un Edificio por ID.
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

    // Búsqueda de una cumplimentación de un Simulacro por ID.
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

    /*
     *  - Obtención del estado de un Simulacro en un Edificio.
     *      1. Recupera todas las cumplimentaciones del Simulacro en el Edificio.
     *      2. Calcula el estado del Simulacro en función de las cumplimentaciones recuperadas.
     */
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
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['code'] = 'BLDSIMS_SEARCH_EMPT';
            } else {
                $feedback['code'] = 'BLDSIMS_SEARCH_OK';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'BLDSIMS_SEARCH_KO';
        }

        return $feedback;
    }

    // Búsqueda de TODAS las cumplimentaciones de un Simulacro en un Edificio.
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

    // Cálculo y actgualización del estado de un Plan en un Edificio.
    function update_plan_state($edificio_id, $plan_id) {
        include_once './Service/CheckState_Service.php';
        $checkState_service = new CheckState_Service($edificio_id, $plan_id);
        $checkState_service->update_plan_state();
    }

    // Consulta de número de cumplimentaciones de un Simulacro en un Edificio mayor que 1.
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

    function notify_manager($building, $plan_id) {
        include_once './Model/Notification_Model.php';
        $notification_entity = new Notification_Model();
        $notification_entity->setAttributes(array(
            'username' => $building['username'],
            'edificio_id' => $building['edificio_id'],
            'plan_id' => $plan_id,
            'mensaje' => self::msg_new_sim
        ));
        $notification_entity->ADD();
    }

}
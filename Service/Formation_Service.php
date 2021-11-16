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
        $this->atributos = array('cumplimentacion_id', 'edificio_id', 'formacion_id', 'estado', 'fecha_planificacion', 'fecha_planificacion_inicio', 'fecha_planificacion_fin',
            'fecha_vencimiento', 'fecha_vencimiento_inicio', 'fecha_vencimiento_fin', 'fecha_cumplimentacion', 'fecha_cumplimentacion_inicio',
            'fecha_cumplimentacion_fin','url_recurso', 'destinatarios', 'nombre_edificio');
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


    /*
     *  - Busca Cumplimentaciones de una Formación.
     *      1. Valida y busca la formación por ID.
     *      2. Valida el resto de atributos utilizados como filtro.
     *      3. Recupera las cumplimentaciones de la Formación que cumplan con los datos de filtrado.
     */
    function searchCompletions() {
        $this->feedback = $this->seekFormation();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $format = $this->feedback['resource'];
        $validation = $this->validar_atributos_searchCompletions();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->impFormat_entity->searchCompletions();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'IMPFORMAT_SEARCH_OK';
            $this->feedback['formation'] = $format;
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'IMPFORMAT_SEARCH_KO';
        }

        return $this->feedback;
    }

    /*
     *  - Recupera los detalles de una Formación en un Edificio.
     *  - Los detalles de una Formación incluyen los datos de la Definición de la Formación junto con sus cumplimentaciones en el Edificio.
     *      1. Valida y busca la formación y el edificio por ID, y comprueba que el plan de la formación está asociado al edificio.
     *      2. Comprueba que el usuario tenga permisos sobre el edificio (es el responsable del edificio o el rol del usuario es 'organizacion' o 'administrador').
     *      3. Valida el resto de atributos utilizados en la búsqueda (filtrado)
     *      4. Calcula el estado de la formación en el edificio.
     *      5. Realiza la búsqueda.
     */
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
            return $validation;
        }

        $format_state = $this->get_formation_state();
        if(!$format_state['ok']) {
            return $format_state;
        }

        $formation['estado'] = $format_state['estado'];
        $this->feedback = $this->impFormat_entity->SEARCH();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'IMPFORMAT_SEARCH_OK';
            $this->feedback['formation'] = $formation;
            $this->feedback['building'] = $building;
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'IMPFORMAT_SEARCH_KO';
        }

        return $this->feedback;
    }

    /*
     *  - Recupera los detalles de una Formación en el Edificio del Portal.
     *  - Los detalles de una Formación incluyen los datos de la Definición de la Formación junto con sus cumplimentaciones ACTIVAS en el Edificio.
     *      1. Valida y busca la formación y el edificio por ID, y comprueba que el plan de la formación está asociado al edificio.
     *      2. Verifica que la asignación del plan de la formación y el edificio esté ACTIVA.
     *      3. Se obtiene dinámicamente el estado de la Formación en el Edificio, y comprueba que este esté ACTIVO.
     *      4. Recupera las cumplimentaciones ACTIVAS de la Formación en el Edificio.
     */
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
            return $this->feedback;
        }

        $formation['estado'] = $format_state['estado'];

        $validation = $this->validar_atributos_search_portal();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->impFormat_entity->searchActiveImpFormats();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'PRTL_IMPFORMAT_SEARCH_OK';
            $this->feedback['formation'] = $formation;
            $this->feedback['building'] = $building;
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'PRTL_IMPFORMAT_SEARCH_KO';
        }

        return $this->feedback;
    }

    // Valida y busca una Definición de Formación por ID, y recupera los Edificios que tengan una asignación ACTIVA con el Plan de la Formación.
    function addImpFormatForm() {
        $this->feedback = $this->seekFormation();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $formation = $this->feedback['resource'];
        $this->feedback = $this->searchActiveBuildPlans($formation['plan_id']);
        if($this->feedback['ok']) {
            $this->feedback['formation'] = $formation;
        }

        return $this->feedback;
    }

    /*
     *  Valida y busca una Formación y un Edificio por ID, comprueba que existe una asociación entre el Plan de la Formación y el Edificio, y comprueba que el
     *  usuario tenga permisos sobre el edificio.
     */
    function formationForm() {
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


    // Valida y busca una Formación y un Edificio por ID, y comprueba que exista una asociación ACTIVA entre el Plan de la Formación y el Edificio.
    function searchPortalFormationForm() {
        $this->feedback = $this->searchFormatAndBuilding();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $bld_plan = $this->feedback['resource'];
        if($bld_plan['estado'] == 'vencido') {
            $this->feedback['ok'] = false;
            $this->feedback['code'] = 'BLDFORMAT_NOT_EXST';
            unset($this->feedback['resource'], $this->feedback['formation'], $this->feedback['building']);
        }

        return $this->feedback;
    }

    /*
     *  1. Valida y busca una Definición de Formación por ID.
     *  2. Valida los Edificios por ID.
     *  3. Llama a la función ADD para añadir las cumplimentaciones en estado Pendiente de la Formación en los Edificios.
     */
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
        return $this->ADD($formation);
    }

    /*
     *  - Crea una Cumplimentación en estado PENDIENTE de la Formación que se pasa como parámetro en cada uno de los Edificios.
     *  - Para cada uno de los Edificios:
     *      1. Comprueba que el edificio existe.
     *      2. Valida que el usuario que solicita la acción tiene permisos sobre el edificio.
     *      3. Comprueaba que existe una asociación ACTIVA entre el Plan de la Formación y el Edificio.
     *      4. Añade la Cumplimentación y recalcula el estado del Plan en el Edificio.
     *  -  En caso de que se produzca un error al crear alguna de las cumplimentaciones, deshace TODOS los cambios realizados hasta el momento.
     */
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

        $bld_plan = $feedback['resource'];
        if($bld_plan['estado'] == 'vencido') {
            $feedback['ok'] = false;
            $feedback['code'] = 'BLDPLAN_EXPIRED';
            return $feedback;
        }

        $this->impFormat_entity->setAttributes(array('edificio_id' => $this->edificio_id, 'fecha_planificacion' => default_data, 'destinatarios' => default_destinatarios,
                                                            'fecha_vencimiento' => default_data, 'fecha_cumplimentacion' => default_data,
                                                            'url_recurso' => default_url, 'estado' => 'pendiente'));
        $feedback = $this->impFormat_entity->ADD();
        if($feedback['ok']) {
            $cumplimentacion_id = $this->impFormat_entity->cumplimentacion_id;
            $feedback = $this->ADD($formation);
            if($feedback['ok']) {
                $this->update_plan_state($building['edificio_id'], $formation['plan_id']);
                return $feedback;
            }
            $this->impFormat_entity->cumplimentacion_id = $cumplimentacion_id;
            $this->impFormat_entity->DELETE();
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'IMPFORMAT_ADD_KO';
        }

        return $feedback;
    }

    /*
     *  - Elimina la cumplimentación de una Formación
     *      1. Valida y busca la cumplimentación por ID.
     *      2. Comprueba que el usuario tiene permisos sobre el edificio (es el responsable del edificio o el rol del usuario es 'organizacion' o 'administrador')
     *      3. En el caso de que rol del usuario sea 'edificio', verifica que la cumplimentación a eliminar no sea la única cumpolimetnación de la Formación en el Edificio.
     *      4. Elimina la cumplimentación y actualiza el estado del Plan en el Edificio.
     */
    function DELETE() {
        $this->feedback = $this->seek();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $imp_format = $this->feedback['resource'];
        if(es_resp_edificio()) {
            $this->feedback = $this->check_more_than_one_impformats($imp_format['edificio_id'], $imp_format['formacion_id']);
            if(!$this->feedback['ok']) {
                return $this->feedback;
            }
        }

        $this->feedback = $this->impFormat_entity->DELETE();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'IMPFORMAT_DEL_OK';
            $this->update_plan_state($imp_format['edificio_id'], $imp_format['plan_id']);
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'IMPFORMAT_DEL_KO';
        }

        return $this->feedback;
    }

    /*
     *  - Consulta la información de la cumplimentación de una Formación.
     *      1. Valida y busca la cumplimentación por ID.
     *      2. Comprueba que el usuario tiene permisos sobre el edificio (es el responsable del edificio o el rol del usuario es 'organizacion' o 'administrador')
     */
    function seek() {
        $validation = $this->validar_CUMPLIMENTACION_ID();
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
        } else if($this->feedback['code'] == 'IMPFORMATID_KO') {
            $this->feedback['code'] = 'IMPFORMAT_SEEK_KO';
        }

        return $this->feedback;
    }

    /*
     *  - Consulta la información de la cumplimentación de una Formación del Portal.
     *      1. Valida y busca la cumplimentación por ID.
     *      2. Verifica que la cumplimentación está ACTIVA (Pendiente o Cumplimentada).
     */
    function seekPortalImpFormat() {
        $validation = $this->validar_CUMPLIMENTACION_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByImpFormatID();
        if($this->feedback['ok']) {
            $imp_format = $this->feedback['resource'];
            if($imp_format['estado'] == 'vencido') {
                $this->feedback['ok'] = false;
                $this->feedback['code'] = 'IMPFORMATID_NOT_EXST';
                unset($this->feedback['resource']);
            } else {
                $this->feedback['code'] = 'PRTL_IMPFORMAT_SEEK_OK';
            }
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'PRTL_IMPFORMAT_SEEK_KO';
        }

        return $this->feedback;
    }

    /*
     *  - Modifica el estado de la cumplimentación de una Formación a 'vencido'.
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

        $imp_format = $this->feedback['resource'];
        $this->impFormat_entity->estado = 'vencido';
        $this->impFormat_entity->fecha_vencimiento = date('Y-m-d');
        $this->feedback = $this->impFormat_entity->EDIT();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'IMPFORMAT_EXPIRE_OK';
            $this->update_plan_state($imp_format['edificio_id'], $imp_format['plan_id']);
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'IMPFORMAT_EXPIRE_KO';
        }

        return $this->feedback;
    }

    /*
     *  - Cumplimenta la cumplimentación de una Formación.
     *      1. Valida y busca la cumplimentación por ID.
     *      2. Comprueba que el usuario tiene permisos sobre el edificio (es el responsable del edificio o el rol del usuario es 'organizacion' o 'administrador').
     *      3. Verifica que la cumplimentación esté ACTIVA (estado Pendiente o Cumplimentado).
     *      4. Valida los valores de los atributos necesarios para la cumplimentación.
     *      5. Modifica la cumplimentación y actualiza el estado del Plan en el Edificio.
     */
    function implement() {
        $this->feedback = $this->seek();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $imp_format = $this->feedback['resource'];
        if($imp_format['estado'] == 'vencido') {
            $this->feedback['ok'] = false;
            $this->feedback['code'] = 'COMPL_EXPIRED';
            return $this->feedback;
        }

        $validation = $this->validar_atributos_implement();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->impFormat_entity->setAttributes(array('estado' => 'cumplimentado', 'fecha_cumplimentacion' => date('Y-m-d')));
        $this->feedback = $this->impFormat_entity->EDIT();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'IMPFORMAT_IMPL_OK';
            $this->update_plan_state($imp_format['edificio_id'], $imp_format['plan_id']);
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'IMPFORMAT_IMPL_KO';
        }

        return$this->feedback;
    }

    // Valida y busca una Formación y un Edificio por ID, y comprueba que existe una asociación entre el Plan de la Formación y el Edificio.
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

    // Valida y busca la definición de una Formación por ID.
    function seekFormation() {
        $validation = $this->validar_FORMACION_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        return $this->seekByFormatID();
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

    // Busca la asociación entre un Plan y un Edificio por IDs.
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

    // Búsqueda de una Formación por ID.
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

    // Búsqueda de una cumplimentación de una Formación por ID.
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


    /*
     *  - Obtención del estado de una Formación en un Edificio.
     *      1. Recupera todas las cumplimentaciones de la Formación en el Edificio.
     *      2. Calcula el estado de la Formación en función de las cumplimentaciones recuperadas.
     */
    function get_formation_state() {
        $feedback = $this->search_all_impformats();
        if(!$feedback['ok']) {
            return $feedback;
        }

        include_once './Service/CheckState_Service.php';
        $checkState_service = new CheckState_Service();
        $estado = $checkState_service->get_state_element($feedback['resource']);
        return array('ok' => true, 'estado' => $estado);
    }

    // Búsqueda de TODAS las cumplimentaciones de una Formación en un Edificio.
    function search_all_impformats() {
        $feedback = $this->impFormat_entity->searchFormatsBuildings();
        if($feedback['ok']) {
            $feedback['code'] = 'BLDFORMATS_SEARCH_OK';
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'BLDFORMATS_SEARCH_KO';
        }

        return $feedback;
    }

    // Cálculo y actualización del estado de un Plan en un Edificio.
    function update_plan_state($edificio_id, $plan_id) {
        include_once './Service/CheckState_Service.php';
        $checkState_service = new CheckState_Service($edificio_id, $plan_id);
        $checkState_service->update_plan_state();
    }

    // Búsqueda de asociaciones ACTIVAS (Pendiente o Cumplimetnado) Edificio - Plan por ID de Plan.
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

    // Consulta de número de cumplimentaciones de una Formación en un Edificio mayor que 1.
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
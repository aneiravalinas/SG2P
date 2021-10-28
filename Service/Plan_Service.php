<?php


// Última revisión: 2021-10-19

include_once './Validation/Plan_Validation.php';
include_once './Model/BuildPlan_Model.php';

class Plan_Service extends Plan_Validation {
    var $atributos;
    var $bldPlan_entity;
    var $feedback = array();

    function __construct() {
        $this->atributos = array('edificio_id','plan_id','fecha_asignacion','fecha_cumplimentacion','fecha_vencimiento','estado','nombre_edificio','nombre_plan');
        $this->bldPlan_entity = new BuildPlan_Model();
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
     *  - Recupera las asignaciones entre Planes y Edificios.
     *      1. Valida los atributos recibidos para el filtrado.
     *      2. Recupera las asignaciones que coincidan con los criterios de búsqueda.
     *          2a. Para los usuarios con rol de Responsable de Organización o Administrador, recupera todas las asignaciones.
     *          2b. Para los usuarios con rol de Responsable de Edificio, solo recupera las asignaciones con los Edificios de los que sea responsable.
     */
    function SEARCH() {
        $validation = $this->validar_atributos_search();
        if(!$validation['ok']) {
            return $validation;
        }

        if(es_resp_edificio()) {
            $this->feedback = $this->bldPlan_entity->searchBuildPlansByResp(getUser());
        } else {
            $this->feedback = $this->bldPlan_entity->searchBuildPlans();
        }

        if($this->feedback['ok']) {
            $this->feedback['code'] = 'PLAN_SEARCH_OK';
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'PLAN_SEARCH_KO';
        }

        return $this->feedback;
    }

    /*
     *  - Recupera las asignaciones ACTIVAS (Estado: Pendiente o Cumplimentado) entre Planes y el Edificio del Portal.
     *         1. Valida los datos recibidos para la búsqueda.
     *         2. Comprueba que el edificio existe.
     *         3. Recupera los planes ACTIVOS asignados con el edificio que cumplan con los criterios de búsqueda.
     */
    function searchPortalPlans() {
        $validation = $this->validar_atributos_search_portal();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByBuildingID();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $building = $this->feedback['resource'];

        $this->feedback = $this->bldPlan_entity->searchPortalPlans();
        if($this->feedback['ok']) {
            $this->feedback['building'] = array('edificio_id' => $building['edificio_id'], 'nombre' => $building['nombre']);
            $this->feedback['code'] = 'PRTL_PLANS_SEARCH_OK';
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'PRTL_PLANS_SEARCH_KO';
        }

        return $this->feedback;
    }

    /*
     *  - Consulta los detalles de un Plan en un Edificio.
     *  - Los detalles de un Plan incluyen la información de la definición del Plan junto con los elementos (Documentos, Procedimientos ...) que lo conforman.
     *       1. Valida IDs del Edificio y del Plan.
     *       2. Comprueba que el edificio exista y que el usuario tenga permisos sobre el edificio, comprueba que el plan existe y que este esté asignado al edificio.
     *       3. Calcula dinámicamente el estado de cada uno de los TIPOS de elemento que conforman el plan y el estado de cada uno de los elementos.
     *       4. Devuelve la información del Plan junto con los elementos que lo conforman.
     */
    function seek() {
        $validation = $this->validar_atributos_seek();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByBuildingID();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $building = $this->feedback['resource'];
        if(es_resp_edificio() && (getUser() != $building['username'])) {
            $this->feedback['ok'] = false;
            $this->feedback['code'] = 'PLAN_SEEK_FRBD';
            unset($this->feedback['resource']);
            return $this->feedback;
        }

        $this->feedback = $this->seekByPlanID();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $plan = $this->feedback['resource'];

        $this->feedback = $this->seekBldPlan();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $bld_plan = $this->feedback['resource'];

        /*
         *  - La función checkStatePlan() del CheckState_Service determina el ESTADO del Plan en el Edificio en función del estado de cada uno de los elementos que
         *  componen el Plan.
         *  - Una vez se ejecuta esta función, el CheckState_Service dispone en los arrays "documentos, procedimientos, rutas, formaciones y simulacros" la información
         *  de cada una de estos elementos junto con su estado en el edificio así como el estado del TIPO de elemento. Esta es la información de interés y el motivo
         *  por el que se ejecuta la función.
         *      - Estos arrays siguen la siguiente estructura:
         *          * documentos {
         *              [ok] => true,
         *              [code] => 'CODE',
         *              [estado] => 'pendiente', --- Estado GENERAL de los DOCUMENTOS
         *              [elementos] => {
         *                  [documento1] => id, nombre..., ESTADO ... --- Estado ESPECÍFICO de ese Documento.
         *                  [documento2] => id, nombre..., ESTADO ... --- Estado ESPECÍFICO de ese Documento.
         *                 }
         *           }
         */
        include_once './Service/CheckState_Service.php';
        $checkState_service = new CheckState_Service($bld_plan['edificio_id'], $bld_plan['plan_id']);
        $result = $checkState_service->checkStatePlan();
        if(!$result['ok']) {
            return $result;
        }


        $this->feedback['code'] = 'PLAN_SEEK_OK';
        $this->feedback['edificio'] = $building;
        $this->feedback['plan'] = $plan;
        $this->feedback['definiciones'] = array(
            'documentos' => $checkState_service->documentos,
            'procedimientos' => $checkState_service->procedimientos,
            'rutas' => $checkState_service->rutas,
            'formaciones' => $checkState_service->formaciones,
            'simulacros' => $checkState_service->simulacros
        );

        return $this->feedback;
    }


    /*
     *  - Consulta los detalles de un Plan en el Edificio del Portal.
     *  - Los detalles de un Plan incluyen la información de la definición del Plan junto con los elementos (Documentos, Procedimientos ...) que lo conforman.
     *       1. Valida IDs del Edificio y del Plan.
     *       2. Comprueba que el edificio y el plan existe, y que exista una asignacion ACTIVA entre ellos.
     *       3. Calcula dinámicamente el estado de cada uno de los TIPOS de elemento que conforman el plan y el estado de cada uno de los elementos.
     *          - Los elementos cuyo estado sea vencido o cuya visibilidad tenga el valor 'NO' no se devuelven en el resultado.
     *       4. Devuelve la información del Plan junto con los elementos ACTIVOS y VISIBLES que lo conforman.
     */
    function seekPortalPlan() {
        $validation = $this->validar_atributos_seek();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByBuildingID();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $building = $this->feedback['resource'];

        $this->feedback = $this->seekByPlanID();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $plan = $this->feedback['resource'];

        $this->feedback = $this->seekBldPlan();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $bld_plan = $this->feedback['resource'];
        if($bld_plan['estado'] == 'vencido') {
            $this->feedback['ok'] = false;
            $this->feedback['code'] = 'BLDPLAN_NOT_EXST';
            unset($this->feedback['resource']);
            return $this->feedback;
        }

        /*
         *  - La función checkStatePlan() del CheckState_Service determina el ESTADO del Plan en el Edificio en función del estado de cada uno de los elementos que
         *  componen el Plan.
         *  - Una vez se ejecuta esta función, el CheckState_Service dispone en los arrays "documentos, procedimientos, rutas, formaciones y simulacros" la información
         *  de cada una de estos elementos junto con su estado en el edificio así como el estado del TIPO de elemento. Esta es la información de interés y el motivo
         *  por el que se ejecuta la función.
         *      - Estos arrays siguen la siguiente estructura:
         *          * documentos {
         *              [ok] => true,
         *              [code] => 'CODE',
         *              [estado] => 'pendiente', --- Estado GENERAL de los DOCUMENTOS
         *              [elementos] => {
         *                  [documento1] => id, nombre..., ESTADO ... --- Estado ESPECÍFICO de ese Documento.
         *                  [documento2] => id, nombre..., ESTADO ... --- Estado ESPECÍFICO de ese Documento.
         *                 }
         *           }
         */
        include_once './Service/CheckState_Service.php';
        $checkState_service = new CheckState_Service($bld_plan['edificio_id'], $bld_plan['plan_id']);
        $result = $checkState_service->checkStatePlan();
        if(!$result['ok']) {
            return $result;
        }

        $this->feedback['code'] = 'PLAN_SEEK_OK';
        $this->feedback['edificio'] = $building;
        $this->feedback['plan'] = $plan;
        $this->feedback['definiciones'] = array(
            'documentos' => $this->clear_not_visible_or_expired($checkState_service->documentos),
            'procedimientos' => $this->clear_not_visible_or_expired($checkState_service->procedimientos),
            'rutas' => $this->clear_not_visible_or_expired($checkState_service->rutas),
            'formaciones' => $this->clear_not_visible_or_expired($checkState_service->formaciones),
            'simulacros' => $this->clear_not_visible_or_expired($checkState_service->simulacros)
        );

        return $this->feedback;
    }


    // Elimina del listado de definiciones que se pasa por parámetros aquellas definiciones que NO sean "visibles" o cuyo estado sea "vencido".
    function clear_not_visible_or_expired($elements) {
        foreach($elements['elementos'] as $key => $element) {
            if((isset($element['visible']) && $element['visible'] == 'no') || $element['estado'] == 'vencido') {
                unset($elements[$key]);
            }
        }

        return $elements;
    }


    // Recupera la información de un Edificio filtrando por ID.
    function seekByBuildingID() {
        include_once './Model/Building_Model.php';
        $building_entity = new Building_Model();
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

    // Recupera la información de un Plan filtrando por ID.
    function seekByPlanID() {
        include_once './Model/DefPlan_Model.php';
        $defPlan_entity = new DefPlan_Model();
        $feedback = $defPlan_entity->seek();
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

    // Recupera la información de una asignación entre un Edificio y un Plan por ID de Edificio e ID de Plan.
    function seekBldPlan() {
        $feedback = $this->bldPlan_entity->seek();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'BLDPLAN_NOT_EXST';
            } else {
                $feedback['code'] = 'BLDPLAN_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'BLDPLAN_KO';
        }

        return $feedback;
    }

}
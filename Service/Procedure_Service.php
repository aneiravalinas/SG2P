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
        $this->atributos = array('cumplimentacion_id','edificio_id','procedimiento_id','estado','fecha_cumplimentacion', 'fecha_cumplimentacion_inicio', 'fecha_cumplimentacion_fin',
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

    /*
     *  - Busca cumplimentaciones de un Procedimiento.
     *      1. Valida y busca un Procedimiento por ID.
     *      2. Valida atributos a usar en el filtrado.
     *      3. Recupera las cumplimentaciones del Procedimiento que cumplan con las condiciones de filtrado.
     */
    function searchCompletions() {
        $this->feedback = $this->seekProcedure();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $proc = $this->feedback['resource'];
        $validation = $this->validar_atributos_searchCompletions();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->impProc_entity->searchCompletions();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'IMPPROC_SEARCH_OK';
            $this->feedback['procedure'] = $proc;
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'IMPPROC_SEARCH_KO';
        }

        return $this->feedback;
    }

    /*
     *  - Recupera los detalles de un Procedimiento en un Edificio.
     *  - Los detalles de un Procedimiento incluyen los datos de la Definición del Procedimiento junto con sus cumplimentaciones en el Edificio.
     *      1. Valida y busca el procedimiento y el edificio por ID, y comprueba que el plan del procedimiento está asociado al edificio.
     *      2. Comprueba que el usuario tenga permisos sobre el edificio (es el responsable del edificio o el rol del usuario es 'organizacion' o 'administrador').
     *      3. Valida el resto de atributos utilizados en la búsqueda (filtrado)
     *      4. Calcula el estado del procedimiento en el edificio.
     *      5. Realiza la búsqueda.
     */
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
            return $validation;
        }

        $proc_state = $this->get_procedure_state();
        if(!$proc_state['ok']) {
            return $proc_state;
        }

        $procedure['estado'] = $proc_state['estado'];
        $this->feedback = $this->impProc_entity->SEARCH();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'IMPPROC_SEARCH_OK';
            $this->feedback['procedure'] = $procedure;
            $this->feedback['building'] = $building;
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'IMPPROC_SEARCH_KO';
        }

        return $this->feedback;
    }

    /*
     *  - Recupera los detalles del Procedimiento en el Edificio del Portal.
     *  - Los detalles del Procedimiento incluyen los datos de la Definición del Procedimiento junto con sus cumplimentaciones ACTIVAS en el Edificio.
     *      1. Valida y busca el procedimiento y el edificio por ID, y comprueba que el plan del procedimiento esté asociado al edificio.
     *      2. Comprueba que la asignación del plan del procedimiento y el edificio esté ACTIVA.
     *      3. Se obtiene dinámicamente el estado del Procedimiento en el Edificio, y compruebe que este se encuentre ACTIVO.
     *      4. Recupera las cumplimentaciones ACTIVAS del Procedimiento en el Edificio.
     */
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
            return $this->feedback;
        }

        $procedure['estado'] = $proc_state['estado'];
        $this->feedback = $this->impProc_entity->searchActiveImpProcs();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'PRTL_IMPPROC_SEARCH_OK';
            $this->feedback['procedure'] = $procedure;
            $this->feedback['building'] = $building;
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'PRTL_IMPPROC_SEARCH_KO';
        }

        return $this->feedback;
    }

    /*
     *  - Valida y busca un Procedimiento y un Edificio por ID, comprueba que el plan del procedimiento esté asignado al edificio y que el usuario tenga permisos sobre
     *    el edificio.
     */
    function procedureForm() {
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

    // Valida y busca una Definición del Procedimiento por ID, y recupera los Edificios que tengan una asignación ACTIVA con el Plan del Procedimiento.
    function addImpProcForm() {
        $this->feedback = $this->seekProcedure();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $procedure = $this->feedback['resource'];
        $this->feedback = $this->searchActiveBuildPlans($procedure['plan_id']);
        if($this->feedback['ok']) {
            $this->feedback['procedure'] = $procedure;
        }

        return $this->feedback;
    }

    /*
     *  1. Valida y busca una Definicón de Procedimiento por ID.
     *  2. Valida los Edificios por ID.
     *  3. Llama a la función ADD para añadir las cumplimentaciones del Procedimiento en los Edificios.
     */
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
        return $this->ADD($procedure);
    }

    /*
     *  Crea una Cumplimentación en estado PENDIENTE del Procedimiento que se pasa como parámetro en cada uno de los Edificios.
     *  Para cada uno de los Edificios:
     *      1. Comprueba que el edificio existe.
     *      2. Valida que el usuario que realiza la acción tiene permisos sobre el edificio.
     *      3. Comprueba que existe una asociación ACTIVA entre el Plan del Procedimiento y el Edificio.
     *      4. Verifica que NO existen cumplimentaciones ACTIVAS del Procedimiento en el Edificio.
     *      5. Si no existe, crea el directorio de la definición del Procedimiento dentro dle directorio Uploads.
     *              - Ejemplo de ruta de directorios: Uploads/PLAN_ID/EDIFICIO_ID/Procedimientos/PROCEDIMIENTO_ID/.
     *      6. Recalcula el estado del Plan en el Edificio.
     *  En caso de que se produzca un error al crear alguna de las cumplimentaciones, deshace TODOS los cambios realizados hasta el momento.
     */
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
            return $feedback;
        }

        $feedback = $this->proc_building_actives_not_exist();
        if(!$feedback['ok']) {
            return $feedback;
        }

        include_once './Service/Uploader_Service.php';
        $uploader = new Uploader();
        $path = plans_path . $procedure['plan_id'] . '/' . $this->edificio_id . '/Procedimientos/';
        $def_dir_crated = false;
        if(!$uploader->dir_exist($path . $this->procedimiento_id)['ok']) {
            $feedback = $uploader->create_dir($path, $this->procedimiento_id);
            if(!$feedback['ok']) {
                $feedback['code'] = 'BLDPLAN_DIRPROC_KO';
                return $feedback;
            }
            $def_dir_crated = true;
        }

        $this->impProc_entity->setAttributes(array('edificio_id' => $this->edificio_id, 'nombre_doc' => default_doc, 'fecha_vencimiento' => default_data,
                                                    'fecha_cumplimentacion' => default_data, 'estado' => 'pendiente'));
        $feedback = $this->impProc_entity->ADD();
        if($feedback['ok']) {
            $imp_proc_id = $this->impProc_entity->cumplimentacion_id;
            $feedback = $this->ADD($procedure);
            if($feedback['ok']) {
                $this->update_plan_state($building['edificio_id'], $procedure['plan_id']);
                return $feedback;
            }
            $this->impProc_entity->cumplimentacion_id = $imp_proc_id;
            $this->impProc_entity->DELETE();
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'IMPPROC_ADD_KO';
        }

        if($def_dir_crated) {
            $uploader->delete($path . $this->procedimiento_id);
        }

        return $feedback;
    }

    /*
     *  Elimina la cumplimentación de un Procedimiento.
     *      1. Valida y busca la cumplimentación por ID.
     *      2. Comprueba que el usuario tiene permisos sobre el edificio (es el responsable del edificio o el rol del usuario es 'organizacion' o 'administrador')
     *      3. En caso de que el rol del usuario sea 'edificio', verifica que la cumplimentación a eliminar no sea la única cumplimentación del Procedimiento en el Edificio.
     *      4. Elimina la cumplimentación y el fichero asociado.
     *      5. Actualiza el estado del Plan en el Edificio.
     */
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

        return $this->feedback;
    }


    /*
     *  Consulta la información de la cumplimentación de un Procedimiento.
     *      1. Valida y busca la cumplimentación por ID.
     *      2. Comprueba que el usuario tiene permisos sobre el edificio (es el responsable del edificio o el rol del usuario es 'organizacion' o 'administrador')
     *      3. Genera la ruta para acceder al fichero de la cumplimentación.
     *          - Formato de la ruta: Uploads/PLAN_ID/EDIFICIO_ID/Procedimientos/PROCEDIMIENTO_ID/CUMPLIMENTACION_ID/NOMBRE_FICHERO
     */
    function seek() {
        $validation = $this->validar_CUMPLIMENTACION_ID();
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
                                                    $imp_proc['procedimiento_id'] . '/' . $imp_proc['cumplimentacion_id'];
            $this->feedback['code'] = 'IMPPROC_SEEK_OK';
        } else if($this->feedback['code'] == 'IMPPROCID_KO') {
            $this->feedback['code'] = 'IMPPROC_SEEK_KO';
        }

        return $this->feedback;
    }

    /*
     *  Consulta la información de la cumplimentación de un Procedimiento del Portal.
     *      1. Valida y busca la cumplimentación por ID.
     *      2. Verifica que la cumplimentación esté ACTIVA (Pendiente o Cumplimentada)
     *      3. Genera la ruta para acceder al fichero de la cumplimentación.
     *          - Formato de la ruta: Uploads/PLAN_ID/EDIFICIO_ID/Procedimientos/PROCEDIMIENTO_ID/CUMPLIMENTACION_ID/NOMBRE_FICHERO
     */
    function seekPortalImpProc() {
        $validation = $this->validar_CUMPLIMENTACION_ID();
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
                                                    $imp_proc['procedimiento_id'] . '/' . $imp_proc['cumplimentacion_id'];
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'PRTL_IMPPROC_SEEK_KO';
        }

        return $this->feedback;
    }

    /*
     *  Modifica el estado de la cumplimentación de un Procedimiento a 'vencido'.
     *      1. Valida y busca la cumplimentación por ID.
     *      2. Comprueba que el usuario tiene permisos sobre el edificio (es el responsable del edificio o el rol del usuario es 'organizacion' o 'administrador')
     *      3. Modifica el estado de la cumplimentación y añade la fecha actual como fecha de vencimiento.
     *      4. Actualiza el estado del Plan en el Edificio.
     */
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

        return $this->feedback;
    }

    /*
     *  Cumplimenta la cumplimentación de un Procedimiento, subiendo el fichero asociado.
     *      1. Valida y busca la cumplimentación por ID.
     *      2. Comprueba que el usuario tiene permisos sobre el edificio (es el responsable del edificio o el rol del usuario es 'organizacion' o 'administrador').
     *      3. Verifica que la cumplimentación esté ACTIVA (estado Pendiente o Cumplimentado)
     *      4. Valida el fichero (nombre y extensión)
     *      5. Carga el fichero en el servidor, creando el directorio de la cumplimentación en caso de que no exista.
     *      6. Modifica el estado, el nombre del fichero y la fecha de cumplimentación.
     *      7. Elimina el fichero anterior asociado a la cumplimentación en caso de qeu existiera y actualiza el estado del Plan en el Edificio.
     */
    function implement() {
        $this->feedback = $this->seek();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $imp_proc = $this->feedback['resource'];
        if($imp_proc['estado'] == 'vencido') {
            $this->feedback['ok'] = false;
            $this->feedback['code'] = 'COMPL_EXPIRED';
            return $this->feedback;
        }

        $validation = $this->validar_NOMBRE_DOC();
        if(!$validation['ok']) {
            return $validation;
        }

        include_once './Service/Uploader_Service.php';
        $uploader = new Uploader();
        if(!$_SESSION['test']) {
            $this->feedback = $uploader->uploadFile($imp_proc['path'], $this->nombre_doc);
            if(!$this->feedback['ok']) {
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

        return $this->feedback;
    }

    // Valida y busca una Definición de Procedimiento por ID.
    function seekProcedure() {
        $validation = $this->validar_PROCEDIMIENTO_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        return $this->seekByProcID();
    }


    // Recupera uan definición de Procedimiento por ID.
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

    // Valida y busca un Procedimiento y un Edificio por ID, y comprueba que existe una asociación entre el Plan del Procedimiento y el Edificio.
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

    // Recupera la información de un Edificio por ID.
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

    // Recupera la información de la asociación entre un Plan y un Edificio por ID.
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

    // Cálculo y actualización del estado de un Plan en un Edificio.
    function update_plan_state($edificio_id, $plan_id) {
        include_once './Service/CheckState_Service.php';
        $checkState_service = new CheckState_Service($edificio_id, $plan_id);
        $checkState_service->update_plan_state();
    }

    /*
     *  Obtención del estado de un Procedimiento en un Edificio.
     *      1. Recupera todas las cumplimentaciones del Procedimiento en el Edificio.
     *      2. Calcula el estado del Procedimiento en función de las cumplimentaciones recuperadas.
     */
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

    // Búsqueda de TODAS las cumplimentaciones de un Procedimiento en un Edificio.
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

    // Búsqueda de cumplimentaciones ACTIVAS (Pendiente o Cumplimentado) de un Procedimiento en un Edificio.
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

    // Búsqueda de Cumplimentación de Procedimiento por ID.
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

    // Consulta de número de cumplimentaciones de un Procedimiento en un Edificio mayor que 1.
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
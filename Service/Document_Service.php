<?php

// Última Revisión : 2021-10-19

include_once './Validation/Document_Validation.php';
include_once './Model/DefDoc_Model.php';
include_once './Model/ImpDoc_Model.php';

class Document_Service extends Document_Validation {
    var $atributos;
    var $defDoc_entity;
    var $impDoc_entity;
    var $feedback = array();

    function __construct() {
        date_default_timezone_set("Europe/Madrid");
        $this->atributos = array('cumplimentacion_id','edificio_id','documento_id','estado','fecha_cumplimentacion', 'fecha_cumplimentacion_inicio', 'fecha_cumplimentacion_fin',
            'fecha_vencimiento', 'fecha_vencimiento_inicio', 'fecha_vencimiento_fin', 'nombre_edificio', 'nombre_doc');
        $this->defDoc_entity = new DefDoc_Model();
        $this->impDoc_entity = new ImpDoc_Model();
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
     *  - Busca Cumplimentaciones de un Documento.
     *      1. Valida y busca el documento por ID.
     *      2. Valida resto de atributos utilizados como filtro.
     *      3. Recupera las cumplimentaciones del Documento que cumplan con los datos de filtrado.
     */
    function searchCompletions() {
        $this->feedback = $this->seekDocument();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $doc = $this->feedback['resource'];
        $validation = $this->validar_atributos_searchCompletions();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->impDoc_entity->searchCompletions();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'IMPDOC_SEARCH_OK';
            $this->feedback['document'] = array('plan_id' => $doc['plan_id'],
                'documento_id' => $doc['documento_id'], 'nombre' => $doc['nombre']);
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'IMPDOC_SEARCH_KO';
        }

        return $this->feedback;
    }

    /*
     *  - Recupera los detalles del Documento en un Edificio.
     *  - Los detalles del Documento incluyen los datos de la Definición del Documento junto con sus cumplimentaciones en el Edificio.
     *      1. Valida y busca el documento y el edificio por ID, y comprueba que el plan del documento esté asociado al edificio.
     *      2. Comprueba que el usuario tenga permisos sobre el edificio (es el responsable del edificio o el rol del usuario es 'organizacion' o 'administrador'.
     *      3. Valida el resto de atributos utilizados en la búsqueda (filtrado).
     *      4. Calcula el estado del documento en el edificio.
     *      5. Realiza la búsqueda.
     */
    function searchDocument() {
        $this->feedback = $this->searchDocAndBuilding();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $document = $this->feedback['document'];
        $building = $this->feedback['building'];
        if(es_resp_edificio() && $building['username'] != getUser()) {
            $this->feedback['ok'] = false;
            $this->feedback['code'] = 'BLD_FRBD';
            unset($this->feedback['resource'], $this->feedback['document'], $this->feedback['plan']);
            return $this->feedback;
        }

        $validation = $this->validar_atributos_search();
        if(!$validation['ok']) {
            return $validation;
        }

        $doc_state = $this->get_document_state();
        if(!$doc_state['ok']) {
            return $doc_state;
        }

        $document['estado'] = $doc_state['estado'];
        $this->feedback = $this->impDoc_entity->SEARCH();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'IMPDOC_SEARCH_OK';
            $this->feedback['document'] = $document;
            $this->feedback['building'] = $building;
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'IMPDOC_SEARCH_KO';
        }

        return $this->feedback;
    }

    /*
     *  - Recupera los detalles del Documento en el Edificio del Portal.
     *  - Los detalles del Documento incluyen los datos de la Definición del Documento junto con sus cumplimentaciones ACTIVAS en el Edificio.
     *      1. Valida y busca el documento y el edificio por ID, y comprueba que el plan del documento esté asociado al edificio.
     *      2. Comprueba que el documento sea 'visible'.
     *      3. Verifica que la asignación del plan del documento y el edificio esté ACTIVA.
     *      4. Se obtiene dinámicamente el estado del Documento en el Edificio, y comprueba que este esté ACTIVO.
     *      5. Recupera las cumplimentaciones ACTIVAS del Documento en el Edificio.
     */
    function seekPortalDocument() {
        $this->feedback = $this->searchDocAndBuilding();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $document = $this->feedback['document'];
        if($document['visible'] == 'no') {
            $this->feedback['ok'] = false;
            $this->feedback['code'] = 'DFDOCID_NOT_EXST';
            unset($this->feedback['resource'], $this->feedback['document'], $this->feedback['building']);
            return $this->feedback;
        }

        $build_plan = $this->feedback['resource'];
        if($build_plan['estado'] == 'vencido') {
            $this->feedback['ok'] = false;
            $this->feedback['code'] = 'BLDDOC_NOT_EXST';
            return $this->feedback;
        }

        $doc_state = $this->get_document_state();
        if(!$doc_state['ok']) {
            return $doc_state;
        }

        $building = $this->feedback['building'];
        if($doc_state['estado'] == 'vencido') {
            $this->feedback['ok'] = false;
            $this->feedback['code'] = 'DFDOCID_NOT_EXST';
            unset($this->feedback['resource'], $this->feedback['document'], $this->feedback['building']);
            return $this->feedback;
        }

        $document['estado'] = $doc_state['estado'];
        $this->feedback = $this->impDoc_entity->searchActiveImpDocs();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'PRTL_IMPDOC_SEARCH_OK';
            $this->feedback['document'] = $document;
            $this->feedback['building'] = $building;
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'PRTL_IMPDOC_SEARCH_KO';
        }

        return $this->feedback;
    }

    // Valida y busca una Definición de Documento por ID.
    function seekDocument() {
        $validation = $this->validar_DOCUMENTO_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        return $this->seekByDocID();
    }


    // Valida y busca un Documento y un Edificio por ID, y comprueba que existe una asociación entre el Plan del Documento y el Edificio.
    function searchDocAndBuilding() {
        $validation = $this->validar_doc_and_building();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByDocID();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $document = $this->feedback['resource'];
        $this->feedback = $this->seekByBuildingID();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $building = $this->feedback['resource'];
        $this->feedback = $this->seekPlanBuilding($document['plan_id']);
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $this->feedback['document'] = $document;
        $this->feedback['building'] = $building;
        return $this->feedback;
    }

    // Valida y buscar una Definición de Documento por ID, y recupera los Edificios que tengan una asignación ACTIVA con el Plan del Documento.
    function addImpDocForm() {
        $this->feedback = $this->seekDocument();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $doc = $this->feedback['resource'];
        $this->feedback = $this->searchActiveBuildPlans($doc['plan_id']);
        if($this->feedback['ok']) {
            $this->feedback['document'] = $doc;
        }

        return $this->feedback;
    }

    /*
     *  Valida y busca un Documento y un Edificio por ID, comprueba que existe una asociación entre el Plan del Documento y el Edificio,
     *  y comprueba que el usuario tenga permisos sobre el edificio.
     */
    function documentForm() {
        $this->feedback = $this->searchDocAndBuilding();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $building = $this->feedback['building'];
        if(es_resp_edificio() && $building['username'] != getUser()) {
            $this->feedback['ok'] = false;
            $this->feedback['code'] = 'BLD_FRBD';
            unset($this->feedback['resource'], $this->feedback['document'], $this->feedback['building']);
        }

        return $this->feedback;
    }

    /*
     *  1. Valida y busca una Definición de Documento por ID.
     *  2. Valida los Edificios por ID.
     *  3. Llama a la función ADD para añadir las cumplimentaciones del Documento en los Edificios.
     */
    function addImpDoc() {
        $validation = $this->validar_atributos_add();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByDocID();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $document = $this->feedback['resource'];
        return $this->ADD($document);
    }

    /*
     *  Crea una Cumplimentación en estado PENDIENTE del Documento que se pasa como parámetro en cada uno de los Edificios.
     *  Para cada uno de los Edificios:
     *      1. Comprueba que el edificio existe.
     *      2. Valida que el usuario que realiza la acción tiene permisos sobre el edificio.
     *      3. Comprueba que existe una asociación ACTIVA entre el Plan del Documento y el Edificio.
     *      4. Verifica que NO existan cumplimentaciones ACTIVAS del Documento en el Edificio.
     *      5. Si no existe, crea el directorio de la definición del Documento dentro del directorio Uploads.
     *              - Ejemplo de ruta de directorios: Uploads/PLAN_ID/EDIFICIO_ID/Documentos/DOCUMENTO_ID/.
     *      6. Añade la Cumplimentación y recalcula el estado del Plan en el Edificio.
     *  En caso de que se produzca un error al crear alguna de las cumplimentaciones, deshace TODOS los cambios realizados hasta el momento.
     */
    function ADD($document) {
        if(empty($this->buildings)) {
            $feedback['ok'] = true;
            $feedback['code'] = 'IMPDOC_ADD_OK';
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
            return $feedback;
        }

        $feedback = $this->seekPlanBuilding($document['plan_id']);
        if(!$feedback['ok']) {
            return $feedback;
        }

        $bld_plan = $feedback['resource'];
        if($bld_plan['estado'] == 'vencido') {
            $feedback['ok'] = false;
            $feedback['code'] = 'BLDPLAN_EXPIRED';
            return $feedback;
        }

        $feedback = $this->doc_building_actives_not_exist();
        if(!$feedback['ok']) {
            return $feedback;
        }

        include_once './Service/Uploader_Service.php';
        $uploader = new Uploader();
        $path = plans_path . $document['plan_id'] . '/' . $this->edificio_id . '/Documentos/';
        $def_dir_created = false;
        if(!$uploader->dir_exist($path . $this->documento_id)['ok']) {
            $feedback = $uploader->create_dir($path, $this->documento_id);
            if(!$feedback['ok']) {
                $feedback['code'] = 'BLDPLAN_DIRDOC_KO';
                return $feedback;
            }
            $def_dir_created = true;
        }

        $this->impDoc_entity->setAttributes(array('edificio_id' => $this->edificio_id, 'nombre_doc' => default_doc, 'fecha_vencimiento' => default_data,
                                                    'fecha_cumplimentacion' => default_data, 'estado' => 'pendiente'));
        $feedback = $this->impDoc_entity->ADD();
        if($feedback['ok']) {
            $imp_doc_id = $this->impDoc_entity->cumplimentacion_id;
            $feedback = $this->ADD($document);
            if($feedback['ok']) {
                $this->update_plan_state($building['edificio_id'], $document['plan_id']);
                return $feedback;
            }
            $this->impDoc_entity->cumplimentacion_id = $imp_doc_id;
            $this->impDoc_entity->DELETE();
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'IMPDOC_ADD_KO';
        }

        if($def_dir_created) {
            $uploader->delete($path . $this->documento_id);
        }

        return $feedback;
    }

    /*
     *  Consulta la información de cumplimentación de un Documento.
     *      1. Valida y busca la cumplimentación por ID.
     *      2. Comprueba que el usuario tiene permisos sobre el edificio (es el responsable del edificio o el rol del usuario es 'organizacion' o 'administrador')
     *      3. Genera la ruta para acceder al fichero de la cumplimentación.
     *          - Formato de la ruta: Uploads/PLAN_ID/EDIFICIO_ID/Documentos/DOCUMENTO_ID/CUMPLIMENTACION_ID/NOMBRE_FICHERO.
     */
    function seek() {
        $validation = $this->validar_CUMPLIMENTACION_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByImpDocID();
        if($this->feedback['ok']) {
            $imp_doc = $this->feedback['resource'];
            if(es_resp_edificio() && $imp_doc['username'] != getUser()) {
                $this->feedback['ok'] = false;
                $this->feedback['code'] = 'BLD_FRBD';
                unset($this->feedback['resource']);
                return $this->feedback;
            }

            $this->feedback['resource']['path'] = plans_path . $imp_doc['plan_id'] . '/' . $imp_doc['edificio_id'] . '/Documentos/' . $imp_doc['documento_id'] . '/' .
                                        $imp_doc['cumplimentacion_id'];
            $this->feedback['code'] = 'IMPDOC_SEEK_OK';
        } else if($this->feedback['code'] == 'IMPDOCID_KO') {
            $this->feedback['code'] = 'IMPDOC_SEEK_KO';
        }

        return $this->feedback;
    }

    /*
     *  Consulta la información de cumplimentación de un Documento del Portal.
     *      1. Valida y busca la cumplimentación por ID.
     *      2. Verifica que la cumplimentación esté ACTIVA (Pendiente o Cumplimentada)
     *      3. Genera la ruta para acceder al fichero de la cumplimentación.
     *          - Formato de la ruta: Uploads/PLAN_ID/EDIFICIO_ID/Documentos/DOCUMENTO_ID/CUMPLIMENTACION_ID/NOMBRE_FICHERO.
     */
    function seekPortalImpDoc() {
        $validation = $this->validar_CUMPLIMENTACION_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByImpDocID();
        if($this->feedback['ok']) {
            $imp_doc = $this->feedback['resource'];
            if($imp_doc['estado'] == 'vencido') {
                $this->feedback['ok'] = false;
                $this->feedback['code'] = 'IMPDOCID_NOT_EXST';
                unset($this->feedback['resource']);
                return $this->feedback;
            }
            $this->feedback['code'] = 'PRTL_IMPDOC_SEEK_OK';
            $imp_doc = $this->feedback['resource'];
            $this->feedback['resource']['path'] = plans_path . $imp_doc['plan_id'] . '/' . $imp_doc['edificio_id'] . '/Documentos/' . $imp_doc['documento_id'] . '/' .
                $imp_doc['cumplimentacion_id'];
        } else if($this->feedback['code'] == 'IMPDOCID_KO') {
            $this->feedback['code'] = 'PRTL_IMPDOC_SEEK_KO';
        }

        return $this->feedback;
    }

    /*
     *  Elimina la cumplimentación de un Documento.
     *      1. Valida y busca la cumplimentación por ID.
     *      2. Comprueba que el usuario tiene permisos sobre el edificio (es el responsable del edificio o el rol del usuario es 'organizacion' o 'administrador')
     *      3. En caso de que rol del usuario sea 'edificio', verifica que la cumplimentación a eliminar no sea la única cumplimentación del Documento en el Edificio.
     *      4. Elimina la cumplimentación y el fichero asociado.
     *      5. Actualiza el estado del Plan en el Edificio.
     */
    function DELETE() {
        $this->feedback = $this->seek();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $imp_doc = $this->feedback['resource'];
        $path = $imp_doc['path'];

        if(es_resp_edificio()) {
            $this->feedback = $this->check_more_than_one_impdocs($imp_doc['edificio_id'], $imp_doc['documento_id']);
            if(!$this->feedback['ok']) {
                return $this->feedback;
            }
        }

        $this->feedback = $this->impDoc_entity->DELETE();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'IMPDOC_DEL_OK';
            if($imp_doc['nombre_doc'] != default_doc) {
                include_once './Service/Uploader_Service.php';
                $uploader = new Uploader();
                if($uploader->dir_exist($path)['ok']) {
                    $uploader->delete_all($path);
                }
            }
            $this->update_plan_state($imp_doc['edificio_id'], $imp_doc['plan_id']);
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'IMPDOC_DEL_KO';
        }

        return $this->feedback;
    }

    /*
     *  Modifica el estado de la cumplimentación de un Documento a 'vencido'.
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

        $imp_doc = $this->feedback['resource'];
        $this->impDoc_entity->estado = 'vencido';
        $this->impDoc_entity->fecha_vencimiento = date('Y-m-d');
        $this->feedback = $this->impDoc_entity->EDIT();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'IMPDOC_EXPIRE_OK';
            $this->update_plan_state($imp_doc['edificio_id'],$imp_doc['plan_id']);
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'IMPDOC_EXPIRE_KO';
        }

        return $this->feedback;
    }

    /*
     *  Cumplimenta la cumplimentación de un Documento, subiendo el fichero asociado.
     *      1. Valida y busca la cumplimentación por ID.
     *      2. Comprueba que el usuario tiene permisos sobre el edificio (es el responsable del edificio o el rol del usuario es 'organizacion' o 'administrador')
     *      3. Verifica que la cumplimentación esté ACTIVA (estado Pendiente o Cumplimentado)
     *      4. Valida el fichero (nombre y extensión)
     *      5. Carga el fichero en el servidor, creando el directorio de la cumplimentación en caso de que no exista.
     *      6. Modifica el estado, el nombre del fichero y la fecha de cumplimentación.
     *      7. Elimina el fichero anterior asociado a la cumplimentación en caso de que existiera y actualiza el estado del Plan en el Edificio.
     */
    function implement() {
        $this->feedback = $this->seek();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $imp_doc = $this->feedback['resource'];
        if($imp_doc['estado'] == 'vencido') {
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
            $this->feedback = $uploader->uploadFile($imp_doc['path'], $this->nombre_doc);
            if(!$this->feedback['ok']) {
                return $this->feedback;
            }
        }

        $this->impDoc_entity->setAttributes(array('fecha_cumplimentacion' => date('Y-m-d'),
                                            'nombre_doc' => $this->nombre_doc, 'estado' => 'cumplimentado'));
        $this->feedback = $this->impDoc_entity->EDIT();
        if($this->feedback['ok']) {
            if($imp_doc['nombre_doc'] != default_doc && $imp_doc['nombre_doc'] != $this->nombre_doc) {
                $uploader->delete($imp_doc['path'] . '/' . $imp_doc['nombre_doc']);
            }
            $this->feedback['code'] = 'IMPDOC_IMPL_OK';
            $this->update_plan_state($imp_doc['edificio_id'], $imp_doc['plan_id']);
        } else {
            $uploader->delete($imp_doc['path'] . '/' . $this->nombre_doc);
            if($uploader->dir_is_empty($imp_doc['path'])['ok']) {
                $uploader->delete($imp_doc['path']);
            }
            if($this->feedback['code'] == 'QRY_KO') {
                $this->feedback['code'] = 'IMPDOC_IMPL_KO';
            }
        }

        return $this->feedback;
    }

    // Búsqueda de Cumplimentación de Documento por ID
    function seekByImpDocID() {
        $feedback = $this->impDoc_entity->seek();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'IMPDOCID_NOT_EXST';
            } else {
                $feedback['code'] = 'IMPDOCID_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'IMPDOCID_KO';
        }

        return $feedback;
    }

    // Búsqueda de Definición de Documento por ID.
    function seekByDocID() {
        $this->defDoc_entity->documento_id = $this->documento_id;
        $feedback = $this->defDoc_entity->seek();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'DFDOCID_NOT_EXST';
            } else {
                $feedback['code'] = 'DFDOCID_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'DFDOCID_KO';
        }

        return $feedback;
    }

    // Búsqueda de Edificio por ID
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

    // Búsqueda de asignación Edificio - Plan por ID (ID Edificio + ID Plan)
    function seekPlanBuilding($plan_id) {
        include_once './Model/BuildPlan_Model.php';
        $buildPlan_entity = new BuildPlan_Model();
        $buildPlan_entity->setAttributes(array('plan_id' => $plan_id, 'edificio_id' => $this->edificio_id));
        $feedback = $buildPlan_entity->seek();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'BLDDOC_NOT_EXST';
            } else {
                $feedback['code'] = 'BLDDOC_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'BLDDOC_KO';
        }

        return $feedback;
    }


    // Búsqueda de asociaciones ACTIVAS (Pendiente o Cumplimentado) Edificio - Plan por ID de Plan.
    function searchActiveBuildPlans($plan_id) {
        include_once './Model/BuildPlan_Model.php';
        $buildPlan_entity = new BuildPlan_Model();
        $buildPlan_entity->plan_id = $plan_id;
        $feedback = $buildPlan_entity->searchActivesByPlanID();
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


    // Búsqueda de TODAS las cumplimentaciones de un Documento en un Edificio.
    function search_all_impdocs() {
        $feedback = $this->impDoc_entity->searchDocsBuildings();
        if($feedback['ok']) {
            $feedback['code'] = 'BLDDOCS_SEARCH_OK';
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'BLDOCS_SEARCH_KO';
        }

        return $feedback;
    }

    // Búsqueda de cumplimentaciones ACTIVAS (Pendiente o Cumplimentado) de un Documento en un Edificio.
    function doc_building_actives_not_exist() {
        $this->impDoc_entity->edificio_id = $this->edificio_id;
        $feedback = $this->impDoc_entity->searchActiveImpDocs();
        if($feedback['ok']) {
            if($feedback['code'] != 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'IMPDOC_ACTIVE_EXST';
            } else {
                $feedback['code'] = 'IMPDOC_ACTIVE_NOT_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'IMPDOC_ACTIVE_KO';
        }

        return $feedback;
    }

    // Consulta de número de cumplimentaciones de un Documento en un Edificio mayor que 1.
    function check_more_than_one_impdocs($edificio_id, $doc_id) {
        $this->impDoc_entity->setAttributes(array('edificio_id' => $edificio_id, 'documento_id' => $doc_id));
        $feedback = $this->impDoc_entity->searchDocsBuildings();
        if($feedback['ok']) {
            if(count($feedback['resource']) <= 1) {
                $feedback['ok'] = false;
                $feedback['code'] = 'IMPDOC_UNIQ';
            } else {
                $feedback['code'] = 'IMPDOC_NOT_UNIQ';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'IMPDOC_SEARCH_KO';
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
     *  Obtención del estado de un Documento en un Edificio.
     *      1. Recupera todas las cumplimentaciones del Documento en el Edificio.
     *      2. Calcula el estado del Documento en función de las cumplimentaciones recuperadas.
     */

    function get_document_state() {
        $feedback = $this->search_all_impdocs();
        if(!$feedback['ok']) {
            return $feedback;
        }

        include_once './Service/CheckState_Service.php';
        $checkState_service = new CheckState_Service();
        $estado = $checkState_service->get_state_element($feedback['resource']);
        return array('ok' => true, 'estado' => $estado);
    }

}
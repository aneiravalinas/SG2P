<?php

include_once './Model/DefDoc_Model.php';
include_once './Model/DefPlan_Model.php';
include_once './Validation/DefDoc_Validation.php';

class DefDoc_Service extends DefDoc_Validation {
    var $atributos;
    var $defDoc_entity;
    var $defPlan_entity;
    var $feedback = array();

    function __construct() {
        $this->atributos = array('documento_id', 'plan_id', 'nombre', 'descripcion', 'visible');
        $this->defDoc_entity = new DefDoc_Model();
        $this->defPlan_entity = new DefPlan_Model();
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
     *  - Recupera las definiciones de documentos de un plan.
     *      1. Valida y busca un plan por ID, y comprueba que existe.
     *      2. Valida los datos recibidos que se usarán como filtro en la búsqueda.
     *      3. Recupera las definiciones de documentos.
     */
    function SEARCH() {
        $this->feedback = $this->seekPlan();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $plan = $this->feedback['resource'];

        $validation = $this->validar_atributos_search();
        if(!$validation['ok']) {
            $validation['plan'] = array('plan_id' => $plan['plan_id']);
            return $validation;
        }

        $this->feedback = $this->defDoc_entity->SEARCH();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'DFDOC_SEARCH_OK';
            $this->feedback['plan'] = array('plan_id' => $plan['plan_id'], 'nombre' => $plan['nombre']);
        } else {
            $this->feedback['plan'] = array('plan_id' => $plan['plan_id']);
            if($this->feedback['code'] == 'QRY_KO') {
                $this->feedback['code'] = 'DFDOC_SEARCH_KO';
            }
        }

        return $this->feedback;
    }

    // Valida y busca la definición de un plan por ID.
    function seekPlan() {
        $validation = $this->validar_PLAN_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        return $this->seekByPlanID();
    }

    /*
     *  - Añade la definición de un Documento.
     *      1. Valida y busca la definición del plan al que se asocia el documento, comprobando que existe.
     *      2. Valida los atributos que conforman la definición del documento.
     *      3. Comprueba que el plan no tiene una definición de documento con el mismo nombre.
     *      4. Añade la definición del documento.
     */
    function ADD() {
        $this->feedback = $this->seekPlan();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $plan = $this->feedback['resource'];

        $validation = $this->validar_atributos();
        if(!$validation['ok']) {
            $validation['plan'] = array('plan_id' => $plan['plan_id']);
            return $validation;
        }

        $this->feedback = $this->name_doc_not_exist();
        if(!$this->feedback['ok']) {
            $this->feedback['plan'] = array('plan_id' => $plan['plan_id']);
            return $this->feedback;
        }

        $this->feedback = $this->defDoc_entity->ADD();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'DFDOC_ADD_OK';
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'DFDOC_ADD_KO';
        }
        $this->feedback['plan'] = array('plan_id' => $plan['plan_id']);
        return $this->feedback;
    }

    // Recupera la información de la definición de un documento por ID.
    function seek() {
        $validation = $this->validar_DOCUMENTO_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByDocID();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'DFDOC_SEEK_OK';
        } else if($this->feedback['code'] == 'DFDOCID_KO') {
            $this->feedback['code'] = 'DFDOC_SEEK_KO';
        }

        return $this->feedback;
    }

    /*
     *  - Elimina la definición de un documento.
     *      1. Valida y busca la definición de un documento por ID, comprobando que existe,
     *      2. Verifica que no existan cumplimentaciones de ese documento en algún edificio.
     *      3. Elimina la definición del documento.
     */
    function DELETE() {
        $this->feedback = $this->seek();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $doc = $this->feedback['resource'];

        $this->feedback = $this->imp_docs_not_exist();
        if(!$this->feedback['ok']) {
            $this->feedback['plan'] = array('plan_id' => $doc['plan_id']);
            return $this->feedback;
        }

        $this->feedback = $this->defDoc_entity->DELETE();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'DFDOC_DEL_OK';
        } else {
            $this->feedback['code'] = 'DFDOC_DEL_KO';
        }

        $this->feedback['plan'] = array('plan_id' => $doc['plan_id']);
        return $this->feedback;
    }

    /*
     *  - Modifica los datos de la definición de un documento.
     *      1. Valida y busca la definición de un documento por ID, comprobando que existe.
     *      2. Valida los nuevos datos recibidos.
     *      3. En caso de que se haya recibido un nuevo nombre, verifica que no exista una definición de documento en el mismo plan con ese nombre.
     *      4. Modifica los datos de la definición del documento.
     */
    function EDIT() {
        $this->feedback = $this->seek();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $doc = $this->feedback['resource'];
        $validation = $this->validar_atributos();
        if(!$validation['ok']) {
            $validation['plan'] = array('plan_id' => $doc['plan_id']);
            return $validation;
        }

        if($doc['nombre'] != $this->nombre) {
            $this->defDoc_entity->plan_id = $doc['plan_id'];
            $this->feedback = $this->name_doc_not_exist();
            if(!$this->feedback['ok']) {
                $this->feedback['plan'] = array('plan_id' => $doc['plan_id']);
                return $this->feedback;
            }
        }

        $this->feedback = $this->defDoc_entity->EDIT();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'DFDOC_EDT_OK';
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'DFDOC_EDT_KO';
        }

        $this->feedback['plan'] = array('plan_id' => $doc['plan_id']);
        return $this->feedback;
    }

    // Recupera los datos de la definición de un plan por ID.
    function seekByPlanID() {
        $feedback = $this->defPlan_entity->seek();
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

    // Recupera los datos de la definición de un documento por ID.
    function seekByDocID() {
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

    // Comprueba que no existe un documento con el nombre indicado.
    function name_doc_not_exist() {
        $feedback = $this->defDoc_entity->seekByDocName();
        if($feedback['ok']) {
            if($feedback['code'] != 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'DFDOC_NAME_EXST';
            } else {
                $feedback['code'] = 'DFDOC_NAME_NOT_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'DFDOC_NAME_KO';
        }

        return $feedback;
    }

    // Verifica que no existen cumplimentaciones de un documento.
    function imp_docs_not_exist() {
        include_once './Model/ImpDoc_Model.php';
        $impDoc_entity = new ImpDoc_Model();
        $feedback = $impDoc_entity->searchByDocID();
        if($feedback['ok']) {
            if($feedback['code'] != 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'DFDOC_IMPL_EXST';
            } else {
                $feedback['code'] = 'DFDOC_IMPL_NOT_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'DFDOC_IMPL_KO';
        }

        return $feedback;
    }

}
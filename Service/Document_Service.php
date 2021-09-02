<?php

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
        $this->atributos = array('edificio_documento_id','edificio_id','documento_id','estado','fecha_cumplimentacion','nombre_edificio', 'nombre_doc');
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

    function searchImplements() {
        $this->feedback = $this->seekDocument();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $doc = $this->feedback['resource'];
        $validation = $this->validar_atributos_searchImplements();
        if(!$validation['ok']) {
            $validation['document'] = array('plan_id' => $doc['plan_id']);
            return $validation;
        }

        $this->feedback = $this->impDoc_entity->SEARCH();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'IMPDOC_SEARCH_OK';
            $this->feedback['document'] = array('plan_id' => $doc['plan_id'],
                'documento_id' => $doc['documento_id'], 'nombre' => $doc['nombre']);
        } else {
            $this->feedback['document'] = array('plan_id' => $doc['plan_id']);
            if($this->feedback['code'] == 'QRY_KO') {
                $this->feedback['code'] = 'IMPDOC_SEARCH_KO';
            }
        }

        return $this->feedback;
    }

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
            $validation['return'] = array('plan_id' => $document['plan_id'], 'edificio_id' => $building['edificio_id']);
            return $validation;
        }

        $doc_state = $this->get_document_state();
        if(!$doc_state['ok']) {
            return $doc_state;
        }

        $document['estado'] = $doc_state['estado'];
        $this->feedback = $this->impDoc_entity->searchImpDocs();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'IMPDOC_SEARCH_OK';
            $this->feedback['document'] = $document;
            $this->feedback['building'] = $building;
        } else {
            $this->feedback['return'] = array('plan_id' => $document['plan_id'], 'edificio_id' => $building['edificio_id']);
            if($this->feedback['code'] == 'QRY_KO') {
                $this->feedback['code'] = 'IMPDOC_SEARCH_KO';
            }
        }

        return $this->feedback;
    }

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
            unset($this->feedback['resource'], $this->feedback['document'], $this->feedback['building']);
            return $this->feedback;
        }

        $doc_state = $this->get_document_state();
        if(!$doc_state['ok']) {
            return $doc_state;
        }

        $document['estado'] = $doc_state['estado'];
        $building = $this->feedback['building'];
        $this->feedback = $this->impDoc_entity->searchActiveImpDocs();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'PRTL_IMPDOC_SEARCH_OK';
            $this->feedback['document'] = $document;
            $this->feedback['building'] = $building;
        } else {
            $this->feedback['return'] = array('plan_id' => $document['plan_id'], 'edificio_id' => $building['edificio_id']);
            if($this->feedback['code'] == 'QRY_KO') {
                $this->feedback['code'] = 'PRTL_IMPDOC_SEARCH_KO';
            }
        }

        return $this->feedback;
    }

    function seekDocument() {
        $validation = $this->validar_DOCUMENTO_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        return $this->seekByDocID();
    }

    function searchDocumentForm() {
        $this->feedback = $this->searchDocAndBuilding();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        if(es_resp_edificio() && $this->feedback['building']['username'] != getUser()) {
            $this->feedback['ok'] = false;
            $this->feedback['code'] = 'BLD_FRBD';
            unset($this->feedback['resource'], $this->feedback['document'], $this->feedback['building']);
        }

        return $this->feedback;
    }

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

    function addImpDocForm() {
        $this->feedback = $this->seekDocument();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $doc = $this->feedback['resource'];
        $this->feedback = $this->searchActiveBuildPlans($doc['plan_id']);
        if($this->feedback['ok']) {
            $this->feedback['document'] = $doc;
        } else {
            $this->feedback['document'] = array('plan_id' => $doc['plan_id']);
        }

        return $this->feedback;
    }

    function addDocumentForm() {
        $this->feedback = $this->searchDocAndBuilding();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $document = $this->feedback['document'];
        $building = $this->feedback['building'];
        $bld_plan = $this->feedback['resource'];

        if(es_resp_edificio() && $building['username'] != getUser()) {
            $this->feedback['ok'] = false;
            $this->feedback['code'] = 'BLD_FRBD';
            unset($this->feedback['resource'], $this->feedback['document'], $this->feedback['building']);
            return $this->feedback;
        }

        if($bld_plan['estado'] == 'vencido') {
            $this->feedback['ok'] = false;
            $this->feedback['code'] = 'BLDDOC_ASSOC_NOT_VALID';
            $this->feedback['return'] = array('documento_id' => $document['documento_id'],
                                                'edificio_id' => $building['edificio_id']);
        }

        return $this->feedback;
    }

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
        $this->feedback = $this->ADD($document);
        $this->feedback['document'] = array('documento_id' => $document['documento_id']);
        return $this->feedback;
    }

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

        $feedback = $this->doc_building_actives_not_exist();
        if(!$feedback['ok']) {
            $feedback['building'] = array('edificio_id' => $building['edificio_id']);
            return $feedback;
        }

        include_once './Service/Uploader_Service.php';
        $uploader = new Uploader();
        $path = plans_path . $document['plan_id'] . '/' . $this->edificio_id . '/Documentos/';
        $def_dir_created = false;
        if(!$uploader->dir_exist($path . $this->documento_id)['ok']) {
            $feedback = $uploader->create_dir($path, $this->documento_id);
            if(!$feedback['ok']) {
                $feedback['building'] = array('edificio_id' => $building['edificio_id']);
                $feedback['code'] = 'BLDPLAN_DIRDOC_KO';
                return $feedback;
            }
            $def_dir_created = true;
        }

        $this->impDoc_entity->setAttributes(array('edificio_id' => $this->edificio_id, 'nombre_doc' => default_doc,
                                                    'fecha_cumplimentacion' => default_data, 'estado' => 'pendiente'));
        $feedback = $this->impDoc_entity->ADD();
        if($feedback['ok']) {
            $imp_doc_id = $this->impDoc_entity->edificio_documento_id;
            $feedback = $this->ADD($document);
            if($feedback['ok']) {
                $feedback['building'] = array('edificio_id' => $building['edificio_id']);
                $this->update_plan_state($building['edificio_id'], $document['plan_id']);
                return $feedback;
            }
            $this->impDoc_entity->edificio_documento_id = $imp_doc_id;
            $this->impDoc_entity->DELETE();
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'IMPDOC_ADD_KO';
        }

        if($def_dir_created) {
            $uploader->delete($path . $this->documento_id);
        }

        $feedback['building'] = array('edificio_id' => $building['edificio_id']);
        return $feedback;
    }

    function seek() {
        $validation = $this->validar_EDIFICIO_DOCUMENTO_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByImpDocID();
        if($this->feedback['ok']) {
            $imp_doc = $this->feedback['resource'];
            if(es_resp_edificio()) {
                $this->edificio_id = $imp_doc['edificio_id'];
                $this->feedback = $this->seekByBuildingID();
                if(!$this->feedback['ok']) {
                    return $this->feedback;
                }

                if($this->feedback['resource']['username'] != getUser()) {
                    $this->feedback['ok'] = false;
                    $this->feedback['code'] = 'BLD_FRBD';
                    return $this->feedback;
                } else {
                    $this->feedback['resource'] = $imp_doc;
                }
            }
            $this->feedback['resource']['path'] = plans_path . $imp_doc['plan_id'] . '/' . $imp_doc['edificio_id'] . '/Documentos/' . $imp_doc['documento_id'] . '/' .
                                        $imp_doc['edificio_documento_id'];
            $this->feedback['code'] = 'IMPDOC_SEEK_OK';
        } else if($this->feedback['code'] == 'IMPDOCID_KO') {
            $this->feedback['code'] = 'IMPDOC_SEEK_KO';
        }

        return $this->feedback;
    }

    function seekPortalImpDoc() {
        $validation = $this->validar_EDIFICIO_DOCUMENTO_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByImpDocID();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'PORTAL_IMPDOC_SEEK_OK';
            $imp_doc = $this->feedback['resource'];
            $this->feedback['resource']['path'] = plans_path . $imp_doc['plan_id'] . '/' . $imp_doc['edificio_id'] . '/Documentos/' . $imp_doc['documento_id'] . '/' .
                $imp_doc['edificio_documento_id'];
        } else if($this->feedback['code'] == 'IMPDOCID_KO') {
            $this->feedback['code'] = 'PORTAL_IMPDOC_SEEK_KO';
        }

        return $this->feedback;
    }

    function DELETE() {
        $this->feedback = $this->seek();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $imp_doc = $this->feedback['resource'];
        $path = $imp_doc['path'];
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

        $this->feedback['return'] = array('edificio_id' => $imp_doc['edificio_id'], 'documento_id' => $imp_doc['documento_id']);
        return $this->feedback;
    }

    function expire() {
        $this->feedback = $this->seek();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $imp_doc = $this->feedback['resource'];
        $this->impDoc_entity->estado = 'vencido';
        $this->feedback = $this->impDoc_entity->EDIT();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'IMPDOC_EXPIRE_OK';
            $this->update_plan_state($imp_doc['edificio_id'],$imp_doc['plan_id']);
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'IMPDOC_EXPIRE_KO';
        }

        $this->feedback['return'] = array('edificio_id' => $imp_doc['edificio_id'], 'documento_id' => $imp_doc['documento_id']);
        return $this->feedback;
    }

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
            $validation['return'] = array('edificio_id' => $imp_doc['edificio_id'], 'documento_id' => $imp_doc['documento_id']);
            return $validation;
        }

        include_once './Service/Uploader_Service.php';
        $uploader = new Uploader();
        if(!$_SESSION['test']) {
            $this->feedback = $uploader->uploadFile($imp_doc['path'], $this->nombre_doc);
            if(!$this->feedback['ok']) {
                $this->feedback['return'] = array('edificio_id' => $imp_doc['edificio_id'], 'documento_id' => $imp_doc['documento_id']);
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
            if($uploader->dir_is_empty($imp_doc['path']['ok'])) {
                $uploader->delete($imp_doc['path']);
            }
            if($this->feedback['code'] == 'QRY_KO') {
                $this->feedback['code'] = 'IMPDOC_IMPL_KO';
            }
        }

        $this->feedback['return'] = array('edificio_id' => $imp_doc['edificio_id'], 'documento_id' => $imp_doc['documento_id']);
        return $this->feedback;
    }

    function seekByImpDocID() {
        $feedback = $this->impDoc_entity->seek();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'IMPDOCDID_NOT_EXST';
            } else {
                $feedback['code'] = 'IMPDOCID_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'IMPDOCID_KO';
        }

        return $feedback;
    }

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
                $feedback['code'] = 'BLDDOC_NOT_EXST';
            } else {
                $feedback['code'] = 'BLDDOC_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'BLDDOC_KO';
        }

        return $feedback;
    }

    function clear_expired($documents) {
        foreach($documents as $document) {
            if($document['estado'] == 'vencido') {
                unset($documents[$document]);
            }
        }

        return $documents;
    }

    function searchActiveBuildPlans($plan_id) {
        include_once './Model/BuildPlan_Model.php';
        $buildPlan_entity = new BuildPlan_Model();
        $buildPlan_entity->plan_id = $plan_id;
        $feedback = $buildPlan_entity->searchActivesByPlanID();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'BLDDOC_ACTIVE_EMPT';
            } else {
                $feedback['code'] = 'BLDDOC_ACTIVE_OK';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'BLDDOC_ACTIVE_KO';
        }

        return $feedback;
    }


    function search_all_impdocs() {
        $feedback = $this->impDoc_entity->searchDocsBuildings();
        if($feedback['ok']) {
            $feedback['code'] = 'BLDDOCS_SEARCH_OK';
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'BLDOCS_SEARCH_KO';
        }

        return $feedback;
    }

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

    function update_plan_state($edificio_id, $plan_id) {
        include_once './Service/CheckState_Service.php';
        $checkState_service = new CheckState_Service($edificio_id, $plan_id);
        $checkState_service->update_plan_state();
    }

    function get_document_state() {
        $feedback = $this->search_all_impdocs();
        if(!$feedback['ok']) {
            return $feedback;
        }

        include_once './Service/CheckState_Service.php';
        $checkState_service = new CheckState_Service($this->edificio_id, $this->documento_id);
        $estado = $checkState_service->check_state($feedback['resource']);
        return array('ok' => true, 'estado' => $estado);
    }

}
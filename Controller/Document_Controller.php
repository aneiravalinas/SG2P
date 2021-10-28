<?php

class Document {

    function __construct() {
        include './View/Page/Message_View.php';
        include './Service/Document_Service.php';
    }


    function show() {
        if(!es_registrado()) {
            $doc_service = new Document_Service();
            $feedback = $doc_service->searchDocument();
            if($feedback['ok']) {
                include_once './View/Documents/Show_Document_View.php';
                new Show_Document($feedback['resource'], $feedback['document'], $feedback['building']);
            } else if(isset($feedback['return'])) {
                new Message($feedback['code'], 'Document', 'show', $feedback['return']);
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function addForm() {
        if(!es_registrado()) {
            $doc_service = new Document_Service();
            $feedback = $doc_service->documentForm();
            if($feedback['ok']) {
                include_once './View/Documents/Add_Document_View.php';
                new Add_Document($feedback['document'], $feedback['building']);
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function add() {
        if(!es_registrado()) {
            $doc_service = new Document_Service();
            $feedback = $doc_service->addImpDoc();
            if(isset($feedback['document']) && isset($feedback['building'])) {
                new Message($feedback['code'], 'Document', 'show', array('documento_id' => $feedback['document']['documento_id'],
                                                                                                        'edificio_id' => $feedback['building']['edificio_id']));
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function deleteForm() {
        if(!es_registrado()) {
            $doc_service = new Document_Service();
            $feedback = $doc_service->seek();
            if($feedback['ok']){
                include_once './View/Documents/Delete_Document_View.php';
                new Delete_Document($feedback['resource']);
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function delete() {
        if(!es_registrado()) {
            $doc_service = new Document_Service();
            $feedback = $doc_service->DELETE();
            if(isset($feedback['return'])) {
                new Message($feedback['code'], 'Document', 'show', $feedback['return']);
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function expireForm() {
        if(!es_registrado()) {
            $doc_service = new Document_Service();
            $feedback = $doc_service->seek();
            if($feedback['ok']) {
                include_once './View/Documents/Expire_Document_View.php';
                new Expire_Document($feedback['resource']);
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function expire() {
        if(!es_registrado()) {
            $doc_service = new Document_Service();
            $feedback = $doc_service->expire();
            if(isset($feedback['return'])) {
                new Message($feedback['code'], 'Document', 'show', $feedback['return']);
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function implementForm() {
        if(!es_registrado()) {
            $doc_service = new Document_Service();
            $feedback = $doc_service->seek();
            if($feedback['ok']) {
                include_once './View/Documents/Implement_Document_View.php';
                new Implement_Document($feedback['resource']);
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function implement() {
        if(!es_registrado()) {
            $doc_service = new Document_Service();
            $feedback = $doc_service->implement();
            if(isset($feedback['return'])) {
                new Message($feedback['code'], 'Document', 'show', $feedback['return']);
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function showCurrent() {
        if(!es_registrado()) {
            $doc_service = new Document_Service();
            $feedback = $doc_service->seek();
            if($feedback['ok']) {
                include_once './View/Documents/ShowCurrent_Document_View.php';
                new ShowCurrent_Document($feedback['resource']);
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function searchForm() {
        if(!es_registrado()) {
            $doc_service = new Document_Service();
            $feedback = $doc_service->documentForm();
            if($feedback['ok']) {
                include_once './View/Documents/Search_Document_View.php';
                new Search_Document($feedback['document'], $feedback['building']);
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

}
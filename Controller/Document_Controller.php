<?php

include_once 'Abstract_Controller.php';

class Document extends Abstract_Controller {

    function __construct() {
        include './View/Page/Message_View.php';
        include './Service/Document_Service.php';
    }


    function show() {
        if(!es_registrado()) {
            $doc_service = new Document_Service();
            $feedback = $doc_service->searchDocument();
            if($feedback['ok']) {
                $this->update_stack_post();
                include_once './View/Documents/Show_Document_View.php';
                new Show_Document($feedback['resource'], $feedback['document'], $feedback['building']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
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
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function add() {
        if(!es_registrado()) {
            $doc_service = new Document_Service();
            $feedback = $doc_service->addImpDoc();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
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
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function delete() {
        if(!es_registrado()) {
            $doc_service = new Document_Service();
            $feedback = $doc_service->DELETE();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
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
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function expire() {
        if(!es_registrado()) {
            $doc_service = new Document_Service();
            $feedback = $doc_service->expire();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
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
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function implement() {
        if(!es_registrado()) {
            $doc_service = new Document_Service();
            $feedback = $doc_service->implement();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
        }
    }

    function showCurrent() {
        if(!es_registrado()) {
            $doc_service = new Document_Service();
            $feedback = $doc_service->seek();
            if($feedback['ok']) {
                $this->update_stack_post();
                include_once './View/Documents/ShowCurrent_Document_View.php';
                new ShowCurrent_Document($feedback['resource']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
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
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

}
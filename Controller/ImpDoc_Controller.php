<?php

include_once 'Abstract_Controller.php';

class ImpDoc extends Abstract_Controller {

    function __construct() {
        include './View/Page/Message_View.php';
        include './Service/Document_Service.php';
    }

    function show() {
        if($this->checkPermission()) {
            $doc_service = new Document_Service();
            $feedback = $doc_service->searchCompletions();
            if($feedback['ok']) {
                $this->update_stack_post();
                include_once './View/ImpDocs/Show_ImpDocs_View.php';
                new Show_ImpDocs($feedback['resource'], $feedback['document']);
            } else if(isset($feedback['document'])) {
                new Message($feedback['code'], 'ImpDoc', 'show', $feedback['document']);
            } else {
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function addForm() {
        if($this->checkPermission()) {
            $doc_service = new Document_Service();
            $feedback = $doc_service->addImpDocForm();
            if($feedback['ok']) {
                include_once './View/ImpDocs/Add_ImpDoc_View.php';
                new Add_ImpDoc($feedback['resource'], $feedback['document']);
            } else if(isset($feedback['document'])){
                new Message($feedback['code'], 'ImpDoc', 'show', $feedback['document']);
            } else {
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function add() {
        if($this->checkPermission()) {
            $doc_service = new Document_Service();
            $feedback = $doc_service->addImpDoc();
            if(isset($feedback['document'])) {
                new Message($feedback['code'], 'ImpDoc', 'show', $feedback['document']);
            } else {
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function deleteForm() {
        if($this->checkPermission()) {
            $doc_service = new Document_Service();
            $feedback = $doc_service->seek();
            if($feedback['ok']) {
                include_once './View/ImpDocs/Delete_ImpDoc_View.php';
                new Delete_ImpDoc($feedback['resource']);
            } else {
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function delete() {
        if($this->checkPermission()) {
            $doc_service = new Document_Service();
            $feedback = $doc_service->DELETE();
            if(isset($feedback['return'])) {
                new Message($feedback['code'], 'ImpDoc', 'show', array('documento_id' => $feedback['return']['documento_id']));
            } else {
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function expireForm() {
        if($this->checkPermission()) {
            $doc_service = new Document_Service();
            $feedback = $doc_service->seek();
            if($feedback['ok']) {
                include_once './View/ImpDocs/Expire_ImpDoc_View.php';
                new Expire_ImpDoc($feedback['resource']);
            } else {
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function expire() {
        if($this->checkPermission()) {
            $doc_service = new Document_Service();
            $feedback = $doc_service->expire();
            if(isset($feedback['return'])) {
                new Message($feedback['code'], 'ImpDoc', 'show', array('documento_id' => $feedback['return']['documento_id']));
            } else {
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function implementForm() {
        if($this->checkPermission()) {
            $doc_service = new Document_Service();
            $feedback = $doc_service->seek();
            if($feedback['ok']) {
                include_once './View/ImpDocs/Implement_ImpDoc_View.php';
                new Implement_ImpDoc($feedback['resource']);
            } else {
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function implement() {
        if($this->checkPermission()) {
            $doc_service = new Document_Service();
            $feedback = $doc_service->implement();
            if(isset($feedback['return'])) {
                new Message($feedback['code'], 'ImpDoc', 'show', array('documento_id' => $feedback['return']['documento_id']));
            } else {
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function showCurrent() {
        if($this->checkPermission()) {
            $doc_service = new Document_Service();
            $feedback = $doc_service->seek();
            if($feedback['ok']) {
                $this->update_stack_post();
                include_once './View/ImpDocs/ShowCurrent_ImpDoc_View.php';
                new ShowCurrent_ImpDoc($feedback['resource']);
            } else {
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function searchForm() {
        if($this->checkPermission()) {
            $doc_service = new Document_Service();
            $feedback = $doc_service->seekDocument();
            if($feedback['ok']) {
                include_once './View/ImpDocs/Search_ImpDoc_View.php';
                new Search_ImpDoc($feedback['resource']);
            } else {
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }


}
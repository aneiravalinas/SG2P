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
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function addForm() {
        if($this->checkPermission()) {
            $doc_service = new Document_Service();
            $feedback = $doc_service->addImpDocForm();
            if($feedback['ok']) {
                include_once './View/ImpDocs/Add_ImpDoc_View.php';
                new Add_ImpDoc($feedback['resource'], $feedback['document']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function add() {
        if($this->checkPermission()) {
            $doc_service = new Document_Service();
            $feedback = $doc_service->addImpDoc();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
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
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function delete() {
        if($this->checkPermission()) {
            $doc_service = new Document_Service();
            $feedback = $doc_service->DELETE();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
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
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function expire() {
        if($this->checkPermission()) {
            $doc_service = new Document_Service();
            $feedback = $doc_service->expire();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
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
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function implement() {
        if($this->checkPermission()) {
            $doc_service = new Document_Service();
            $feedback = $doc_service->implement();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
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
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
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
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }


}
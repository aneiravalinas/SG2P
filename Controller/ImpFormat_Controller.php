<?php

include_once 'Abstract_Controller.php';

class ImpFormat extends Abstract_Controller {

    function __construct() {
        include './Service/Formation_Service.php';
        include './View/Page/Message_View.php';
    }

    function show() {
        if($this->checkPermission()) {
            $format_service = new Formation_Service();
            $feedback = $format_service->searchCompletions();
            if($feedback['ok']) {
                $this->update_stack_post();
                include_once './View/ImpFormats/Show_ImpFormats_View.php';
                new Show_ImpFormats($feedback['resource'], $feedback['formation']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function addForm() {
        if($this->checkPermission()) {
            $format_service = new Formation_Service();
            $feedback = $format_service->addImpFormatForm();
            if($feedback['ok']) {
                include_once './View/ImpFormats/Add_ImpFormat_View.php';
                new Add_ImpFormat($feedback['resource'], $feedback['formation']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function add() {
        if($this->checkPermission()) {
            $format_service = new Formation_Service();
            $feedback = $format_service->addImpFormat();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
        }
    }

    function deleteForm() {
        if($this->checkPermission()) {
            $format_service = new Formation_Service();
            $feedback = $format_service->seek();
            if($feedback['ok']) {
                include_once './View/ImpFormats/Delete_ImpFormat_View.php';
                new Delete_ImpFormat($feedback['resource']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function delete() {
        if($this->checkPermission()) {
            $format_service = new Formation_Service();
            $feedback = $format_service->DELETE();
            new Message($feedback['code']);
        } else{
            new Message('FRB_ACCS');
        }
    }

    function expireForm() {
        if($this->checkPermission()) {
            $format_service = new Formation_Service();
            $feedback = $format_service->seek();
            if($feedback['ok']) {
                include_once './View/ImpFormats/Expire_ImpFormat_View.php';
                new Expire_ImpFormat($feedback['resource']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function expire() {
        if($this->checkPermission()) {
            $format_service = new Formation_Service();
            $feedback = $format_service->expire();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
        }
    }

    function implementForm() {
        if($this->checkPermission()) {
            $format_service = new Formation_Service();
            $feedback = $format_service->seek();
            if($feedback['ok']) {
                include_once './View/ImpFormats/Implement_ImpFormat_View.php';
                new Implement_ImpFormat($feedback['resource']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function implement() {
        if($this->checkPermission()) {
            $format_service = new Formation_Service();
            $feedback = $format_service->implement();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
        }
    }

    function showCurrent() {
        if($this->checkPermission()) {
            $format_service = new Formation_Service();
            $feedback = $format_service->seek();
            if($feedback['ok']) {
                $this->update_stack_post();
                include_once './View/ImpFormats/ShowCurrent_ImpFormat_View.php';
                new ShowCurrent_ImpFormat($feedback['resource']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function searchForm() {
        if($this->checkPermission()) {
            $format_service = new Formation_Service();
            $feedback = $format_service->seekFormation();
            if($feedback['ok']) {
                include_once './View/ImpFormats/Search_ImpFormat_View.php';
                new Search_ImpFormat($feedback['resource']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }
}
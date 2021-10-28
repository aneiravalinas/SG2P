<?php

class ImpFormat {

    function __construct() {
        include './Service/Formation_Service.php';
        include './View/Page/Message_View.php';
    }

    function checkPermission() {
        return (es_resp_organizacion() || es_admin());
    }

    function show() {
        if($this->checkPermission()) {
            $format_service = new Formation_Service();
            $feedback = $format_service->searchCompletions();
            if($feedback['ok']) {
                include_once './View/ImpFormats/Show_ImpFormats_View.php';
                new Show_ImpFormats($feedback['resource'], $feedback['formation']);
            } else if(isset($feedback['formation'])) {
                new Message($feedback['code'], 'ImpFormat', 'show', $feedback['formation']);
            } else {
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function addForm() {
        if($this->checkPermission()) {
            $format_service = new Formation_Service();
            $feedback = $format_service->addImpFormatForm();
            if($feedback['ok']) {
                include_once './View/ImpFormats/Add_ImpFormat_View.php';
                new Add_ImpFormat($feedback['resource'], $feedback['formation']);
            } else if(isset($feedback['formation'])) {
                new Message($feedback['code'], 'ImpFormat', 'show', $feedback['formation']);
            } else {
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function add() {
        if($this->checkPermission()) {
            $format_service = new Formation_Service();
            $feedback = $format_service->addImpFormat();
            if(isset($feedback['formation'])) {
                new Message($feedback['code'], 'ImpFormat', 'show', $feedback['formation']);
            } else {
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
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
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function delete() {
        if($this->checkPermission()) {
            $format_service = new Formation_Service();
            $feedback = $format_service->DELETE();
            if(isset($feedback['return'])) {
                new Message($feedback['code'], 'ImpFormat', 'show', array('formacion_id' => $feedback['return']['formacion_id']));
            } else {
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else{
            new Message('FRB_ACCS', 'Panel', 'deshboard');
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
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function expire() {
        if($this->checkPermission()) {
            $format_service = new Formation_Service();
            $feedback = $format_service->expire();
            if(isset($feedback['return'])) {
                new Message($feedback['code'], 'ImpFormat', 'show', array('formacion_id' => $feedback['return']['formacion_id']));
            } else {
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
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
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function implement() {
        if($this->checkPermission()) {
            $format_service = new Formation_Service();
            $feedback = $format_service->implement();
            if(isset($feedback['return'])) {
                new Message($feedback['code'], 'ImpFormat', 'show', array('formacion_id' => $feedback['return']['formacion_id']));
            } else {
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function showCurrent() {
        if($this->checkPermission()) {
            $format_service = new Formation_Service();
            $feedback = $format_service->seek();
            if($feedback['ok']) {
                include_once './View/ImpFormats/ShowCurrent_ImpFormat_View.php';
                new ShowCurrent_ImpFormat($feedback['resource']);
            } else {
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
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
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }
}
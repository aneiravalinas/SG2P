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
            $feedback = $format_service->searchImpFormats();
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
}
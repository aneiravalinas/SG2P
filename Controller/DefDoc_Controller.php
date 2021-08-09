<?php

class DefDoc {

    function __construct() {
        include './View/Page/Message_View.php';
        include './Service/DefDoc_Service.php';
    }

    function checkPermission() {
        return (es_resp_organizacion() || es_admin());
    }

    function show() {
        if($this->checkPermission()) {
            $defDoc_service = new DefDoc_Service();
            $feedback = $defDoc_service->SEARCH();
            if($feedback['ok']) {
                include_once './View/DefDocs/Show_DefDocs_View.php';
                new Show_DefDocs($feedback['resource'], $feedback['plan']);
            } else{
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function addForm() {
        if($this->checkPermission()) {
            $defDoc_service = new DefDoc_Service();
            $feedback = $defDoc_service->emptyForm();
            if($feedback['ok']) {
                include_once './View/DefDocs/Add_DefDoc_View.php';
                new Add_DefDoc($feedback['resource']);
            } else {
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function add() {
        if($this->checkPermission()) {
            $defDoc_service = new DefDoc_Service();
            $feedback = $defDoc_service->ADD();
            if(isset($feedback['plan'])){
                new Message($feedback['code'],'DefDoc','show', $feedback['plan']);
            } else {
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }
}
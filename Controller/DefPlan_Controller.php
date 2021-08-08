<?php

class DefPlan {

    function __construct() {
        include './View/Page/Message_View.php';
        include './Service/DefPlan_Service.php';
        $this->checkPermission();
    }

    function checkPermission() {
        if(es_registrado() || es_resp_edificio()) {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function show() {
        $defPlan_service = new DefPlan_Service();
        $feedback = $defPlan_service->SEARCH();
        if($feedback['ok']) {
            include_once './View/DefPlans/Show_DefPlans_View.php';
            new Show_DefPlans($feedback['resource']);
        } else {
            new Message($feedback['code'], 'Panel', 'deshboard');
        }
    }

    function addForm() {
        include_once './View/DefPlans/Add_DefPlan_View.php';
        new Add_DefPlan();
    }

    function add() {
        $defPlan_service = new DefPlan_Service();
        $feedback = $defPlan_service->ADD();
        new Message($feedback['code'],'DefPlan', 'show');
    }

    function deleteForm() {
        $defPlan_service = new DefPlan_Service();
        $feedback = $defPlan_service->seek();
        if($feedback['ok']) {
            // TODO: Include and send DELETE_DEFPLAN_VIEW
        } else {
            new Message($feedback['code'],'DefPlan','show');
        }
    }
}
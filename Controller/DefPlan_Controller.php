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
}
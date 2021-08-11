<?php

class DefRoute {

    function __construct() {
        include './View/Page/Message_View.php';
        include './Service/DefRoute_Service.php';
    }

    function checkPermission() {
        return (es_resp_organizacion() || es_admin());
    }

    function show() {
        if($this->checkPermission()) {
            $defRoute_service = new DefRoute_Service();
            $feedback = $defRoute_service->SEARCH();
            if($feedback['ok']) {
                include_once './View/DefRoutes/Show_DefRoutes_View.php';
                new Show_DefRoutes($feedback['resource'], $feedback['plan']);
            } else if(isset($feedback['plan'])) {
                new Message($feedback['code'],'DefRoute','show',$feedback['plan']);
            } else {
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function addForm() {
        if($this->checkPermission()) {
            $defRoute_service = new DefRoute_Service();
            $feedback = $defRoute_service->seekPlan();
            if($feedback['ok']) {
                include_once './View/DefRoutes/Add_DefRoute_View.php';
                new Add_DefRoute($feedback['resource']);
            } else {
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function add() {
        if($this->checkPermission()) {
            $defRoute_service = new DefRoute_Service();
            $feedback = $defRoute_service->ADD();
            if(isset($feedback['plan'])) {
                new Message($feedback['code'],'DefRoute','show',$feedback['plan']);
            } else {
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }
}
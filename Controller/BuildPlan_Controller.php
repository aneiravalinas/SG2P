<?php

class BuildPlan {

    function __construct() {
        include './View/Page/Message_View.php';
        include './Service/BuildPlan_Service.php';
    }

    function checkPermission() {
        return (es_resp_organizacion() || es_admin());
    }

    function show() {
        if($this->checkPermission()) {
            $buildPlan_service = new BuildPlan_Service();
            $feedback = $buildPlan_service->SEARCH();
            if($feedback['ok']) {
                include_once './View/BuildPlans/Show_BuildPlan_View.php';
                new Show_BuildPlan($feedback['resource'],$feedback['plan']);
            } else if(isset($feedback['plan'])) {
                new Message($feedback['code'],'BuildPlan','show',$feedback['plan']);
            } else {
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function addForm() {
        if($this->checkPermission()) {
            $buildPlan_service = new BuildPlan_Service();
            $feedback = $buildPlan_service->addForm();
            if($feedback['ok']) {
                include_once './View/BuildPlans/Add_BuildPlan_View.php';
                new Add_BuildPlan($feedback['resource'],$feedback['plan']);
            } else if(isset($feedback['plan'])) {
                new Message($feedback['code'],'BuildPlan','show',$feedback['plan']);
            } else {
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function add() {
        if($this->checkPermission()) {
            $buildPlan_service = new BuildPlan_Service();
            $feedback = $buildPlan_service->multipleADD();
            if(isset($feedback['plan'])) {
                new Message($feedback['code'], 'BuildPlan', 'show', $feedback['plan']);
            } else {
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function deleteForm() {
        if($this->checkPermission()) {
            $buildPlan_service = new BuildPlan_Service();
            $feedback = $buildPlan_service->seek();
            if($feedback['ok']) {
                include_once './View/BuildPlans/Delete_BuildPlan_View.php';
                new Delete_BuildPlan($feedback['plan'], $feedback['edificio']);
            } else if(isset($feedback['plan'])) {
                new Message($feedback['code'], 'BuildPlan', 'show', $feedback['plan']);
            } else {
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function delete() {
        if($this->checkPermission()) {
            $buildPlan_service = new BuildPlan_Service();
            $feedback =$buildPlan_service->DELETE();
            if(isset($feedback['plan'])) {
                new Message($feedback['code'], 'BuildPlan', 'show', $feedback['plan']);
            } else {
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

}
<?php

class DefSim {

    function __construct() {
        include './View/Page/Message_View.php';
        include './Service/DefSim_Service.php';
    }

    function checkPermission() {
        return (es_resp_organizacion() || es_admin());
    }

    function show() {
        if($this->checkPermission()) {
            $defSim_service = new DefSim_Service();
            $feedback = $defSim_service->SEARCH();
            if($feedback['ok']) {
                include_once './View/DefSims/Show_DefSims_View.php';
                new Show_DefSims($feedback['resource'], $feedback['plan']);
            } else if(isset($feedback['plan'])) {
                new Message($feedback['code'],'DefSim','show',$feedback['code']);
            } else {
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function addForm() {
        if($this->checkPermission()) {
            $defSim_service = new DefSim_Service();
            $feedback = $defSim_service->seekPlan();
            if($feedback['ok']) {
                include_once './View/DefSims/Add_DefSim_View.php';
                new Add_DefSim($feedback['resource']);
            } else {
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function add() {
        if($this->checkPermission()) {
            $defSim_service = new DefSim_Service();
            $feedback = $defSim_service->ADD();
            if(isset($feedback['plan'])) {
                new Message($feedback['code'],'DefSim','show',$feedback['plan']);
            } else {
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function deleteForm() {
        if($this->checkPermission()) {
            $defSim_service = new DefSim_Service();
            $feedback = $defSim_service->seek();
            if($feedback['ok']) {
                include_once './View/DefSims/Delete_DefSim_View.php';
                new Delete_DefSim($feedback['resource']);
            } else {
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function delete() {
        if($this->checkPermission()) {
            $defSim_service = new DefSim_Service();
            $feedback = $defSim_service->DELETE();
            if(isset($feedback['plan'])) {
                new Message($feedback['code'],'DefSim','show',$feedback['plan']);
            } else {
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function showCurrent() {
        if($this->checkPermission()) {
            $defSim_service = new DefSim_Service();
            $feedback = $defSim_service->seek();
            if($feedback['ok']) {
                include_once './View/DefSims/ShowCurrent_DefSim_View.php';
                new ShowCurrent_DefSim($feedback['resource']);
            } else {
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function searchForm() {
        if($this->checkPermission()) {
            $defSim_service = new DefSim_Service();
            $feedback = $defSim_service->seekPlan();
            if($feedback['ok']) {
                include_once './View/DefSims/Search_DefSim_View.php';
                new Search_DefSim($feedback['resource']);
            } else {
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function editForm() {
        if($this->checkPermission()) {
            $defSim_service = new DefSim_Service();
            $feedback = $defSim_service->seek();
            if($feedback['ok']) {
                include_once './View/DefSims/Edit_DefSim_View.php';
                new Edit_DefSim($feedback['resource']);
            } else {
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function edit() {
        if($this->checkPermission()) {
            $defSim_service = new DefSim_Service();
            $feedback = $defSim_service->EDIT();
            if(isset($feedback['plan'])) {
                new Message($feedback['code'],'DefSim','show',$feedback['plan']);
            } else {
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

}
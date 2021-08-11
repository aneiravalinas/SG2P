<?php

class DefProc {

    function __construct() {
        include './View/Page/Message_View.php';
        include './Service/DefProc_Service.php';
    }

    function checkPermission() {
        return (es_resp_organizacion() || es_admin());
    }

    function show() {
        if($this->checkPermission()) {
            $defProc_service = new DefProc_Service();
            $feedback = $defProc_service->SEARCH();
            if($feedback['ok']) {
                include_once './View/DefProcs/Show_DefProcs_View.php';
                new Show_DefProcs($feedback['resource'], $feedback['plan']);
            } else if(isset($feedback['plan']))  {
                new Message($feedback['code'],'DefProc','show', $feedback['plan']);
            } else {
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function addForm() {
        if($this->checkPermission()) {
            $defProc_service = new DefProc_Service();
            $feedback = $defProc_service->emptyForm();
            if($feedback['ok']) {
                include_once './View/DefProcs/Add_DefProc_View.php';
                new Add_DefProc($feedback['resource']);
            } else {
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function add() {
        if($this->checkPermission()) {
            $defProc_service = new DefProc_Service();
            $feedback = $defProc_service->ADD();
            if(isset($feedback['plan'])) {
                new Message($feedback['code'],'DefProc','show',$feedback['plan']);
            } else {
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function deleteForm() {
        if($this->checkPermission()) {
            $defProc_service = new DefProc_Service();
            $feedback = $defProc_service->seek();
            if($feedback['ok']) {
                include_once './View/DefProcs/Delete_DefProc_View.php';
                new Delete_DefProc($feedback['resource']);
            } else {
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function delete() {
        if($this->checkPermission()) {
            $defProc_service = new DefProc_Service();
            $feedback = $defProc_service->DELETE();
            if(isset($feedback['plan'])) {
                new Message($feedback['code'],'DefProc','show',$feedback['plan']);
            } else {
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function showCurrent() {
        if($this->checkPermission()) {
            $defProc_service = new DefProc_Service();
            $feedback = $defProc_service->seek();
            if($feedback['ok']) {
                include_once './View/DefProcs/ShowCurrent_DefProc_View.php';
                new ShowCurrent_DefProc($feedback['resource']);
            } else {
                new Message($feedback['code'],'DFPLAN','show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }
}
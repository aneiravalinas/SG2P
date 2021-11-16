<?php

include_once 'Abstract_Controller.php';

class DefProc extends Abstract_Controller {

    function __construct() {
        include './View/Page/Message_View.php';
        include './Service/DefProc_Service.php';
    }

    function show() {
        if($this->checkPermission()) {
            $defProc_service = new DefProc_Service();
            $feedback = $defProc_service->SEARCH();
            if($feedback['ok']) {
                $this->update_stack_post();
                include_once './View/DefProcs/Show_DefProcs_View.php';
                new Show_DefProcs($feedback['resource'], $feedback['plan']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function addForm() {
        if($this->checkPermission()) {
            $defProc_service = new DefProc_Service();
            $feedback = $defProc_service->seekPlan();
            if($feedback['ok']) {
                include_once './View/DefProcs/Add_DefProc_View.php';
                new Add_DefProc($feedback['resource']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function add() {
        if($this->checkPermission()) {
            $defProc_service = new DefProc_Service();
            $feedback = $defProc_service->ADD();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
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
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function delete() {
        if($this->checkPermission()) {
            $defProc_service = new DefProc_Service();
            $feedback = $defProc_service->DELETE();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
        }
    }

    function showCurrent() {
        if($this->checkPermission()) {
            $defProc_service = new DefProc_Service();
            $feedback = $defProc_service->seek();
            if($feedback['ok']) {
                $this->update_stack_post();
                include_once './View/DefProcs/ShowCurrent_DefProc_View.php';
                new ShowCurrent_DefProc($feedback['resource']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function searchForm() {
        if($this->checkPermission()) {
            $defProc_service = new DefProc_Service();
            $feedback = $defProc_service->seekPlan();
            if($feedback['ok']) {
                include './View/DefProcs/Search_DefProc_View.php';
                new Search_DefProc($feedback['resource']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function editForm() {
        if($this->checkPermission()) {
            $defProc_service = new DefProc_Service();
            $feedback = $defProc_service->seek();
            if($feedback['ok']) {
                include './View/DefProcs/Edit_DefProc_View.php';
                new Edit_DefProc($feedback['resource']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function edit() {
        if($this->checkPermission()) {
            $defProc_service = new DefProc_Service();
            $feedback = $defProc_service->EDIT();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
        }
    }
}
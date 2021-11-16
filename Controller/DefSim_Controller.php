<?php

include_once 'Abstract_Controller.php';

class DefSim extends Abstract_Controller {

    function __construct() {
        include './View/Page/Message_View.php';
        include './Service/DefSim_Service.php';
    }

    function show() {
        if($this->checkPermission()) {
            $defSim_service = new DefSim_Service();
            $feedback = $defSim_service->SEARCH();
            if($feedback['ok']) {
                $this->update_stack_post();
                include_once './View/DefSims/Show_DefSims_View.php';
                new Show_DefSims($feedback['resource'], $feedback['plan']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
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
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function add() {
        if($this->checkPermission()) {
            $defSim_service = new DefSim_Service();
            $feedback = $defSim_service->ADD();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
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
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function delete() {
        if($this->checkPermission()) {
            $defSim_service = new DefSim_Service();
            $feedback = $defSim_service->DELETE();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
        }
    }

    function showCurrent() {
        if($this->checkPermission()) {
            $defSim_service = new DefSim_Service();
            $feedback = $defSim_service->seek();
            if($feedback['ok']) {
                $this->update_stack_post();
                include_once './View/DefSims/ShowCurrent_DefSim_View.php';
                new ShowCurrent_DefSim($feedback['resource']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
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
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
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
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function edit() {
        if($this->checkPermission()) {
            $defSim_service = new DefSim_Service();
            $feedback = $defSim_service->EDIT();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
        }
    }

}
<?php

include_once 'Abstract_Controller.php';

class DefPlan extends Abstract_Controller {

    function __construct() {
        include './View/Page/Message_View.php';
        include './Service/DefPlan_Service.php';
    }

    function show() {
        if($this->checkPermission()) {
            $defPlan_service = new DefPlan_Service();
            $feedback = $defPlan_service->SEARCH();
            if($feedback['ok']) {
                $this->update_stack_post();
                include_once './View/DefPlans/Show_DefPlans_View.php';
                new Show_DefPlans($feedback['resource']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }

    }

    function addForm() {
        if($this->checkPermission()) {
            include_once './View/DefPlans/Add_DefPlan_View.php';
            new Add_DefPlan();
        } else {
            new Message('FRB_ACCS');
        }
    }

    function add() {
        if($this->checkPermission()) {
            $defPlan_service = new DefPlan_Service();
            $feedback = $defPlan_service->ADD();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
        }
    }

    function deleteForm() {
        if($this->checkPermission()) {
            $defPlan_service = new DefPlan_Service();
            $feedback = $defPlan_service->seek();
            if ($feedback['ok']) {
                include_once './View/DefPlans/Delete_DefPlan_View.php';
                new Delete_DefPlan($feedback['resource']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function delete() {
        if($this->checkPermission()) {
            $defPlan_service = new DefPlan_Service();
            $feedback = $defPlan_service->DELETE();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
        }
    }

    function searchForm() {
        if($this->checkPermission()) {
            include_once './View/DefPlans/Search_DefPlan_View.php';
            new Search_DefPlan();
        } else {
            new Message('FRB_ACCS');
        }
    }

    function showCurrent() {
        if($this->checkPermission()) {
            $defPlan_service = new DefPlan_Service();
            $feedback = $defPlan_service->seek();
            if($feedback['ok']) {
                $this->update_stack_post();
                include_once './View/DefPlans/ShowCurrent_DefPlan_View.php';
                new ShowCurrent_DefPlan($feedback['resource']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function editForm() {
        if($this->checkPermission()) {
            $defPlan_service = new DefPlan_Service();
            $feedback = $defPlan_service->seek();
            if($feedback['ok']) {
                include_once './View/DefPlans/Edit_DefPlan_View.php';
                new Edit_DefPlan($feedback['resource']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function edit() {
        if($this->checkPermission()) {
            $defPlan_service = new DefPlan_Service();
            $feedback = $defPlan_service->EDIT();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
        }
    }
}
<?php

include_once 'Abstract_Controller.php';

class DefFormat extends Abstract_Controller {

    function __construct() {
        include './View/Page/Message_View.php';
        include './Service/DefFormat_Service.php';
    }

    function show() {
        if($this->checkPermission()) {
            $defFormat_service = new DefFormat_Service();
            $feedback = $defFormat_service->SEARCH();
            if($feedback['ok']) {
                $this->update_stack_post();
                include_once './View/DefFormats/Show_DefFormats_View.php';
                new Show_DefFormats($feedback['resource'], $feedback['plan']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function addForm() {
        if($this->checkPermission()) {
            $defFormat_service = new DefFormat_Service();
            $feedback = $defFormat_service->seekPlan();
            if($feedback['ok']) {
                include_once './View/DefFormats/Add_DefFormat_View.php';
                new Add_DefFormat($feedback['resource']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function add() {
        if($this->checkPermission()) {
            $defFormat_service = new DefFormat_Service();
            $feedback = $defFormat_service->ADD();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
        }
    }

    function deleteForm() {
        if($this->checkPermission()) {
            $defFormat_service = new DefFormat_Service();
            $feedback = $defFormat_service->seek();
            if($feedback['ok']) {
                include_once './View/DefFormats/Delete_DefFormat_View.php';
                new Delete_DefFormat($feedback['resource']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function delete() {
        if($this->checkPermission()) {
            $defFormat_service = new DefFormat_Service();
            $feedback = $defFormat_service->DELETE();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
        }
    }

    function showCurrent() {
        if($this->checkPermission()) {
            $defFormat_service = new DefFormat_Service();
            $feedback = $defFormat_service->seek();
            if($feedback['ok']) {
                $this->update_stack_post();
                include_once './View/DefFormats/ShowCurrent_DefFormat_View.php';
                new ShowCurrent_DefFormat($feedback['resource']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function searchForm() {
        if($this->checkPermission()) {
            $defFormat_service = new DefFormat_Service();
            $feedback = $defFormat_service->seekPlan();
            if($feedback['ok']) {
                include_once './View/DefFormats/Search_DefFormat_View.php';
                new Search_DefFormat($feedback['resource']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function editForm() {
        if($this->checkPermission()) {
            $defFormat_service = new DefFormat_Service();
            $feedback = $defFormat_service->seek();
            if($feedback['ok']) {
                include_once './View/DefFormats/Edit_DefFormat_View.php';
                new Edit_DefFormat($feedback['resource']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function edit() {
        if($this->checkPermission()) {
            $defFormat_service = new DefFormat_Service();
            $feedback = $defFormat_service->EDIT();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
        }
    }
}
<?php

include_once 'Abstract_Controller.php';

class DefDoc extends Abstract_Controller {

    function __construct() {
        include './View/Page/Message_View.php';
        include './Service/DefDoc_Service.php';
    }

    function show() {
        if($this->checkPermission()) {
            $defDoc_service = new DefDoc_Service();
            $feedback = $defDoc_service->SEARCH();
            if($feedback['ok']) {
                $this->update_stack_post();
                include_once './View/DefDocs/Show_DefDocs_View.php';
                new Show_DefDocs($feedback['resource'], $feedback['plan']);
            } else if(isset($feedback['plan'])) {
                new Message($feedback['code'],'DefDoc','show', $feedback['plan']);
            } else {
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function addForm() {
        if($this->checkPermission()) {
            $defDoc_service = new DefDoc_Service();
            $feedback = $defDoc_service->seekPlan();
            if($feedback['ok']) {
                include_once './View/DefDocs/Add_DefDoc_View.php';
                new Add_DefDoc($feedback['resource']);
            } else {
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function add() {
        if($this->checkPermission()) {
            $defDoc_service = new DefDoc_Service();
            $feedback = $defDoc_service->ADD();
            if(isset($feedback['plan'])){
                new Message($feedback['code'],'DefDoc','show', $feedback['plan']);
            } else {
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function deleteForm() {
        if($this->checkPermission()) {
            $defDoc_service = new DefDoc_Service();
            $feedback = $defDoc_service->seek();
            if($feedback['ok']) {
                include_once './View/DefDocs/Delete_DefDoc_View.php';
                new Delete_DefDoc($feedback['resource']);
            } else {
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function delete() {
        if($this->checkPermission()) {
            $defDoc_service = new DefDoc_Service();
            $feedback = $defDoc_service->DELETE();
            if(isset($feedback['plan'])) {
                new Message($feedback['code'], 'DefDoc','show',$feedback['plan']);
            } else {
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function searchForm() {
        if($this->checkPermission()) {
            $defDoc_service = new DefDoc_Service();
            $feedback = $defDoc_service->seekPlan();
            if($feedback['ok']) {
                include_once './View/DefDocs/Search_DefDoc_View.php';
                new Search_DefDoc($feedback['resource']);
            } else {
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function showCurrent() {
        if($this->checkPermission()) {
            $defDoc_service = new DefDoc_Service();
            $feedback = $defDoc_service->seek();
            if($feedback['ok']) {
                $this->update_stack_post();
                include_once './View/DefDocs/ShowCurrent_DefDoc_View.php';
                new ShowCurrent_DefDoc($feedback['resource']);
            } else {
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function editForm() {
        if($this->checkPermission()) {
            $defDoc_service = new DefDoc_Service();
            $feedback = $defDoc_service->seek();
            if($feedback['ok']) {
                include_once './View/DefDocs/Edit_DefDoc_View.php';
                new Edit_DefDoc($feedback['resource']);
            } else {
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function edit() {
        if($this->checkPermission()) {
            $defDoc_service = new DefDoc_Service();
            $feedback = $defDoc_service->EDIT();
            if(isset($feedback['plan'])) {
                new Message($feedback['code'],'DefDoc','show',$feedback['plan']);
            } else {
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

}
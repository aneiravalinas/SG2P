<?php

include_once 'Abstract_Controller.php';

class DefRoute extends Abstract_Controller {

    function __construct() {
        include './View/Page/Message_View.php';
        include './Service/DefRoute_Service.php';
    }

    function show() {
        if($this->checkPermission()) {
            $defRoute_service = new DefRoute_Service();
            $feedback = $defRoute_service->SEARCH();
            if($feedback['ok']) {
                $this->update_stack_post();
                include_once './View/DefRoutes/Show_DefRoutes_View.php';
                new Show_DefRoutes($feedback['resource'], $feedback['plan']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
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
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function add() {
        if($this->checkPermission()) {
            $defRoute_service = new DefRoute_Service();
            $feedback = $defRoute_service->ADD();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
        }
    }

    function deleteForm() {
        if($this->checkPermission()) {
            $defRoute_service = new DefRoute_Service();
            $feedback = $defRoute_service->seek();
            if($feedback['ok']) {
                include_once './View/DefRoutes/Delete_DefRoute_View.php';
                new Delete_DefRoute($feedback['resource']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function delete() {
        if($this->checkPermission()) {
            $defRoute_service = new DefRoute_Service();
            $feedback = $defRoute_service->DELETE();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
        }
    }

    function showCurrent() {
        if($this->checkPermission()) {
            $defRoute_service = new DefRoute_Service();
            $feedback = $defRoute_service->seek();
            if($feedback['ok']) {
                $this->update_stack_post();
                include_once './View/DefRoutes/ShowCurrent_DefRoute_View.php';
                new ShowCurrent_DefRoute($feedback['resource']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function searchForm() {
        if($this->checkPermission()) {
            $defRoute_service = new DefRoute_Service();
            $feedback = $defRoute_service->seekPlan();
            if($feedback['ok']) {
                include_once './View/DefRoutes/Search_DefRoute_View.php';
                new Search_DefRoute($feedback['resource']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function editForm() {
        if($this->checkPermission()) {
            $defRoute_service = new DefRoute_Service();
            $feedback = $defRoute_service->seek();
            if($feedback['ok']) {
                include_once './View/DefRoutes/Edit_DefRoute_View.php';
                new Edit_DefRoute($feedback['resource']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function edit() {
        if($this->checkPermission()) {
            $defRoute_service = new DefRoute_Service();
            $feedback = $defRoute_service->EDIT();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
        }
    }
}
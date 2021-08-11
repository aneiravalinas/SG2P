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

    function deleteForm() {
        if($this->checkPermission()) {
            $defRoute_service = new DefRoute_Service();
            $feedback = $defRoute_service->seek();
            if($feedback['ok']) {
                include_once './View/DefRoutes/Delete_DefRoute_View.php';
                new Delete_DefRoute($feedback['resource']);
            } else {
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function delete() {
        if($this->checkPermission()) {
            $defRoute_service = new DefRoute_Service();
            $feedback = $defRoute_service->DELETE();
            if(isset($feedback['plan'])) {
                new Message($feedback['code'],'DefRoute','show',$feedback['plan']);
            } else {
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function showCurrent() {
        if($this->checkPermission()) {
            $defRoute_service = new DefRoute_Service();
            $feedback = $defRoute_service->seek();
            if($feedback['ok']) {
                include_once './View/DefRoutes/ShowCurrent_DefRoute_View.php';
                new ShowCurrent_DefRoute($feedback['resource']);
            } else {
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
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
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
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
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function edit() {
        if($this->checkPermission()) {
            $defRoute_service = new DefRoute_Service();
            $feedback = $defRoute_service->EDIT();
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
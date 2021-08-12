<?php

class DefFormat {

    function __construct() {
        include './View/Page/Message_View.php';
        include './Service/DefFormat_Service.php';
    }

    function checkPermission() {
        return (es_resp_organizacion() || es_admin());
    }

    function show() {
        if($this->checkPermission()) {
            $defFormat_service = new DefFormat_Service();
            $feedback = $defFormat_service->SEARCH();
            if($feedback['ok']) {
                include_once './View/DefFormats/Show_DefFormats_View.php';
                new Show_DefFormats($feedback['resource'], $feedback['plan']);
            } else if(isset($feedback['plan'])) {
                new Message($feedback['code'],'DefFormat','show',$feedback['plan']);
            } else {
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
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
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function add() {
        if($this->checkPermission()) {
            $defFormat_service = new DefFormat_Service();
            $feedback = $defFormat_service->ADD();
            if(isset($feedback['plan'])) {
                new Message($feedback['code'],'DefFormat','show',$feedback['plan']);
            } else {
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
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
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function delete() {
        if($this->checkPermission()) {
            $defFormat_service = new DefFormat_Service();
            $feedback = $defFormat_service->DELETE();
            if(isset($feedback['plan'])) {
                new Message($feedback['code'],'DefFormat','show',$feedback['plan']);
            } else {
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function showCurrent() {
        if($this->checkPermission()) {
            $defFormat_service = new DefFormat_Service();
            $feedback = $defFormat_service->seek();
            if($feedback['ok']) {
                include_once './View/DefFormats/ShowCurrent_DefFormat_View.php';
                new ShowCurrent_DefFormat($feedback['resource']);
            } else {
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
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
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
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
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function edit() {
        if($this->checkPermission()) {
            $defFormat_service = new DefFormat_Service();
            $feedback = $defFormat_service->EDIT();
            if(isset($feedback['plan'])) {
                new Message($feedback['code'],'DefFormat','show',$feedback['plan']);
            } else {
                new Message($feedback['code'],'DefPlan','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }
}
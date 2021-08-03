<?php

class Space {

    function __construct() {
        include './View/Page/Message_View.php';
        include './Service/Space_Service.php';
    }

    function show() {
        if(!es_registrado()) {
            $space_service = new Space_Service();
            $feedback = $space_service->SEARCH();
            if($feedback['ok']) {
                include_once './View/Spaces/Show_Spaces_View.php';
                new Show_Spaces($feedback['resource'], $feedback['floor']);
            } else if(isset($feedback['floor'])) {
                new Message($feedback['code'],'Space','show',$feedback['floor']);
            } else {
                new Message($feedback['code'],'Building','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function addForm() {
        if(es_resp_organizacion() || es_admin()) {
            $space_service = new Space_Service();
            $feedback = $space_service->emptyForm();
            if($feedback['ok']) {
                include './View/Spaces/Add_Space_View.php';
                new Add_Space($feedback['resource']);
            } else {
                new Message($feedback['code'],'Building','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function add() {
        if(es_resp_organizacion() || es_admin()) {
            $space_service = new Space_Service();
            $feedback = $space_service->ADD();
            if(isset($feedback['floor'])) {
                new Message($feedback['code'],'Space','show',$feedback['floor']);
            } else {
                new Message($feedback['code'],'Building','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function deleteForm() {
        if(es_resp_organizacion() || es_admin()) {
            $space_service = new Space_Service();
            $feedback = $space_service->dataForm();
            if($feedback['ok']) {
                include_once './View/Spaces/Delete_Space_View.php';
                new Delete_Space($feedback['resource'], $feedback['floor']);
            } else {
                new Message('FRB_ACCS','Building','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function delete() {
        if(es_resp_organizacion() || es_admin()) {
            $space_service = new Space_Service();
            $feedback = $space_service->DELETE();
            if(isset($feedback['floor'])) {
                new Message($feedback['code'],'Space','show',$feedback['floor']);
            } else {
                new Message($feedback['code'],'Building','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function showCurrent() {
        if(!es_registrado()) {
            $space_service = new Space_Service();
            $feedback = $space_service->seek();
            if($feedback['ok']) {
                include_once './View/Spaces/ShowCurrent_Space_View.php';
                new ShowCurrent_Space($feedback['resource'], $feedback['floor']);
            } else {
                new Message($feedback['code'],'Building','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function searchForm() {
        if(!es_registrado()) {
            $space_service = new Space_Service();
            $feedback = $space_service->emptyForm();
            if($feedback['ok']) {
                include_once './View/Spaces/Search_Space_View.php';
                new Search_Space($feedback['resource']);
            } else {
                new Message($feedback['code'],'Building','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }
}
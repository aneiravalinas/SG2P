<?php

class Floor {

    function __construct() {
        include './View/Page/Message_View.php';
        include './Service/Floor_Service.php';
    }

    function show() {
        if(!es_registrado()) {
            $floor_service = new Floor_Service();
            $feedback = $floor_service->SEARCH();
            if($feedback['ok']) {
                include_once './View/Floors/Show_Floors_View.php';
                new Show_Floors($feedback['resource'], $feedback['building']);
            } else if(isset($feedback['building'])) {
                new Message($feedback['code'],'Floor','show',$feedback['building']);
            } else {
                new Message($feedback['code'],'Building','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function addForm() {
        if(es_resp_organizacion() || es_admin()) {
            $floor_service = new Floor_Service();
            $feedback = $floor_service->emptyForm();
            if($feedback['ok']) {
                include_once './View/Floors/Add_Floor_View.php';
                new Add_Floor($feedback['building']);
            } else if(isset($feedback['building'])){
                new Message($feedback['code'],'Floor','show', $feedback['building']);
            } else {
                new Message($feedback['code'],'Building','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function add() {
        if(es_resp_organizacion() || es_admin()) {
            $floor_service = new Floor_Service();
            $feedback = $floor_service->ADD();
            if(isset($feedback['building'])) {
                new Message($feedback['code'],'Floor','show', $feedback['building']);
            } else {
                new Message($feedback['code'],'Building','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function showCurrent() {
        if(!es_registrado()) {
            $floor_service = new Floor_Service();
            $feedback = $floor_service->seek();
            if($feedback['ok']) {
                include_once './View/Floors/ShowCurrent_Floor_View.php';
                new ShowCurrent_Floor($feedback['resource'], $feedback['building']);
            } else {
                if(isset($feedback['building'])) {
                    new Message($feedback['code'],'Floor','show', $feedback['building']);
                } else {
                    new Message($feedback['code'],'Building','show');
                }
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function deleteForm() {
        if(es_resp_organizacion() || es_admin()) {
            $floor_service = new Floor_Service();
            $feedback = $floor_service->dataForm();
            if($feedback['ok']) {
                include_once './View/Floors/Delete_Floor_View.php';
                new Delete_Floor($feedback['resource'],$feedback['building']);
            } else {
                new Message($feedback['code'],'Building','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function delete() {
        if(es_resp_organizacion() || es_admin()) {
            $floor_service = new Floor_Service();
            $feedback = $floor_service->DELETE();
            if(isset($feedback['building'])) {
                new Message($feedback['code'],'Floor','show', $feedback['building']);
            } else {
                new Message($feedback['code'],'Building','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function searchForm() {
        if(!es_registrado()) {
            $floor_service = new Floor_Service();
            $feedback = $floor_service->emptyForm();
            if($feedback['ok']) {
                include_once './View/Floors/Search_Floor_View.php';
                new Search_Floor($feedback['building']);
            } else {
                new Message($feedback['code'],'Building','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function editForm() {
        if(es_resp_organizacion() || es_admin()) {
            $floor_service = new Floor_Service();
            $feedback = $floor_service->dataForm();
            if($feedback['ok']) {
                include_once './View/Floors/Edit_Floor_View.php';
                new Edit_Floor($feedback['resource'],$feedback['building']);
            } else {
                new Message($feedback['code'],'Building','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function edit() {
        if(es_resp_organizacion() || es_admin()) {
            $floor_service = new Floor_Service();
            $feedback = $floor_service->EDIT();
            if(isset($feedback['building'])) {
                new Message($feedback['code'],'Floor','show',$feedback['building']);
            } else {
                new Message($feedback['code'],'Building','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

}
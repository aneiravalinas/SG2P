<?php

class Building {

    function __construct() {
        include './View/Page/Message_View.php';
        include './Service/Building_Service.php';
    }

    function show() {
        if(!es_registrado()) {
            $building_service = new Building_Service();
            $feedback = $building_service->SEARCH();
            if($feedback['ok']) {
                include_once './View/Buildings/Show_Buildings_View.php';
                new Show_Buildings($feedback['resource']);
            } else {
                new Message($feedback['code'],'Portal','deshboard');
            }
        } else {
            new Message('FRB_ACCS','Portal','deshboard');
        }
    }

    function addForm() {
        if(es_resp_organizacion() || es_admin()) {
            $building_service = new Building_Service();
            $feedback = $building_service->addForm();
            if($feedback['ok']) {
                include_once './View/Buildings/Add_Building_View.php';
                new Add_Building($feedback['resource']);
            } else {
                new Message($feedback['code'],'Building','show');
            }
        } else {
            new Message('FRB_ACCS','Portal','deshboard');
        }
    }

    function add() {
        if(es_resp_organizacion() || es_admin()) {
            $building_service = new Building_Service();
            $feedback = $building_service->ADD();
            new Message($feedback['code'],'Building','show');
        } else {
            new Message('FRB_ACCS','Portal','deshboard');
        }
    }

    function deleteForm() {
        if(es_resp_organizacion() || es_admin()) {
            $building_service = new Building_Service();
            $feedback = $building_service->dataForm();
            if($feedback['ok']) {
                include './View/Buildings/Delete_Building_View.php';
                new Delete_Building($feedback['resource']);
            } else {
                new Message($feedback['code'],'Building','show');
            }
        } else {
            new Message('FRB_ACCS','Portal','deshboard');
        }
    }

    function delete() {
        if(es_resp_organizacion() || es_admin()) {
            $building_service = new Building_Service();
            $feedback = $building_service->DELETE();
            new Message($feedback['code'],'Building','show');
        } else {
            new Message('FRB_ACCS','Portal','deshboard');
        }
    }
}
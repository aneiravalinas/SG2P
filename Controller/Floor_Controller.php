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
            } else  {
                new Message($feedback['code'],'Building','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function addForm() {
        if(es_resp_organizacion() || es_admin()) {
            $floor_service = new Floor_Service();
            $feedback = $floor_service->addForm();
            if($feedback['ok']) {
                include_once './View/Floors/Add_Floor_View.php';
                new Add_Floor($feedback['building']);
            } else if(isset($feedback['building'])){
                new Message($feedback['code'],'Floor','show', array('edificio_id' => $feedback['building']['edificio_id']));
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
                new Message($feedback['code'],'Floor','show', array('edificio_id' => $feedback['building']['edificio_id']));
            } else {
                new Message($feedback['code'],'Building','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }


}
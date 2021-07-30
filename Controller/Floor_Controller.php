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
                new Show_Floors($feedback['resource'], $feedback['bname']);
            } else {
                new Message($feedback['code'],'Building','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }


}
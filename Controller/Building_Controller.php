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
}
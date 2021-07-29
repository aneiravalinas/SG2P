<?php

class Portal {

    function __construct() {
        include './View/Page/Message_View.php';
        include './Service/Building_Service.php';
    }

    function _default() {
        $this->showCities();
    }

    function deshboard() {
        include './View/Deshboard/Deshboard_View.php';
        new Deshboard();
    }

    function showCities() {
        include './View/Portal/Portal_Cities_View.php';
        $building_service = new Building_Service();
        $feedback = $building_service->showCities();
        if($feedback['ok']) {
            new Portal_Cities($feedback['resource']);
        } else {
            include_once './View/Portal/Cities_Empty_View.php';
            new Cities_Empty($feedback['code']);
        }
    }

    function searchBuildingsByCity() {
        $building_service = new Building_Service();
        $feedback = $building_service->searchBuildingsByCity();
        if($feedback['ok']) {
            include_once './View/Portal/Portal_Buildings_View.php';
            new Portal_Buildings($feedback['resource']);
        } else {
            new Message($feedback['code'],'Portal','_default');
        }
    }
}

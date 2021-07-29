<?php

class Portal {

    function __construct() {
        include './View/Page/Message_View.php';
        include './Service/Building_Service.php';
    }

    function _default() {
        $this->showCities();
    }

    function showCities() {
        if(isset($_SESSION) && isset($_SESSION['portal'])) {
            unset($_SESSION['portal']);
        }

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

    function getPortal() {
        $building_service = new Building_Service();
        $feedback = $building_service->seekPortal();
        if($feedback['ok']) {
            include_once './View/Portal/Show_Portal_View.php';
            new Show_Portal($feedback['resource']);
        } else {
            new Message($feedback['code'],'Portal','_default');
        }
    }

    function seekPortalManager() {
        include_once './Service/User_Service.php';
        $user_service = new User_Service();
        $feedback = $user_service->seekPortalManager();
        if($feedback['ok']) {
            include_once './View/Portal/Portal_Manager_View.php';
            new Portal_Manager($feedback['resource']);
        } else {
            new Message($feedback['code'],'Portal','getPortal');
        }
    }
}

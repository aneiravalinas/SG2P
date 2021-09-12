<?php

class Route {

    function __construct() {
        include './View/Page/Message_View.php';
        include './Service/Route_Service.php';
    }

    function show() {
        if(!es_registrado()) {
            $route_service = new Route_Service();
            $feedback = $route_service->searchRoute();
            if($feedback['ok']) {
                include_once './View/Routes/Show_Route_View.php';
                new Show_Route($feedback['resource'], $feedback['route'], $feedback['building']);
            } else if(isset($feedback['return'])) {
                new Message($feedback['code'], 'Route', 'show', $feedback['return']);
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }
}
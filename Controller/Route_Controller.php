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

    function addForm() {
        if(!es_registrado()) {
            $route_service = new Route_Service();
            $feedback = $route_service->routeForm();
            if($feedback['ok']) {
                include_once './View/Routes/Add_Route_View.php';
                new Add_Route($feedback['resource'], $feedback['route'], $feedback['building']);
            } else if(isset($feedback['return'])) {
                new Message($feedback['code'], 'Route', 'show', $feedback['return']);
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function add() {
        if(!es_registrado()) {
            $route_service = new Route_Service();
            $feedback = $route_service->addRoute();
            if(isset($feedback['return'])) {
                new Message($feedback['code'], 'Route', 'show', $feedback['return']);
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function expireForm() {
        if(!es_registrado()) {
            $route_service = new Route_Service();
            $feedback = $route_service->seek();
            if($feedback['ok']) {
                include_once './View/Routes/Expire_Route_View.php';
                new Expire_Route($feedback['resource']);
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function expire() {
        if(!es_registrado()) {
            $route_service = new Route_Service();
            $feedback = $route_service->expire();
            if(isset($feedback['return'])) {
                new Message($feedback['code'], 'Route', 'show', $feedback['return']);
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function implementForm() {
        if(!es_registrado()) {
            $route_service = new Route_Service();
            $feedback = $route_service->seek();
            if($feedback['ok']) {
                include_once './View/Routes/Implement_Route_View.php';
                new Implement_Route($feedback['resource']);
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function implement() {
        if(!es_registrado()) {
            $route_service = new Route_Service();
            $feedback = $route_service->implement();
            if(isset($feedback['return'])) {
                new Message($feedback['code'], 'Route', 'show', $feedback['return']);
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function deleteForm() {
        if(!es_registrado()) {
            $route_service = new Route_Service();
            $feedback = $route_service->seek();
            if($feedback['ok']) {
                include_once './View/Routes/Delete_Route_View.php';
                new Delete_Route($feedback['resource']);
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function delete() {
        if(!es_registrado()) {
            $route_service = new Route_Service();
            $feedback = $route_service->DELETE();
            if(isset($feedback['return'])) {
                new Message($feedback['code'], 'Route', 'show', $feedback['return']);
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function showCurrent() {
        if(!es_registrado()) {
            $route_service = new Route_Service();
            $feedback = $route_service->seek();
            if($feedback['ok']) {
                include_once './View/Routes/ShowCurrent_Route_View.php';
                new ShowCurrent_Route($feedback['resource']);
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function searchForm() {
        if(!es_registrado()) {
            $route_service = new Route_Service();
            $feedback = $route_service->routeForm();
            if($feedback['ok']) {
                include_once './View/Routes/Search_Route_View.php';
                new Search_Route($feedback['resource'], $feedback['building'], $feedback['route']);
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
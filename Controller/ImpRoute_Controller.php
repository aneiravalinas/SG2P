<?php

class ImpRoute {

    function __construct() {
        include './View/Page/Message_View.php';
        include './Service/Route_Service.php';
    }

    function checkPermission() {
        return (es_resp_organizacion() || es_admin());
    }

    function show() {
        if($this->checkPermission()) {
            $route_service = new Route_Service();
            $feedback = $route_service->searchImpRoutes();
            if($feedback['ok']) {
                include_once './View/ImpRoutes/Show_ImpRoutes_View.php';
                new Show_ImpRoutes($feedback['resource'], $feedback['route']);
            } else if(isset($feedback['route'])) {
                new Message($feedback['code'], 'ImpRoute', 'show', $feedback['route']);
            } else {
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function addForm() {
        if($this->checkPermission()) {
            $route_service = new Route_Service();
            $feedback = $route_service->addImpRouteForm();
            if($feedback['ok']) {
                include_once './View/ImpRoutes/Add_ImpRoute_View.php';
                new Add_ImpRoute($feedback['resource'], $feedback['route']);
            } else if(isset($feedback['route'])) {
                new Message($feedback['code'], 'ImpRoute', 'show', $feedback['route']);
            } else {
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function add() {
        if($this->checkPermission()) {
            $route_service = new Route_Service();
            $feedback = $route_service->addImpRoute();
            if(isset($feedback['route'])) {
                new Message($feedback['code'], 'ImpRoute', 'show', $feedback['route']);
            } else {
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function expireForm() {
        if($this->checkPermission()) {
            $route_service = new Route_Service();
            $feedback = $route_service->seek();
            if($feedback['ok']) {
                include_once './View/ImpRoutes/Expire_ImpRoute_View.php';
                new Expire_ImpRoute($feedback['resource']);
            } else {
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function expire() {
        if($this->checkPermission()) {
            $route_service = new Route_Service();
            $feedback = $route_service->expire();
            if(isset($feedback['return'])) {
                new Message($feedback['code'], 'ImpRoute', 'show', array('ruta_id' => $feedback['return']['ruta_id']));
            } else {
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function implementForm() {
        if($this->checkPermission()) {
            $route_service = new Route_Service();
            $feedback = $route_service->seek();
            if($feedback['ok']) {
                include_once './View/ImpRoutes/Implement_ImpRoute_View.php';
                new Implement_ImpRoute($feedback['resource']);
            } else {
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function implement() {
        if($this->checkPermission()) {
            $route_service = new Route_Service();
            $feedback = $route_service->implement();
            if(isset($feedback['return'])) {
                new Message($feedback['code'], 'ImpRoute', 'show', array('ruta_id' => $feedback['return']['ruta_id']));
            } else {
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function deleteForm() {
        if($this->checkPermission()) {
            $route_service = new Route_Service();
            $feedback = $route_service->seek();
            if($feedback['ok']) {
                include_once './View/ImpRoutes/Delete_ImpRoute_View.php';
                new Delete_ImpRoute($feedback['resource']);
            } else{
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function delete() {
        if($this->checkPermission()) {
            $route_service = new Route_Service();
            $feedback = $route_service->DELETE();
            if(isset($feedback['return'])) {
                new Message($feedback['code'], 'ImpRoute', 'show', array('ruta_id' => $feedback['return']['ruta_id']));
            } else {
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }
}
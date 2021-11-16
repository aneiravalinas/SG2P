<?php

include_once 'Abstract_Controller.php';

class ImpRoute extends Abstract_Controller {

    function __construct() {
        include './View/Page/Message_View.php';
        include './Service/Route_Service.php';
    }

    function show() {
        if($this->checkPermission()) {
            $route_service = new Route_Service();
            $feedback = $route_service->searchCompletions();
            if($feedback['ok']) {
                $this->update_stack_post();
                include_once './View/ImpRoutes/Show_ImpRoutes_View.php';
                new Show_ImpRoutes($feedback['resource'], $feedback['route']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function addForm() {
        if($this->checkPermission()) {
            $route_service = new Route_Service();
            $feedback = $route_service->addImpRouteForm();
            if($feedback['ok']) {
                include_once './View/ImpRoutes/Add_ImpRoute_View.php';
                new Add_ImpRoute($feedback['resource'], $feedback['route']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function add() {
        if($this->checkPermission()) {
            $route_service = new Route_Service();
            $feedback = $route_service->addImpRoute();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
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
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function expire() {
        if($this->checkPermission()) {
            $route_service = new Route_Service();
            $feedback = $route_service->expire();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
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
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function implement() {
        if($this->checkPermission()) {
            $route_service = new Route_Service();
            $feedback = $route_service->implement();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
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
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function delete() {
        if($this->checkPermission()) {
            $route_service = new Route_Service();
            $feedback = $route_service->DELETE();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
        }
    }

    function showCurrent() {
        if($this->checkPermission()) {
            $route_service = new Route_Service();
            $feedback = $route_service->seek();
            if($feedback['ok']) {
                $this->update_stack_post();
                include_once './View/ImpRoutes/ShowCurrent_ImpRoute_View.php';
                new ShowCurrent_ImpRoute($feedback['resource']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function searchForm() {
        if($this->checkPermission()) {
            $route_service = new Route_Service();
            $feedback = $route_service->seekRoute();
            if($feedback['ok']) {
                include_once './View/ImpRoutes/Search_ImpRoute_View.php';
                new Search_ImpRoute($feedback['resource']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }
}
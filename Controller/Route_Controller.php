<?php

include_once 'Abstract_Controller.php';

class Route extends Abstract_Controller {

    function __construct() {
        include './View/Page/Message_View.php';
        include './Service/Route_Service.php';
    }

    function show() {
        if(!es_registrado()) {
            $route_service = new Route_Service();
            $feedback = $route_service->searchRoute();
            if($feedback['ok']) {
                $this->update_stack_post();
                include_once './View/Routes/Show_Route_View.php';
                new Show_Route($feedback['resource'], $feedback['route'], $feedback['building']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function addForm() {
        if(!es_registrado()) {
            $route_service = new Route_Service();
            $feedback = $route_service->routeForm();
            if($feedback['ok']) {
                include_once './View/Routes/Add_Route_View.php';
                new Add_Route($feedback['resource'], $feedback['route'], $feedback['building']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function add() {
        if(!es_registrado()) {
            $route_service = new Route_Service();
            $feedback = $route_service->addRoute();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
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
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function expire() {
        if(!es_registrado()) {
            $route_service = new Route_Service();
            $feedback = $route_service->expire();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
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
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function implement() {
        if(!es_registrado()) {
            $route_service = new Route_Service();
            $feedback = $route_service->implement();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
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
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function delete() {
        if(!es_registrado()) {
            $route_service = new Route_Service();
            $feedback = $route_service->DELETE();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
        }
    }

    function showCurrent() {
        if(!es_registrado()) {
            $route_service = new Route_Service();
            $feedback = $route_service->seek();
            if($feedback['ok']) {
                $this->update_stack_post();
                include_once './View/Routes/ShowCurrent_Route_View.php';
                new ShowCurrent_Route($feedback['resource']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function searchForm() {
        if(!es_registrado()) {
            $route_service = new Route_Service();
            $feedback = $route_service->routeForm();
            if($feedback['ok']) {
                include_once './View/Routes/Search_Route_View.php';
                new Search_Route($feedback['resource'], $feedback['building'], $feedback['route']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }
}
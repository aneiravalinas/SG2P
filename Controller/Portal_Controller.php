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

    function showPortalFloors() {
        include_once './Service/Floor_Service.php';
        $floor_service = new Floor_Service();
        $feedback = $floor_service->searchPortalFloors();
        if($feedback['ok']) {
            include_once './View/Portal/Portal_Floors_View.php';
            new Portal_Floors($feedback['resource']);
        } else {
            new Message($feedback['code'],'Portal','getPortal');
        }
    }

    function seekPortalFloor() {
        include_once './Service/Floor_Service.php';
        $floor_service = new Floor_Service();
        $feedback = $floor_service->seekPortalFloor();
        if($feedback['ok']) {
            include_once './View/Portal/Portal_ShowCurrent_Floor_View.php';
            new Portal_ShowCurrent_Floor($feedback['resource'], $feedback['spaces']);
        } else {
            new Message($feedback['code'],'Portal','getPortal');
        }
    }

    function seekPortalSpace() {
        include_once './Service/Space_Service.php';
        $space_service = new Space_Service();
        $feedback = $space_service->seekPortalSpace();
        if($feedback['ok']) {
            include_once './View/Portal/Portal_ShowCurrent_Space_View.php';
            new Portal_ShowCurrent_Space($feedback['resource']);
        } else {
            new Message($feedback['code'],'Portal','getPortal');
        }
    }

    function showPortalPlans() {
        include_once './Service/Plan_Service.php';
        $plan_service = new Plan_Service();
        $feedback = $plan_service->searchPortalPlans();
        if($feedback['ok']) {
            include_once './View/Portal/Portal_Plans_View.php';
            new Portal_Plans($feedback['resource'], $feedback['building']);
        } else {
            new Message($feedback['code'],'Portal','getPortal');
        }
    }

    function seekPortalPlan() {
        include_once './Service/Plan_Service.php';
        $plan_service = new Plan_Service();
        $feedback = $plan_service->seekPortalPlan();
        if($feedback['ok']) {
            include_once './View/Portal/Portal_ShowCurrent_Plan_View.php';
            new Portal_ShowCurrent_Plan($feedback['resource'], $feedback['edificio'], $feedback['plan'], $feedback['definiciones']);
        } else {
            new Message($feedback['code'],'Portal','getPortal');
        }
    }

    function seekPortalDocument() {
        include_once './Service/Document_Service.php';
        $document_service = new Document_Service();
        $feedback = $document_service->seekPortalDocument();
        if($feedback['ok']) {
            include_once './View/Portal/Portal_ShowCurrent_Document_View.php';
            new Portal_ShowCurrent_Document($feedback['resource'], $feedback['document'], $feedback['building']);
        } else if(isset($feedback['return'])) {
            new Message($feedback['code'], 'Portal', 'seekPortalPlan', $feedback['return']);
        } else {
            new Message($feedback['code'], 'Portal', 'getPortal');
        }
    }

    function seekPortalImpDoc() {
        include_once './Service/Document_Service.php';
        $document_service = new Document_Service();
        $feedback = $document_service->seekPortalImpDoc();
        if($feedback['ok']) {
            include_once './View/Portal/Portal_ShowCurrent_ImpDoc_View.php';
            new Portal_ShowCurrent_ImpDoc($feedback['resource']);
        } else {
            new Message($feedback['code'], 'Portal', 'getPortal');
        }
    }

    function seekPortalProcedure() {
        include_once './Service/Procedure_Service.php';
        $procedure_service = new Procedure_Service();
        $feedback = $procedure_service->seekPortalProcedure();
        if($feedback['ok']) {
            include_once './View/Portal/Portal_ShowCurrent_Procedure_View.php';
            new Portal_ShowCurrent_Procedure($feedback['resource'], $feedback['procedure'], $feedback['building']);
        } else if(isset($feedback['return'])) {
            new Message($feedback['code'], 'Portal', 'seekPortalPlan', $feedback['return']);
        } else {
            new Message($feedback['code'], 'Portal', 'getPortal');
        }
    }

    function seekPortalImpProc() {
        include_once './Service/Procedure_Service.php';
        $procedure_service = new Procedure_Service();
        $feedback = $procedure_service->seekPortalImpProc();
        if($feedback['ok']) {
            include_once './View/Portal/Portal_ShowCurrent_ImpProc_View.php';
            new Portal_ShowCurrent_ImpProc($feedback['resource']);
        } else {
            new Message($feedback['code'], 'Portal', 'getPortal');
        }
    }

    function seekPortalRoute() {
        include_once './Service/Route_Service.php';
        $route_service = new Route_Service();
        $feedback = $route_service->seekPortalRoute();
        if($feedback['ok']) {
            include_once './View/Portal/Portal_ShowCurrent_Route_View.php';
            new Portal_ShowCurrent_Route($feedback['resource'], $feedback['route'], $feedback['building']);
        } else if(isset($feedback['return'])) {
            new Message($feedback['code'], 'Portal', 'seekPortalRoute', $feedback['return']);
        } else {
            new Message($feedback['code'], 'Portal', 'getPortal');
        }
    }

    function seekPortalImpRoute() {
        include_once './Service/Route_Service.php';
        $route_service = new Route_Service();
        $feedback = $route_service->seekPortalImpRoute();
        if($feedback['ok']) {
            include_once './View/Portal/Portal_ShowCurrent_ImpRoute_View.php';
            new Portal_ShowCurrent_ImpRoute($feedback['resource']);
        } else {
            new Message($feedback['code'], 'Portal', 'getPortal');
        }
    }

    function searchPortalRouteForm() {
        include_once './Service/Route_Service.php';
        $route_service = new Route_Service();
        $feedback = $route_service->searchPortalRouteForm();
        if($feedback['ok']) {
            include_once './View/Portal/Portal_Search_Route_View.php';
            new Portal_Search_Route($feedback['resource'],$feedback['route'], $feedback['building']);
        } else {
            new Message($feedback['code'], 'Portal', 'getPortal');
        }
    }

    function seekPortalFormation() {
        include_once './Service/Formation_Service.php';
        $format_service = new Formation_Service();
        $feedback = $format_service->seekPortalFormation();
        if($feedback['ok']) {
            include_once './View/Portal/Portal_ShowCurrent_Formation_View.php';
            new Portal_ShowCurrent_Formation($feedback['resource'], $feedback['formation'], $feedback['building']);
        } else if(isset($feedback['return'])) {
            new Message($feedback['code'], 'Portal', 'seekPortalFormation', $feedback['return']);
        } else {
            new Message($feedback['code'], 'Portal', 'getPortal');
        }
    }
}

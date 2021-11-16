<?php

include_once 'Abstract_Controller.php';

class Plan extends Abstract_Controller {

    function __construct() {
        include './View/Page/Message_View.php';
        include './Service/Plan_Service.php';
    }

    function show() {
        if(!es_registrado()) {
            $plan_service = new Plan_Service();
            $feedback = $plan_service->SEARCH();
            if($feedback['ok']) {
                $this->update_stack_post();
                include_once './View/Plans/Show_Plans_View.php';
                new Show_Plans($feedback['resource']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function searchForm() {
        if(!es_registrado()) {
            include_once './View/Plans/Search_Plans_View.php';
            new Search_Plans();
        } else {
            new Message('FRB_ACCS');
        }
    }

    function showCurrent() {
        if(!es_registrado()) {
            $plan_service = new Plan_Service();
            $feedback = $plan_service->seek();
            if($feedback['ok']) {
                $this->update_stack_post();
                include_once './View/Plans/ShowCurrent_Plan_View.php';
                new ShowCurrent_Plan($feedback['resource'], $feedback['edificio'], $feedback['plan'], $feedback['definiciones']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function expireForm() {
        if(!es_registrado()) {
            include_once './Service/BuildPlan_Service.php';
            $bldPlan_service = new BuildPlan_Service();
            $feedback = $bldPlan_service->seek();
            if($feedback['ok']) {
                include_once './View/Plans/Expire_Plan_View.php';
                new Expire_Plan($feedback['plan'], $feedback['edificio']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function expire() {
        if(!es_registrado()) {
            include_once './Service/BuildPlan_Service.php';
            $bldPlan_service = new BuildPlan_Service();
            $feedback = $bldPlan_service->expire();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
        }
    }
}
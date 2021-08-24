<?php

class Plan {

    function __construct() {
        include './View/Page/Message_View.php';
        include './Service/Plan_Service.php';
    }

    function show() {
        if(!es_registrado()) {
            $plan_service = new Plan_Service();
            $feedback = $plan_service->SEARCH();
            if($feedback['ok']) {
                include_once './View/Plans/Show_Plans_View.php';
                new Show_Plans($feedback['resource']);
            } else {
                new Message($feedback['code'],'Panel','deshboard');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function searchForm() {
        if(!es_registrado()) {
            include_once './View/Plans/Search_Plans_View.php';
            new Search_Plans();
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function showCurrent() {
        if(!es_registrado()) {
            $plan_service = new Plan_Service();
            $feedback = $plan_service->seek();
            if($feedback['ok']) {
                include_once './View/Plans/ShowCurrent_Plan_View.php';
                new ShowCurrent_Plan($feedback['resource'], $feedback['edificio'], $feedback['plan'], $feedback['definiciones']);
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }
}
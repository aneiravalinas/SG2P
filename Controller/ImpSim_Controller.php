<?php

class ImpSim {

    function __construct() {
        include './View/Page/Message_View.php';
        include './Service/Simulacrum_Service.php';
    }

    function checkPermission() {
        return (es_resp_organizacion() || es_admin());
    }

    function show() {
        if($this->checkPermission()) {
            $sim_service = new Simulacrum_Service();
            $feedback = $sim_service->searchImpSims();
            if($feedback['ok']) {
                include_once './View/ImpSims/Show_ImpSims_View.php';
                new Show_ImpSims($feedback['resource'], $feedback['simulacrum']);
            } else if(isset($feedback['simulacrum'])) {
                new Message($feedback['code'], 'ImpSim', 'show', $feedback['simulacrum']);
            } else {
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function addForm() {
        if($this->checkPermission()) {
            $sim_service = new Simulacrum_Service();
            $feedback = $sim_service->addImpSimForm();
            if($feedback['ok']) {
                include_once './View/ImpSims/Add_ImpSim_View.php';
                new Add_ImpSim($feedback['resource'], $feedback['simulacrum']);
            } else if(isset($feedback['simulacrum'])) {
                new Message($feedback['code'], 'ImpSim', 'show', $feedback['simulacrum']);
            } else {
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function add() {
        if($this->checkPermission()) {
            $sim_service = new Simulacrum_Service();
            $feedback = $sim_service->addImpSim();
            if(isset($feedback['simulacrum'])) {
                new Message($feedback['code'], 'ImpSim', 'show', $feedback['simulacrum']);
            } else {
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }
}
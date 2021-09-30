<?php

class Simulacrum {

    function __construct() {
        include './View/Page/Message_View.php';
        include './Service/Simulacrum_Service.php';
    }

    function show() {
        if(!es_registrado()) {
            $sim_service = new Simulacrum_Service();
            $feedback = $sim_service->searchSimulacrum();
            if($feedback['ok']) {
                include_once './View/Simulacrums/Show_Simulacrum_View.php';
                new Show_Simulacrum($feedback['resource'], $feedback['simulacrum'], $feedback['building']);
            } else if(isset($feedback['return'])) {
                new Message($feedback['code'], 'Simulacrum', 'show', $feedback['return']);
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function addForm() {
        if(!es_registrado()) {
            $sim_service = new Simulacrum_Service();
            $feedback = $sim_service->simulacrumForm();
            if($feedback['ok']) {
                include_once './View/Simulacrums/Add_Simulacrum_View.php';
                new Add_Simulacrum($feedback['simulacrum'], $feedback['building']);
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function add() {
        if(!es_registrado()) {
            $sim_service = new Simulacrum_Service();
            $feedback = $sim_service->addImpSim();
            if(isset($feedback['simulacrum']) && isset($feedback['building'])) {
                new Message($feedback['code'], 'Simulacrum', 'show', array('edificio_id' => $feedback['building']['edificio_id'],
                                                                                            'simulacro_id' => $feedback['simulacrum']['simulacro_id']));
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }
}
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

    function deleteForm() {
        if(!es_registrado()) {
            $sim_service = new Simulacrum_Service();
            $feedback = $sim_service->seek();
            if($feedback['ok']) {
                include_once './View/Simulacrums/Delete_Simulacrum_View.php';
                new Delete_Simulacrum($feedback['resource']);
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function delete() {
        if(!es_registrado()) {
            $sim_service = new Simulacrum_Service();
            $feedback = $sim_service->DELETE();
            if(isset($feedback['return'])) {
                new Message($feedback['code'], 'Simulacrum', 'show', $feedback['return']);
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function expireForm() {
        if(!es_registrado()) {
            $sim_service = new Simulacrum_Service();
            $feedback = $sim_service->seek();
            if($feedback['ok']) {
                include_once './View/Simulacrums/Expire_Simulacrum_View.php';
                new Expire_Simulacrum($feedback['resource']);
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function expire() {
        if(!es_registrado()) {
            $sim_service = new Simulacrum_Service();
            $feedback = $sim_service->expire();
            if(isset($feedback['return'])) {
                new Message($feedback['code'], 'Simulacrum', 'show', $feedback['return']);
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function implementForm() {
        if(!es_registrado()) {
            $sim_service = new Simulacrum_Service();
            $feedback = $sim_service->seek();
            if($feedback['ok']) {
                include_once './View/Simulacrums/Implement_Simulacrum_View.php';
                new Implement_Simulacrum($feedback['resource']);
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function implement() {
        if(!es_registrado()) {
            $sim_service = new Simulacrum_Service();
            $feedback = $sim_service->implement();
            if(isset($feedback['return'])) {
                new Message($feedback['code'], 'Simulacrum', 'show', $feedback['return']);
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function showCurrent() {
        if(!es_registrado()) {
            $sim_service = new Simulacrum_Service();
            $feedback = $sim_service->seek();
            if($feedback['ok']) {
                include_once './View/Simulacrums/ShowCurrent_Simulacrum_View.php';
                new ShowCurrent_Simulacrum($feedback['resource']);
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function searchForm() {
        if(!es_registrado()) {
            $sim_service = new Simulacrum_Service();
            $feedback = $sim_service->simulacrumForm();
            if($feedback['ok']) {
                include_once './View/Simulacrums/Search_Simulacrum_View.php';
                new Search_Simulacrum($feedback['simulacrum'], $feedback['building']);
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }
}
<?php

include_once 'Abstract_Controller.php';

class Simulacrum extends Abstract_Controller {

    function __construct() {
        include './View/Page/Message_View.php';
        include './Service/Simulacrum_Service.php';
    }

    function show() {
        if(!es_registrado()) {
            $sim_service = new Simulacrum_Service();
            $feedback = $sim_service->searchSimulacrum();
            if($feedback['ok']) {
                $this->update_stack_post();
                include_once './View/Simulacrums/Show_Simulacrum_View.php';
                new Show_Simulacrum($feedback['resource'], $feedback['simulacrum'], $feedback['building']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
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
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function add() {
        if(!es_registrado()) {
            $sim_service = new Simulacrum_Service();
            $feedback = $sim_service->addImpSim();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
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
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function delete() {
        if(!es_registrado()) {
            $sim_service = new Simulacrum_Service();
            $feedback = $sim_service->DELETE();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
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
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function expire() {
        if(!es_registrado()) {
            $sim_service = new Simulacrum_Service();
            $feedback = $sim_service->expire();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
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
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function implement() {
        if(!es_registrado()) {
            $sim_service = new Simulacrum_Service();
            $feedback = $sim_service->implement();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
        }
    }

    function showCurrent() {
        if(!es_registrado()) {
            $sim_service = new Simulacrum_Service();
            $feedback = $sim_service->seek();
            if($feedback['ok']) {
                $this->update_stack_post();
                include_once './View/Simulacrums/ShowCurrent_Simulacrum_View.php';
                new ShowCurrent_Simulacrum($feedback['resource']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
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
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }
}
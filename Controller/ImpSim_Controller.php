<?php

include_once 'Abstract_Controller.php';

class ImpSim extends Abstract_Controller {

    function __construct() {
        include './View/Page/Message_View.php';
        include './Service/Simulacrum_Service.php';
    }

    function show() {
        if($this->checkPermission()) {
            $sim_service = new Simulacrum_Service();
            $feedback = $sim_service->searchCompletions();
            if($feedback['ok']) {
                $this->update_stack_post();
                include_once './View/ImpSims/Show_ImpSims_View.php';
                new Show_ImpSims($feedback['resource'], $feedback['simulacrum']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function addForm() {
        if($this->checkPermission()) {
            $sim_service = new Simulacrum_Service();
            $feedback = $sim_service->addImpSimForm();
            if($feedback['ok']) {
                include_once './View/ImpSims/Add_ImpSim_View.php';
                new Add_ImpSim($feedback['resource'], $feedback['simulacrum']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function add() {
        if($this->checkPermission()) {
            $sim_service = new Simulacrum_Service();
            $feedback = $sim_service->addImpSim();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
        }
    }

    function deleteForm() {
        if($this->checkPermission()) {
            $sim_service = new Simulacrum_Service();
            $feedback = $sim_service->seek();
            if($feedback['ok']) {
                include_once './View/ImpSims/Delete_ImpSim_View.php';
                new Delete_ImpSim($feedback['resource']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function delete() {
        if($this->checkPermission()) {
            $sim_service = new Simulacrum_Service();
            $feedback = $sim_service->DELETE();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
        }
    }

    function expireForm() {
        if($this->checkPermission()) {
            $sim_service = new Simulacrum_Service();
            $feedback = $sim_service->seek();
            if($feedback['ok']) {
                include_once './View/ImpSims/Expire_ImpSim_View.php';
                new Expire_ImpSim($feedback['resource']);
            } else {
                new Message($feedback['code']);
            }
        } else{
            new Message('FRB_ACCS');
        }
    }

    function expire() {
        if($this->checkPermission()) {
            $sim_service = new Simulacrum_Service();
            $feedback = $sim_service->expire();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
        }
    }

    function implementForm() {
        if($this->checkPermission()) {
            $sim_service = new Simulacrum_Service();
            $feedback = $sim_service->seek();
            if($feedback['ok']) {
                include_once './View/ImpSims/Implement_ImpSim_View.php';
                new Implement_ImpSim($feedback['resource']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function implement() {
        if($this->checkPermission()) {
            $sim_service = new Simulacrum_Service();
            $feedback = $sim_service->implement();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
        }
    }

    function showCurrent() {
        if($this->checkPermission()) {
            $sim_service = new Simulacrum_Service();
            $feedback = $sim_service->seek();
            if($feedback['ok']) {
                $this->update_stack_post();
                include_once './View/ImpSims/ShowCurrent_ImpSim_View.php';
                new ShowCurrent_ImpSim($feedback['resource']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function searchForm() {
        if($this->checkPermission()) {
            $sim_service = new Simulacrum_Service();
            $feedback = $sim_service->seekSimulacrum();
            if($feedback['ok']) {
                include_once './View/ImpSims/Search_ImpSim_View.php';
                new Search_ImpSim($feedback['resource']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }
}
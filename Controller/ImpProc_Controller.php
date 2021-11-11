<?php

include_once 'Abstract_Controller.php';

class ImpProc extends Abstract_Controller {

    function __construct() {
        include './View/Page/Message_View.php';
        include './Service/Procedure_Service.php';
    }

    function show() {
        if($this->checkPermission()) {
            $proc_service = new Procedure_Service();
            $feedback = $proc_service->searchCompletions();
            if($feedback['ok']) {
                $this->update_stack_post();
                include_once './View/ImpProcs/Show_ImpProcs_View.php';
                new Show_ImpProcs($feedback['resource'], $feedback['procedure']);
            } else if(isset($feedback['procedure'])) {
                new Message($feedback['code'], 'ImpProc', 'show', $feedback['proc']);
            } else {
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function addForm() {
        if($this->checkPermission()) {
            $proc_service = new Procedure_Service();
            $feedback = $proc_service->addImpProcForm();
            if($feedback['ok']) {
                include_once './View/ImpProcs/Add_ImpProc_View.php';
                new Add_ImpProc($feedback['resource'], $feedback['procedure']);
            } else if(isset($feedback['procedure'])) {
                new Message($feedback['code'], 'ImpProc', 'show', $feedback['procedure']);
            } else {
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function add() {
        if($this->checkPermission()) {
            $proc_service = new Procedure_Service();
            $feedback = $proc_service->addImpProc();
            if(isset($feedback['procedure'])) {
                new Message($feedback['code'], 'ImpProc', 'show', $feedback['procedure']);
            } else {
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function deleteForm() {
        if($this->checkPermission()) {
            $proc_service = new Procedure_Service();
            $feedback = $proc_service->seek();
            if($feedback['ok']) {
               include_once './View/ImpProcs/Delete_ImpProc_View.php';
               new Delete_ImpProc($feedback['resource']);
            } else {
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function delete() {
        if($this->checkPermission()) {
            $proc_service = new Procedure_Service();
            $feedback = $proc_service->DELETE();
            if(isset($feedback['return'])) {
                new Message($feedback['code'], 'ImpProc', 'show', array('procedimiento_id' => $feedback['return']['procedimiento_id']));
            } else {
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function expireForm() {
        if($this->checkPermission()) {
            $proc_service = new Procedure_Service();
            $feedback = $proc_service->seek();
            if($feedback['ok']) {
                include_once './View/ImpProcs/Expire_ImpProc_View.php';
                new Expire_ImpProc($feedback['resource']);
            } else {
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function expire() {
        if($this->checkPermission()) {
            $proc_service = new Procedure_Service();
            $feedback = $proc_service->expire();
            if(isset($feedback['return'])) {
                new Message($feedback['code'], 'ImpProc', 'show', array('procedimiento_id' => $feedback['return']['procedimiento_id']));
            } else {
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshbaord');
        }
    }

    function implementForm() {
        if($this->checkPermission()) {
            $proc_service = new Procedure_Service();
            $feedback = $proc_service->seek();
            if($feedback['ok']) {
                include_once './View/ImpProcs/Implement_ImpProc_View.php';
                new Implement_ImpProc($feedback['resource']);
            } else {
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function implement() {
        if($this->checkPermission()) {
            $proc_service = new Procedure_Service();
            $feedback = $proc_service->implement();
            if(isset($feedback['return'])) {
                new Message($feedback['code'], 'ImpProc', 'show', array('procedimiento_id' => $feedback['return']['procedimiento_id']));
            } else {
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function showCurrent() {
        if($this->checkPermission()) {
            $proc_service = new Procedure_Service();
            $feedback = $proc_service->seek();
            if($feedback['ok']) {
                $this->update_stack_post();
                include_once './View/ImpProcs/ShowCurrent_ImpProc_View.php';
                new ShowCurrent_ImpProc($feedback['resource']);
            } else {
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function searchForm() {
        if($this->checkPermission()) {
            $proc_service = new Procedure_Service();
            $feedback = $proc_service->seekProcedure();
            if($feedback['ok']) {
                include_once './View/ImpProcs/Search_ImpProc_View.php';
                new Search_ImpProc($feedback['resource']);
            } else {
                new Message($feedback['code'], 'DefPlan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }
}
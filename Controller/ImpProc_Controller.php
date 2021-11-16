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
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function addForm() {
        if($this->checkPermission()) {
            $proc_service = new Procedure_Service();
            $feedback = $proc_service->addImpProcForm();
            if($feedback['ok']) {
                include_once './View/ImpProcs/Add_ImpProc_View.php';
                new Add_ImpProc($feedback['resource'], $feedback['procedure']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function add() {
        if($this->checkPermission()) {
            $proc_service = new Procedure_Service();
            $feedback = $proc_service->addImpProc();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
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
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function delete() {
        if($this->checkPermission()) {
            $proc_service = new Procedure_Service();
            $feedback = $proc_service->DELETE();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
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
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function expire() {
        if($this->checkPermission()) {
            $proc_service = new Procedure_Service();
            $feedback = $proc_service->expire();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
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
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function implement() {
        if($this->checkPermission()) {
            $proc_service = new Procedure_Service();
            $feedback = $proc_service->implement();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
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
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
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
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }
}
<?php

include_once 'Abstract_Controller.php';

class Procedure extends Abstract_Controller {

    function __construct() {
        include './View/Page/Message_View.php';
        include './Service/Procedure_Service.php';
    }

    function show() {
        if(!es_registrado()) {
            $proc_service = new Procedure_Service();
            $feedback = $proc_service->searchProcedure();
            if($feedback['ok']) {
                $this->update_stack_post();
                include_once './View/Procedures/Show_Procedure_View.php';
                new Show_Procedure($feedback['resource'], $feedback['procedure'], $feedback['building']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function addForm() {
        if(!es_registrado()) {
            $proc_service = new Procedure_Service();
            $feedback = $proc_service->procedureForm();
            if($feedback['ok']) {
                include_once './View/Procedures/Add_Procedure_View.php';
                new Add_Procedure($feedback['procedure'], $feedback['building']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function add() {
        if(!es_registrado()) {
            $proc_service = new Procedure_Service();
            $feedback = $proc_service->addImpProc();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
        }
    }

    function deleteForm() {
        if(!es_registrado()) {
            $proc_service = new Procedure_Service();
            $feedback = $proc_service->seek();
            if($feedback['ok']) {
                include_once './View/Procedures/Delete_Procedure_View.php';
                new Delete_Procedure($feedback['resource']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function delete() {
        if(!es_registrado()) {
            $proc_service = new Procedure_Service();
            $feedback = $proc_service->DELETE();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
        }
    }

    function expireForm() {
        if(!es_registrado()) {
            $proc_service = new Procedure_Service();
            $feedback = $proc_service->seek();
            if($feedback['ok']) {
                include_once './View/Procedures/Expire_Procedure_View.php';
                new Expire_Procedure($feedback['resource']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function expire() {
        if(!es_registrado()) {
            $proc_service = new Procedure_Service();
            $feedback = $proc_service->expire();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
        }
    }

    function implementForm() {
        if(!es_registrado()) {
            $proc_service = new Procedure_Service();
            $feedback = $proc_service->seek();
            if($feedback['ok']) {
                include_once './View/Procedures/Implement_Procedure_View.php';
                new Implement_Procedure($feedback['resource']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function implement() {
        if(!es_registrado()) {
            $proc_service = new Procedure_Service();
            $feedback = $proc_service->implement();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
        }
    }

    function showCurrent() {
        if(!es_registrado()) {
            $proc_service = new Procedure_Service();
            $feedback = $proc_service->seek();
            if($feedback['ok']) {
                $this->update_stack_post();
                include_once './View/Procedures/ShowCurrent_Procedure_View.php';
                new ShowCurrent_Procedure($feedback['resource']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function searchForm() {
        if(!es_registrado()) {
            $proc_service = new Procedure_Service();
            $feedback = $proc_service->procedureForm();
            if($feedback['ok']) {
                include_once './View/Procedures/Search_Procedure_View.php';
                new Search_Procedure($feedback['procedure'], $feedback['building']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }
}
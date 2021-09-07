<?php

class Procedure {

    function __construct() {
        include './View/Page/Message_View.php';
        include './Service/Procedure_Service.php';
    }

    function show() {
        if(!es_registrado()) {
            $proc_service = new Procedure_Service();
            $feedback = $proc_service->searchProcedure();
            if($feedback['ok']) {
                include_once './View/Procedures/Show_Procedure_View.php';
                new Show_Procedure($feedback['resource'], $feedback['procedure'], $feedback['building']);
            } else if(isset($feedback['return'])) {
                new Message($feedback['code'], 'Procedure', 'show', $feedback['return']);
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function addForm() {
        if(!es_registrado()) {
            $proc_service = new Procedure_Service();
            $feedback = $proc_service->addProcedureForm();
            if($feedback['ok']) {
                include_once './View/Procedures/Add_Procedure_View.php';
                new Add_Procedure($feedback['procedure'], $feedback['building']);
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function add() {
        if(!es_registrado()) {
            $proc_service = new Procedure_Service();
            $feedback = $proc_service->addImpProc();
            if(isset($feedback['procedure']) && isset($feedback['building'])) {
                new Message($feedback['code'], 'Procedure', 'show', array('procedimiento_id' => $feedback['procedure']['procedimiento_id'],
                                                                                            'edificio_id' => $feedback['building']['edificio_id']));
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
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
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function delete() {
        if(!es_registrado()) {
            $proc_service = new Procedure_Service();
            $feedback = $proc_service->DELETE();
            if(isset($feedback['return'])) {
                new Message($feedback['code'], 'ImpProc', 'show', $feedback['return']);
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }
}
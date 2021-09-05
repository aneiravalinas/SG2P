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
}
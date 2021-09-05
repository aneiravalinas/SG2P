<?php

class ImpProc {

    function __construct() {
        include './View/Page/Message_View.php';
        include './Service/Procedure_Service.php';
    }

    function checkPermission() {
        return (es_resp_organizacion() || es_admin());
    }

    function show() {
        if($this->checkPermission()) {
            $proc_service = new Procedure_Service();
            $feedback = $proc_service->searchImpProcs();
            if($feedback['ok']) {
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
}
<?php

class Formation {

    function __construct() {
        include './Service/Formation_Service.php';
        include './View/Page/Message_View.php';
    }

    function show() {
        if(!es_registrado()) {
            $format_service = new Formation_Service();
            $feedback = $format_service->searchFormation();
            if($feedback['ok']) {
                include_once './View/Formations/Show_Formation_View.php';
                new Show_Formation($feedback['resource'], $feedback['formation'], $feedback['building']);
            } else if(isset($feedback['return'])) {
                new Message($feedback['code'], 'Formation', 'show', $feedback['return']);
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function addForm() {
        if(!es_registrado()) {
            $format_service = new Formation_Service();
            $feedback = $format_service->addFormationForm();
            if($feedback['ok']) {
                include_once './View/Formations/Add_Formation_View.php';
                new Add_Formation($feedback['formation'], $feedback['building']);
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function add() {
        if(!es_registrado()) {
            $format_service = new Formation_Service();
            $feedback = $format_service->addImpFormat();
            if(isset($feedback['formation']) && isset($feedback['building'])) {
                new Message($feedback['code'], 'Formation', 'show', array('formacion_id' => $feedback['formation']['formacion_id'],
                                                                                            'edificio_id' => $feedback['building']['edificio_id']));
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }
}
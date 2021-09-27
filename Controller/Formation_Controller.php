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

    function deleteForm() {
        if(!es_registrado()) {
            $format_service = new Formation_Service();
            $feedback = $format_service->seek();
            if($feedback['ok']) {
                include_once './View/Formations/Delete_Formation_View.php';
                new Delete_Formation($feedback['resource']);
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function delete() {
        if(!es_registrado()) {
            $format_service = new Formation_Service();
            $feedback = $format_service->DELETE();
            if(isset($feedback['return'])) {
                new Message($feedback['code'], 'Formation', 'show', $feedback['return']);
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function expireForm() {
        if(!es_registrado()) {
            $format_service = new Formation_Service();
            $feedback = $format_service->seek();
            if($feedback['ok']) {
                include_once './View/Formations/Expire_Formation_View.php';
                new Expire_Formation($feedback['resource']);
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function expire() {
        if(!es_registrado()) {
            $format_service = new Formation_Service();
            $feedback = $format_service->expire();
            if(isset($feedback['return'])) {
                new Message($feedback['code'], 'Formation', 'show', $feedback['return']);
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function implementForm() {
        if(!es_registrado()) {
            $format_service = new Formation_Service();
            $feedback = $format_service->seek();
            if($feedback['ok']) {
                include_once './View/Formations/Implement_Formation_View.php';
                new Implement_Formation($feedback['resource']);
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function implement() {
        if(!es_registrado()) {
            $format_service = new Formation_Service();
            $feedback = $format_service->implement();
            if(isset($feedback['return'])) {
                new Message($feedback['code'], 'Formation', 'show', $feedback['return']);
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function showCurrent() {
        if(!es_registrado()) {
            $format_service = new Formation_Service();
            $feedback = $format_service->seek();
            if($feedback['ok']) {
                include_once './View/Formations/ShowCurrent_Formation_View.php';
                new ShowCurrent_Formation($feedback['resource']);
            } else {
                new Message($feedback['code'], 'Plan', 'show');
            }
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }
}
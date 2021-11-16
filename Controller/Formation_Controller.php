<?php

include_once 'Abstract_Controller.php';

class Formation extends Abstract_Controller {

    function __construct() {
        include './Service/Formation_Service.php';
        include './View/Page/Message_View.php';
    }

    function show() {
        if(!es_registrado()) {
            $format_service = new Formation_Service();
            $feedback = $format_service->searchFormation();
            if($feedback['ok']) {
                $this->update_stack_post();
                include_once './View/Formations/Show_Formation_View.php';
                new Show_Formation($feedback['resource'], $feedback['formation'], $feedback['building']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function addForm() {
        if(!es_registrado()) {
            $format_service = new Formation_Service();
            $feedback = $format_service->formationForm();
            if($feedback['ok']) {
                include_once './View/Formations/Add_Formation_View.php';
                new Add_Formation($feedback['formation'], $feedback['building']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function add() {
        if(!es_registrado()) {
            $format_service = new Formation_Service();
            $feedback = $format_service->addImpFormat();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
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
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function delete() {
        if(!es_registrado()) {
            $format_service = new Formation_Service();
            $feedback = $format_service->DELETE();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
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
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function expire() {
        if(!es_registrado()) {
            $format_service = new Formation_Service();
            $feedback = $format_service->expire();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
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
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function implement() {
        if(!es_registrado()) {
            $format_service = new Formation_Service();
            $feedback = $format_service->implement();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
        }
    }

    function showCurrent() {
        if(!es_registrado()) {
            $format_service = new Formation_Service();
            $feedback = $format_service->seek();
            if($feedback['ok']) {
                $this->update_stack_post();
                include_once './View/Formations/ShowCurrent_Formation_View.php';
                new ShowCurrent_Formation($feedback['resource']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function searchForm() {
        if(!es_registrado()) {
            $format_service = new Formation_Service();
            $feedback = $format_service->formationForm();
            if($feedback['ok']) {
                include_once './View/Formations/Search_Formation_View.php';
                new Search_Formation($feedback['formation'], $feedback['building']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }
}
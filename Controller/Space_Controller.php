<?php

include_once 'Abstract_Controller.php';

class Space extends Abstract_Controller {

    function __construct() {
        include './View/Page/Message_View.php';
        include './Service/Space_Service.php';
    }

    function show() {
        if(!es_registrado()) {
            $space_service = new Space_Service();
            $feedback = $space_service->SEARCH();
            if($feedback['ok']) {
                $this->update_stack_post();
                include_once './View/Spaces/Show_Spaces_View.php';
                new Show_Spaces($feedback['resource'], $feedback['floor']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function addForm() {
        if($this->checkPermission()) {
            $space_service = new Space_Service();
            $feedback = $space_service->emptyForm();
            if($feedback['ok']) {
                include './View/Spaces/Add_Space_View.php';
                new Add_Space($feedback['resource']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function add() {
        if($this->checkPermission()) {
            $space_service = new Space_Service();
            $feedback = $space_service->ADD();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
        }
    }

    function deleteForm() {
        if($this->checkPermission()) {
            $space_service = new Space_Service();
            $feedback = $space_service->dataForm();
            if($feedback['ok']) {
                include_once './View/Spaces/Delete_Space_View.php';
                new Delete_Space($feedback['resource'], $feedback['floor']);
            } else {
                new Message('FRB_ACCS');
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function delete() {
        if($this->checkPermission()) {
            $space_service = new Space_Service();
            $feedback = $space_service->DELETE();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
        }
    }

    function showCurrent() {
        if(!es_registrado()) {
            $space_service = new Space_Service();
            $feedback = $space_service->seek();
            if($feedback['ok']) {
                $this->update_stack_post();
                include_once './View/Spaces/ShowCurrent_Space_View.php';
                new ShowCurrent_Space($feedback['resource'], $feedback['floor']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function searchForm() {
        if(!es_registrado()) {
            $space_service = new Space_Service();
            $feedback = $space_service->emptyForm();
            if($feedback['ok']) {
                include_once './View/Spaces/Search_Space_View.php';
                new Search_Space($feedback['resource']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function editForm() {
        if($this->checkPermission()) {
            $space_service = new Space_Service();
            $feedback = $space_service->dataForm();
            if($feedback['ok']) {
                include_once './View/Spaces/Edit_Space_View.php';
                new Edit_Space($feedback['resource'], $feedback['floor']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function edit() {
        if($this->checkPermission()) {
            $space_service = new Space_Service();
            $feedback = $space_service->EDIT();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
        }
    }
}
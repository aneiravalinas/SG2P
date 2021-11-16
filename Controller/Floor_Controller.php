<?php

include_once 'Abstract_Controller.php';

class Floor extends Abstract_Controller {

    function __construct() {
        include './View/Page/Message_View.php';
        include './Service/Floor_Service.php';
    }

    function show() {
        if(!es_registrado()) {
            $floor_service = new Floor_Service();
            $feedback = $floor_service->SEARCH();
            if($feedback['ok']) {
                $this->update_stack_post();
                include_once './View/Floors/Show_Floors_View.php';
                new Show_Floors($feedback['resource'], $feedback['building']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function addForm() {
        if($this->checkPermission()) {
            $floor_service = new Floor_Service();
            $feedback = $floor_service->emptyForm();
            if($feedback['ok']) {
                include_once './View/Floors/Add_Floor_View.php';
                new Add_Floor($feedback['building']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function add() {
        if($this->checkPermission()) {
            $floor_service = new Floor_Service();
            $feedback = $floor_service->ADD();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
        }
    }

    function showCurrent() {
        if(!es_registrado()) {
            $floor_service = new Floor_Service();
            $feedback = $floor_service->seek();
            if($feedback['ok']) {
                $this->update_stack_post();
                include_once './View/Floors/ShowCurrent_Floor_View.php';
                new ShowCurrent_Floor($feedback['resource'], $feedback['building']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function deleteForm() {
        if($this->checkPermission()) {
            $floor_service = new Floor_Service();
            $feedback = $floor_service->dataForm();
            if($feedback['ok']) {
                include_once './View/Floors/Delete_Floor_View.php';
                new Delete_Floor($feedback['resource'],$feedback['building']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function delete() {
        if($this->checkPermission()) {
            $floor_service = new Floor_Service();
            $feedback = $floor_service->DELETE();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
        }
    }

    function searchForm() {
        if(!es_registrado()) {
            $floor_service = new Floor_Service();
            $feedback = $floor_service->emptyForm();
            if($feedback['ok']) {
                include_once './View/Floors/Search_Floor_View.php';
                new Search_Floor($feedback['building']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function editForm() {
        if($this->checkPermission()) {
            $floor_service = new Floor_Service();
            $feedback = $floor_service->dataForm();
            if($feedback['ok']) {
                include_once './View/Floors/Edit_Floor_View.php';
                new Edit_Floor($feedback['resource'],$feedback['building']);
            } else {
                new Message($feedback['code']);
            }
        } else {
            new Message('FRB_ACCS');
        }
    }

    function edit() {
        if($this->checkPermission()) {
            $floor_service = new Floor_Service();
            $feedback = $floor_service->EDIT();
            new Message($feedback['code']);
        } else {
            new Message('FRB_ACCS');
        }
    }

}
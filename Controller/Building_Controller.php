<?php

include_once 'Abstract_Controller.php';

class Building extends Abstract_Controller {

    function __construct() {
        include './View/Page/Message_View.php';
        include './Service/Building_Service.php';
    }

    function show() {
        if(!es_registrado()) {
            $building_service = new Building_Service();
            $feedback = $building_service->SEARCH();
            if($feedback['ok']) {
                $this->update_stack_post();
                include_once './View/Buildings/Show_Buildings_View.php';
                new Show_Buildings($feedback['resource']);
            } else {
                new Message($feedback['code'],'Panel','deshboard');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function addForm() {
        if($this->checkPermission()) {
            $building_service = new Building_Service();
            $feedback = $building_service->addForm();
            if($feedback['ok']) {
                include_once './View/Buildings/Add_Building_View.php';
                new Add_Building($feedback['resource']);
            } else {
                new Message($feedback['code'],'Building','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function add() {
        if($this->checkPermission()) {
            $building_service = new Building_Service();
            $feedback = $building_service->ADD();
            new Message($feedback['code'],'Building','show');
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function deleteForm() {
        if($this->checkPermission()) {
            $building_service = new Building_Service();
            $feedback = $building_service->deleteForm();
            if($feedback['ok']) {
                include './View/Buildings/Delete_Building_View.php';
                new Delete_Building($feedback['resource']);
            } else {
                new Message($feedback['code'],'Building','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function delete() {
        if($this->checkPermission()) {
            $building_service = new Building_Service();
            $feedback = $building_service->DELETE();
            new Message($feedback['code'],'Building','show');
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function editForm() {
        if($this->checkPermission()) {
            $building_service = new Building_Service();
            $feedback = $building_service->editForm();
            if($feedback['ok']) {
                include_once './View/Buildings/Edit_Building_View.php';
                new Edit_Building($feedback['resource']['building'], $feedback['resource']['candidates']);
            } else {
                new Message($feedback['code'],'Building','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function edit() {
        if($this->checkPermission()) {
            $building_service = new Building_Service();
            $feedback = $building_service->EDIT();
            new Message($feedback['code'],'Building','show');
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function searchForm() {
        if(!es_registrado()) {
            $building_service = new Building_Service();
            $feedback = $building_service->searchForm();
            if($feedback['ok']) {
                include_once './View/Buildings/Search_Building_View.php';
                new Search_Building($feedback['resource']);
            } else {
                new Message($feedback['code'],'Building','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function search() {
        if(!es_registrado()) {
            $building_service = new Building_Service();
            $feedback = $building_service->SEARCH();
            if($feedback['ok']) {
                include_once './View/Buildings/Show_Buildings_View.php';
                new Show_Buildings($feedback['resource']);
            } else {
                new Message($feedback['code'],'Building','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function showCurrent() {
        if(!es_registrado()) {
            $building_service = new Building_Service();
            $feedback = $building_service->seek();
            if($feedback['ok']) {
                $this->update_stack_post();
                include_once './View/Buildings/ShowCurrent_Building_View.php';
                new ShowCurrent_Building($feedback['resource']);
            } else {
                new Message($feedback['code'],'Building','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }
}
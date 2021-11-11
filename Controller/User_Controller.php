<?php

include_once 'Abstract_Controller.php';

class User extends Abstract_Controller {

    function __construct() {
        include './View/Page/Message_View.php';
        include './Service/User_Service.php';
    }

    function show() {
        $user_service = new User_Service();
        $feedback = $user_service->SEARCH();
        if($feedback['ok']) {
            $this->update_stack_post();
            include './View/Users/Show_Users_View.php';
            new Show_Users($feedback['resource']);
        } else {
            new Message($feedback['code'],'Panel','deshboard');
        }

    }

    function searchForm() {
        include_once './View/Users/Search_User_View.php';
        new Search_User();
    }

    function addForm() {
        if(es_admin()) {
            include_once './View/Users/Add_User_View.php';
            new Add_User();
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function add() {
        if(es_admin()) {
            $user_service = new User_Service();
            $feedback = $user_service->ADD();
            new Message($feedback['code'],'User','show');
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function deleteForm() {
        if(es_admin()) {
            $user_service = new User_Service();
            $feedback = $user_service->seek();
            if($feedback['ok']) {
                include_once './View/Users/Delete_User_View.php';
                new Delete_User($feedback['resource']);
            } else {
                new Message($feedback['code'],'User','show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function delete() {
        if(es_admin()) {
            $user_service = new User_Service();
            $feedback = $user_service->DELETE();
            new Message($feedback['code'], 'User','show');
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function editForm() {
        if(es_admin()) {
            $user_service = new User_Service();
            $feedback = $user_service->seek();
            if ($feedback['ok']) {
                include './View/Users/Edit_User_View.php';
                new Edit_User($feedback['resource']);
            } else {
                new Message($feedback['code'], 'User', 'show');
            }
        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

    function edit() {
        if(es_admin()) {
            $user_service = new User_Service();
            $feedback = $user_service->EDIT();
            new Message($feedback['code'],'User','show');
        } else {
            new Message('FRB_ACCS', 'Panel', 'deshboard');
        }
    }

    function profileForm() {
        $user_service = new User_Service();
        $feedback = $user_service->seek();
        if($feedback['ok']) {
            $this->update_stack_post();
            include './View/Users/Profile_View.php';
            new Profile($feedback['resource']);
        } else {
            new Message($feedback['code'], 'Panel', 'deshboard');
        }
    }

    function editProfile() {
        $user_service = new User_Service();
        $feedback = $user_service->editProfile();
        new Message($feedback['code'], 'Panel', 'deshboard');
    }

    function showCurrent() {
        $user_service = new User_Service();
        $feedback = $user_service->seek();
        if($feedback['ok']) {
            $this->update_stack_post();
            include './View/Users/ShowCurrent_User_View.php';
            new ShowCurrent_User($feedback['resource']);
        } else {
            new Message($feedback['code'],'User','show');
        }
    }

}
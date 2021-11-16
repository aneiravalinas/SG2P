<?php

include_once 'Abstract_Controller.php';

class Login extends Abstract_Controller {

    function __construct() {
        include './Service/User_Service.php';
        include './View/Page/Message_View.php';
        include './View/Login/Login_View.php';
    }

    function loginForm() {
        $this->update_stack_post();
        new Login_View();
    }

    function login()
    {
        $user_service = new User_Service();
        $feedback = $user_service->login();

        if($feedback['ok']) {
            header('location: .');
        } else {
            new Message($feedback['code']);
        }
    }

    function logout()
    {
        session_destroy();
        header('location: .');
    }
}

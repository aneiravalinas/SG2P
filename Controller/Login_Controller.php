<?php

class Login {

    function __construct() {
        include './Service/Usuario_Service.php';
        include './View/Page/Message_View.php';
        include './View/Login/Login_View.php';
    }

    function loginForm() {
        new Login_View();
    }

    function login()
    {
        $user_service = new Usuario_Service();
        $feedback = $user_service->login();

        if($feedback['ok']) {
            header('location: .');
        } else {
            new Message($feedback['code'],'Login','loginForm');
        }
    }

    function logout()
    {
        session_destroy();
        header('location: .');
    }
}

?>
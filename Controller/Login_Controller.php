<?php

class Login {

    function __construct() {
        null;
    }

    function loginForm() {
        include './View/Login/Login_View.php';
        new Login_View();
    }
}

?>
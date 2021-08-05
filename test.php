<?php

include './COMMON/Auth.php';

    session_start();
    $_SESSION['test'] = true;

    include_once './Controller/Test_Controller.php';

    $controller = new Test();
    $controller->test();

    unset($_SESSION['test']);
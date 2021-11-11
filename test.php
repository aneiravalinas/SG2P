<?php

include './COMMON/Auth.php';

if(isset($_SESSION)) {
    session_destroy();
}
    session_start();
    $_SESSION['test'] = true;

    if(!defined('plans_path')) {
        define('plans_path','./Uploads/Test/');
    }

    include './Controller/Test_Controller.php';

    $controller = new Test();
    $controller->test();
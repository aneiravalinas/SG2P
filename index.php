<?php

include './COMMON/Auth.php';

if(!isset($_SESSION)) {
    session_start();
}
$_SESSION['test'] = false;

if (isAuthenticated()) {
	$requested_controller = isset($_REQUEST['controller']) ? $_REQUEST['controller'] : 'Portal';
	$requested_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '_default';
	include './Controller/'.$requested_controller.'_Controller.php';
	$current_controller = new $requested_controller;
	$current_controller->$requested_action();
} else {
    if (!$_POST) {
        include_once './Controller/Portal_Controller.php';
        $portal = new Portal();
        $portal->_default();
    } else {
        if($_POST['controller'] === 'Login') {
            if($_REQUEST['action'] === 'loginForm') {
                include_once './Controller/Login_Controller.php';
                $login = new Login();
                $login->loginForm();
            }
        }
    }
}

?>
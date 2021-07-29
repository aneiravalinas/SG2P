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
            include_once './Controller/Login_Controller.php';
            if($_REQUEST['action'] === 'loginForm') {
                $login = new Login();
                $login->loginForm();
            } else if($_REQUEST['action'] === 'login') {
                $login = new Login();
                $login->login();
            }
        } else if($_POST['controller'] === 'Portal') {
            include_once './Controller/Portal_Controller.php';
            $requested_action = isset($_POST['action']) ? $_POST['action'] : '_default';
            $portal = new Portal();
            $portal->$requested_action();
        } else {
            include_once './Controller/Portal_Controller.php';
            $portal = new Portal();
            $portal->_default();
        }
    }
}

?>
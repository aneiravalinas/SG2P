<?php

abstract class Abstract_Controller {

    function __construct() {
    }

    function update_stack_post() {
        if(!$_POST || ($_POST['controller'] == 'Portal' && $_POST['action'] == '_default')) {
            $_SESSION['stack_post'] = array();
            array_push($_SESSION['stack_post'], array('controller' => 'Portal', 'action' => '_default'));
        } else if(isset($_SESSION['stack_post']['go_back'])) {
            array_pop($_SESSION['stack_post']);
        } else {
            if(!empty($_SESSION['stack_post'])) {
                $last_post = end($_SESSION['stack_post']);
                if($last_post['controller'] == $_POST['controller'] && $last_post['action'] == $_POST['action']) {
                    array_pop($_SESSION['stack_post']);
                }
            }

            array_push($_SESSION['stack_post'], $_POST);
        }
    }
}
<?php

function getCurrentShow() {
    if(!empty($_SESSION['stack_post'])) {
        return end($_SESSION['stack_post']);
    } else {
        return array('controller' => 'Portal', 'action' => '_default');
    }
}

function getPreviousShow() {
    if(!empty($_SESSION['stack_post']) && isset($_SESSION['stack_post'][count($_SESSION) - 2])) {
        return $_SESSION['stack_post'][count($_SESSION) - 2];
    } else {
        return array('controller' => 'Portal', 'action' => '_default');
    }
}
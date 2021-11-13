<?php

function getCurrentShow() {
    if(isset($_SESSION['stack_post']) && !empty($_SESSION['stack_post'])) {
        return end($_SESSION['stack_post']);
    } else {
        return array('controller' => 'Portal', 'action' => '_default');
    }
}

function getPreviousShow() {
    if(isset($_SESSION['stack_post'][count($_SESSION['stack_post']) - 2])) {
        return $_SESSION['stack_post'][count($_SESSION['stack_post']) - 2];
    } else {
        return array('controller' => 'Portal', 'action' => '_default');
    }
}
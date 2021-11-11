<?php

include_once 'Abstract_Controller.php';

class Panel extends Abstract_Controller {

    function __construct() {
    }

    function deshboard() {
        $this->update_stack_post();
        include './View/Deshboard/Deshboard_View.php';
        new Deshboard();
    }
}
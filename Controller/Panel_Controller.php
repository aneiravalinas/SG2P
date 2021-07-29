<?php

class Panel {

    function __construct() {

    }

    function deshboard() {
        include './View/Deshboard/Deshboard_View.php';
        new Deshboard();
    }
}
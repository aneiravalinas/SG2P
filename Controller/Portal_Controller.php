<?php

class Portal {

    function __construct() {
        null;
    }

    function _default() {
        include './View/Portal/Portal_Countries_View.php';
        new Portal_Countries();
    }
}


?>

<?php

class BuildPlan_Controller {

    function __construct() {
        include './View/Page/Message_View.php';
        include './Service/Building_Service.php';
    }

    function checkPermission() {
        return (es_resp_organizacion() || es_admin());
    }

    function show() {
        if($this->checkPermission()) {

        } else {
            new Message('FRB_ACCS','Panel','deshboard');
        }
    }

}
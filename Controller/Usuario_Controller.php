<?php

class Usuario {

    function __construct() {
        include './View/Page/Message_View.php';
        include './Service/Usuario_Service.php';
    }

    function show() {
        $user_service = new Usuario_Service();
        $feedback = $user_service->SEARCH();
        if($feedback['ok']) {
            include './View/Users/Show_Users_View.php';
            new Show_Users($feedback['resource']);
        } else {
            new Message($feedback['code'],'Portal','deshboard');
        }

    }

    function searchForm() {
        include_once './View/Users/Search_User_View.php';
        new Search_User();
    }

    function addForm() {
        if(es_admin()) {
            include_once './View/Users/Add_User_View.php';
            new Add_User();
        } else {
            new Message('00006','Portal','deshboard');
        }
    }

    function add() {
        $path = $_FILES['foto_perfil']['name'];
        $ext = pathinfo($path)['extension'];
        var_dump($ext);
        end();
        if(es_admin()) {
            $user_service = new Usuario_Service();
            $feedback = $user_service->ADD();
            new Message($feedback['code'],'Usuario','show');
        } else {
            new Message('00006','Portal','deshboard');
        }
    }

}
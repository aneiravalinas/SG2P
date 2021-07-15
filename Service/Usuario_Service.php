<?php

include_once './Model/Usuario_Model.php';

class Usuario_Service {
    var $atributos;
    var $dni;
    var $username;
    var $password;
    var $rol;
    var $nombre;
    var $apellidos;
    var $email;
    var $telefono;
    var $foto_perfil;

    var $user_entity;

    function __construct() {
        $this->user_entity = new Usuario_Model();
        $this->atributos = array('dni','username','password','rol','nombre','apellidos','email','telefono','foto_perfil');
        $this->fill_fields();
    }

    function fill_fields()
    {
        foreach ($this->atributos as $atributo) {
            if(isset($_POST[$atributo])) {
                $this->$atributo = $_POST[$atributo];
            } else {
                $this->$atributo = '';
            }
        }
    }

    function login()
    {

    }
}

?>

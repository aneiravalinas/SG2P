<?php

include_once './Model/Usuario_Model.php';
include_once './Validation/Usuario_Validation.php';

class Usuario_Service extends Usuario_Validation {
    var $atributos;
//    var $dni;
//    var $username;
//    var $password;
//    var $rol;
//    var $nombre;
//    var $apellidos;
//    var $email;
//    var $telefono;
//    var $foto_perfil;

    var $user_entity;
    var $feedback = array();

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
        // Pendiente de Validaciones

        if($this->user_exist()) {
            $user = $this->user_entity->get_result();
            if($this->password === $user['password']) {
                if(!isset($_SESSION)) {
                    session_start();
                }
                $_SESSION['dni'] = $user['dni'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['rol'] = $user['rol'];

                $this->feedback['ok'] = true;
                $this->feedback['code'] = '01001'; // Se ha iniciado sesión correctamente.
            } else {
                $this->feedback['ok'] = false;
                $this->feedback['code'] = '01102'; // Las credenciales introducias no son válidas.
            }
        }

        return $this->feedback;
    }

    function user_exist()
    {
        $this->feedback = $this->seekByUsername();
        return $this->feedback['code'] == '01000';
    }

    function seekByUsername()
    {
        $this->feedback = $this->user_entity->seek();

        if($this->feedback['ok']) {
            if($this->feedback['code'] == '00002') {
                $this->feedback['ok'] = false;
                $this->feedback['code'] = '01100'; // El nombre de usuario introducido no existe.
            } else {
                $this->feedback['code'] = '01000'; // El nombre de usuario existe.
            }
        } else if($this->feedback['code'] == '00102') {
            $this->feedback['code'] = '01101'; // Error al consultar por nombre de usuario
        }

        return $this->feedback;
    }
}

?>

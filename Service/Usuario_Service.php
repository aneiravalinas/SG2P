<?php

include_once './Model/Usuario_Model.php';
include_once './Validation/Usuario_Validation.php';

class Usuario_Service extends Usuario_Validation {
    var $atributos;
    var $user_entity;
    var $feedback = array();

    function __construct() {
        $this->user_entity = new Usuario_Model();
        $this->atributos = array('dni','username','password','rol','nombre','apellidos','email','telefono','foto_perfil');
        $this->fill_fields();
    }

    function fill_fields() {
        foreach ($this->atributos as $atributo) {
            if(isset($_POST[$atributo])) {
                $this->$atributo = $_POST[$atributo];
            } else {
                $this->$atributo = '';
            }
        }
    }

    function login() {

        $validation = $this->validar_atributos_login();
        if(!$validation['ok']) {
            return $validation;
        }

        if($this->user_exist()) {
            $user = $this->feedback['resource'];
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

    function SEARCH() {

        $validation = $this->validar_atributos_search();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->user_entity->SEARCH();

        if($this->feedback['ok']) {
            $this->feedback['code'] = '01002'; // Búsqueda de Usuarios Ok
            return $this->feedback;
        } else if($this->feedback['code'] == '00005') {
            $this->feedback['code'] = '01109'; // Error en la consulta de Usuarios.
        }

        return $this->feedback;

    }

    function user_exist() {
        $this->feedback = $this->seekByUsername();
        return $this->feedback['code'] == '01000'; // El nombre de usuario existe
    }

    function seekByUsername() {
        $this->feedback = $this->user_entity->seek();

        if($this->feedback['ok']) {
            if($this->feedback['code'] == '00002') {
                $this->feedback['ok'] = false;
                $this->feedback['code'] = '01100'; // El nombre de usuario introducido no existe.
            } else {
                $this->feedback['code'] = '01000'; // El nombre de usuario existe.
            }
        } else if($this->feedback['code'] == '00005') {
            $this->feedback['code'] = '01101'; // Error al consultar por nombre de usuario
        }

        return $this->feedback;
    }
}

?>

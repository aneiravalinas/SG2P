<?php

include_once 'Validator.php';

class Usuario_Validation extends Validator {

    var $dni;
    var $username;
    var $password;
    var $rol;
    var $nombre;
    var $apellidos;
    var $email;
    var $telefono;
    var $foto_perfil;

    function __construct() {
    }

    function validar_atributos_login() {
        $validacion = $this->validar_USERNAME();
        if(!$validacion['ok']) {
            return $validacion;
        }

        return $this->validar_PASSWORD();
    }

    function validar_USERNAME() {
        if(!$this->longitud_minima($this->username,3)) {
            return $this->rellena_validation(false,'01102','USUARIO');
        }

        if(!$this->longitud_maxima($this->username,20)) {
            return $this->rellena_validation(false,'01103','USUARIO');
        }

        if(!$this->es_alfanumerico($this->username)) {
            return $this->rellena_validation(false,'01104','USUARIO');
        }

        return $this->rellena_validation(true,'00000','USUARIO');
    }

    function validar_PASSWORD() {

        if(!$this->longitud_minima($this->password,32)) {
            return $this->rellena_validation(false,'01105','USUARIO');
        }

        if(!$this->longitud_maxima($this->password,32)) {
            return $this->rellena_validation(false,'01106','USUARIO');
        }

        if(!$this->solo_letras_espacios_guiones_todos($this->password)) {
            return $this->rellena_validation(false,'01107','USUARIO');
        }

        return $this->rellena_validation(true,'00000','USUARIO');
    }
}
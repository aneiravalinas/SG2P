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

    function validar_atributos_search() {
        $validacion = array('ok' => true, 'code' => '00000', 'resource' => 'USUARIO');
        if($this->dni !== '') {
            $validacion = $this->validar_DNI();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        if($this->username !== '') {
            $validacion = $this->validar_USERNAME();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        if($this->rol !== '') {
            $validacion = $this->validar_ROL();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        if($this->nombre !== '') {
            $validacion = $this->validar_NOMBRE();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        if($this->apellidos !== '') {
            $validacion = $this->validar_APELLIDOS();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        if($this->email !== '') {
            $validacion = $this->validar_EMAIL();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        if($this->telefono !== '') {
            $validacion = $this->validar_TELEFONO();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        return $validacion;
    }


    function validar_DNI() {
        //TODO: Verificar no vacío, Formato DNI.
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


    function validar_ROL() {
        // TODO: Verificar no vacío. El valor debe ser uno de los contemplados: registrado, edificio, organizacion, adminsitrador.
    }

    function validar_NOMBRE() {
        // TODO: Verificar no vacío, letras espacios y acentos. Tamaño mínimo 3, tamaño máximo 20.
    }

    function validar_APELLIDOS() {
        // TODO: Verificar no vacío, letras espacios y acentos. Tamaño mínimo 3, tamaño máximo 60.
    }

    function validar_EMAIL() {
        // TODO: Verificar no vacío y formato email correcto.
    }

    function validar_TELEFONO() {
        // TODO: Verificar no vacío, sólo dígitos y que empiece por 6,7,8,9 (formato).
    }
}
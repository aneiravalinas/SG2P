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

    function ADD() {

        // TODO: Make some validations here...
        if($this->rol === 'edificio') {
            $this->feedback['ok'] = false;
            $this->feedback['code'] = '01124'; // No se permite la asignación manual del rol Resp. Edificio
            return $this->feedback;
        }

        $this->feedback = $this->uq_attributes_not_exist();
        if($this->feedback['ok']) {
            // TODO: Subir foto de perfil. Si se sube correctamente.
            $this->feedback = $this->user_entity->ADD();
            if($this->feedback['ok']) {
                $this->feedback['code'] = '01006';
                return $this->feedback;
            } else {
                // TODO: Eliminar foto de perfil.
                if($this->feedback['code'] !== '00005') {
                    $this->feedback['code'] = '01131';
                }
            }
        }
    }

    function user_exist() {
        $this->feedback = $this->seekByUsername();
        return $this->feedback['code'] == '01000'; // El nombre de usuario existe
    }

    function uq_attributes_not_exist() {
        $this->feedback = $this->seekByDNI();
        if($this->feedback['ok'] || $this->feedback['code'] !== '01125') { // Si el dni existe o se ha producido un error en la consulta (resultado false distinto a 01125)
            $this->feedback['ok'] = false;
            return $this->feedback;
        }

        $this->feedback = $this->seekByUsername();
        if($this->feedback['ok'] || $this->feedback['code'] !== '01100') { // Si el username existe o se ha producido un error en la consulta (resultado false distinto a 01100)
            $this->feedback['ok'] = false;
            return $this->feedback;
        }

        $this->feedback = $this->seekByEmail();
        if($this->feedback['ok'] || $this->feedback['code'] !== '01127') { // Si el email existe o se ha producido un error en la consulta (resultado false distinto a 01127)
            $this->feedback['ok'] = false;
            return $this->feedback;
        }

        $this->feedback = $this->seekByTelefono();
        if($this->feedback['ok']) { // No hace falta validar el código al devolverse ahora el feedback.
            $this->feedback['ok'] = false;
        }

        return $this->feedback;
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
        } else if($this->feedback['code'] !== '00005') {
            $this->feedback['code'] = '01101'; // Error al consultar por nombre de usuario
        }

        return $this->feedback;
    }

    function seekByDNI() {
        $this->feedback = $this->user_entity->seekByID('dni',$this->dni);
        if($this->feedback['ok']) {
            if($this->feedback['code'] == '00002') {
                $this->feedback['ok'] = false;
                $this->feedback['code'] = '01125'; // El DNI introducido no existe
            } else {
                $this->feedback['code'] = '01003'; // El DNI introducido ya existe
            }
        } else if($this->feedback['code'] !== '00005') {
            $this->feedback['code'] = '01126'; // Error al consultar por DNI
        }

        return $this->feedback;
    }

    function seekByEmail() {
        $this->feedback = $this->user_entity->seekByID('email',$this->email);
        if($this->feedback['ok']) {
            if($this->feedback['code'] == '00002') {
                $this->feedback['ok'] = false;
                $this->feedback['code'] = '01127'; // El email introducido no existe
            } else {
                $this->feedback['code'] = '01004'; // El email introducido ya existe
            }
        } else if($this->feedback['code'] !== '00005') {
            $this->feedback['code'] = '01128'; // Error al consultar por email
        }

        return $this->feedback;
    }

    function seekByTelefono() {
        $this->feedback = $this->user_entity->seekByID('telefono',$this->telefono);
        if($this->feedback['ok']) {
            if($this->feedback['code'] == '00002') {
                $this->feedback['ok'] = false;
                $this->feedback['code'] = '01129'; // El telefono introducido no existe
            } else {
                $this->feedback['code'] = '01005'; // El telefono ya introducido existe
            }
        } else if($this->feedback['code'] !== '00005') {
            $this->feedback['code'] = '01130'; // Error al consultar por telefono
        }

        return $this->feedback;
    }
}

?>

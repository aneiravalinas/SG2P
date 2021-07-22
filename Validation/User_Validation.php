<?php

include_once 'Validator.php';

class User_Validation extends Validator {

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

    function validar_atributos_add() {
        $validacion = $this->validar_DNI();
        if(!$validacion['ok']) {
            return $validacion;
        }

        $validacion = $this->validar_USERNAME();
        if(!$validacion['ok']) {
            return $validacion;
        }

        $validacion = $this->validar_PASSWORD();
        if(!$validacion['ok']) {
            return $validacion;
        }

        $validacion = $this->validar_ROL();
        if(!$validacion['ok']) {
            return $validacion;
        }

        $validacion = $this->validar_NOMBRE();
        if(!$validacion['ok']) {
            return $validacion;
        }

        $validacion = $this->validar_APELLIDOS();
        if(!$validacion['ok']) {
            return $validacion;
        }

        $validacion = $this->validar_EMAIL();
        if(!$validacion['ok']) {
            return $validacion;
        }

        $validacion = $this->validar_TELEFONO();
        if(!$validacion['ok']) {
            return $validacion;
        }

        if($this->foto_perfil !== '') {
            $validacion = $this->validar_FOTO_PERFIL();
        }

        return $validacion;
    }

    function validar_atributos_login() {
        $validacion = $this->validar_USERNAME();
        if(!$validacion['ok']) {
            return $validacion;
        }

        return $this->validar_PASSWORD();
    }

    function validar_atributos_edit() {
        $validacion = $this->validar_DNI();
        if(!$validacion['ok']) {
            return $validacion;
        }

        $validacion = $this->validar_USERNAME();
        if(!$validacion['ok']) {
            return $validacion;
        }

        if($this->password != '') {
            $validacion = $this->validar_PASSWORD();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        $validacion = $this->validar_ROL();
        if(!$validacion['ok']) {
            return $validacion;
        }

        $validacion = $this->validar_NOMBRE();
        if(!$validacion['ok']) {
            return $validacion;
        }

        $validacion = $this->validar_APELLIDOS();
        if(!$validacion['ok']) {
            return $validacion;
        }

        $validacion = $this->validar_EMAIL();
        if(!$validacion['ok']) {
            return $validacion;
        }

        $validacion = $this->validar_TELEFONO();
        if(!$validacion['ok']) {
            return $validacion;
        }

        if($this->foto_perfil !== '') {
            $validacion = $this->validar_FOTO_PERFIL();
        }

        return $validacion;

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
        if(!$this->no_vacio($this->dni)) {
            return $this->rellena_validation(false,'DNI_EMPT', 'USUARIO'); // DNI vacío.
        }

        if(!$this->formato_dni($this->dni)) {
            return $this->rellena_validation(false,'DNI_FRMT','USUARIO'); // Formato de DNI incorrecto.
        }

        return $this->rellena_validation(true,'00000','USUARIO'); // Validación Ok.
    }


    function validar_USERNAME() {
        if(!$this->longitud_minima($this->username,3)) {
            return $this->rellena_validation(false,'USRNM_SHRT','USUARIO'); // Nombre de usuario debe tener más de 3 caracteres.
        }

        if(!$this->longitud_maxima($this->username,20)) {
            return $this->rellena_validation(false,'USRNM_LRG','USUARIO'); // Nombre de usuario debe tener menos de 20 caracteres.
        }

        if(!$this->es_alfanumerico($this->username)) {
            return $this->rellena_validation(false,'USRNM_ALF','USUARIO'); // Nombre de usuario sólo puede contener caracteres alfanuméricos.
        }

        return $this->rellena_validation(true,'00000','USUARIO'); // Validación OK.
    }

    function validar_PASSWORD() {

        if(!$this->longitud_minima($this->password,32)) {
            return $this->rellena_validation(false,'PSW_SHRT','USUARIO'); // Password cifrada no puede contener menos de 32 caracteres.
        }

        if(!$this->longitud_maxima($this->password,32)) {
            return $this->rellena_validation(false,'PSW_LRG','USUARIO'); // Password cifrada no puede contener más de 32 caracteres.
        }

        if(!$this->solo_letras_espacios_guiones_todos($this->password)) {
            return $this->rellena_validation(false,'PSW_FRMT','USUARIO'); // Password cifrada no puede contener caracteres no permitidos.
        }

        return $this->rellena_validation(true,'00000','USUARIO'); // Validación OK.
    }


    function validar_ROL() {
        if(!$this->no_vacio($this->rol)) {
            return $this->rellena_validation(false,'ROL_EMPT','USUARIO'); // Rol no puede ser vacío.
        }

        if(!$this->es_rol($this->rol)) {
            return $this->rellena_validation(false,'ROL_FRMT','USUARIO'); // Rol solo puede contener valores predefinidos (edificio,organizacion,registrado,administrador)
        }

        return $this->rellena_validation(true,'00000','USUARIO'); // Validación OK
    }

    function validar_NOMBRE() {
        if(!$this->longitud_minima($this->nombre,3)) {
            return $this->rellena_validation(false,'NAM_SHRT','USUARIO'); // Nombre debe contener más de 3 caracteres.
        }

        if(!$this->longitud_maxima($this->nombre,30)) {
            return $this->rellena_validation(false,'NAM_LRG','USUARIO'); // Nombre no debe contener más de 30 caracteres.
        }

        if(!$this->solo_letras_espacios($this->nombre)) {
            return $this->rellena_validation(false,'NAM_LT_SPC','USUARIO'); // Nombre sólo puede contener letras y espacios (nombres compuestos)
        }

        return $this->rellena_validation(true,'00000','USUARIO'); // Validación OK
    }

    function validar_APELLIDOS() {
        if(!$this->longitud_minima($this->apellidos,3)) {
            return $this->rellena_validation(false,'SRNM_SHRT','USUARIO'); // Apellidos debe contener al menos 3 caracteres.
        }

        if(!$this->longitud_maxima($this->apellidos,60)) {
            return $this->rellena_validation(false,'SRNM_LRG','USUARIO'); // Apellidos debe contener menos de 60 caracteres
        }

        if(!$this->solo_letras_espacios($this->apellidos)) {
            return $this->rellena_validation(false,'SRNM_LT_SPC','USUARIO'); // Apellidos sólo pueden contener letras y espacios
        }

        return $this->rellena_validation(true,'00000','USUARIO'); // Validación Ok
    }

    function validar_EMAIL() {
        if(!$this->no_vacio($this->email)) {
            return $this->rellena_validation(false,'EML_EMPT','USUARIO'); // Email no puede ser vacío
        }

        if(!$this->formato_email($this->email)) {
            return $this->rellena_validation(false,'EML_FRMT','USUARIO'); // Formato email incorrecto
        }

        return $this->rellena_validation(true,'00000','USUARIO'); // Validación Ok
    }

    function validar_TELEFONO() {
        if(!$this->no_vacio($this->telefono)) {
            return $this->rellena_validation(false,'TLF_EMPT','USUARIO'); // Teléfono no puede ser vacío
        }

        if(!$this->formato_telefono($this->telefono)) {
            return $this->rellena_validation(false,'TLF_FRMT','USUARIO'); // Formato teléfono incorrecto.
        }

        return $this->rellena_validation(true,'00000','USUARIO'); // Validación Ok.
    }


    function validar_FOTO_PERFIL() {
        if(!$this->extension_imagen('foto_perfil')) {
            return $this->rellena_validation(false,'PRPH_EXT','USUARIO'); // Extensión de fichero no permitida
        }

        if(!$this->tamanho_max_imagen('foto_perfil',100000)) {
            return $this->rellena_validation(false,'PRPH_LRG','USUARIO'); // Tamaño de imagen superior al 100kb
        }

        return $this->rellena_validation(true,'00000','USUARIO'); // Validación OK
    }
}
<?php

include_once 'Validator.php';

class Building_Validation extends Validator {
    var $edificio_id;
    var $username;
    var $nombre;
    var $calle;
    var $ciudad;
    var $provincia;
    var $codigo_postal;
    var $telefono;
    var $fax;
    var $foto_edificio;

    function __construct() {

    }


    function validar_atributos_add() {
        $validacion = $this->validar_USERNAME();
        if(!$validacion['ok']) {
            return $validacion;
        }

        $validacion = $this->validar_NOMBRE();
        if(!$validacion['ok']) {
            return $validacion;
        }

        $validacion = $this->validar_CALLE();
        if(!$validacion['ok']) {
            return $validacion;
        }

        $validacion = $this->validar_CIUDAD();
        if(!$validacion['ok']) {
            return $validacion;
        }

        $validacion = $this->validar_PROVINCIA();
        if(!$validacion['ok']) {
            return $validacion;
        }

        $validacion = $this->validar_CODIGO_POSTAL();
        if(!$validacion['ok']) {
            return $validacion;
        }

        $validacion = $this->validar_TELEFONO();
        if(!$validacion['ok']) {
            return $validacion;
        }

        $validacion = $this->validar_FAX();
        if(!$validacion['ok']) {
            return $validacion;
        }

        if($this->foto_edificio != '') {
            $validacion = $this->validar_FOTO_EDIFICIO();
        }

        return $validacion;
    }

    function validar_EDIFICIO_ID() {
        if(!$this->no_vacio($this->edificio_id)) {
            return $this->rellena_validation(false,'BLD_ID_EMPT','BUILDING');
        }

        if(!$this->es_numerico($this->edificio_id)) {
            return $this->rellena_validation(false,'BLD_ID_NOT_NUMERIC','BUILDING');
        }

        return $this->rellena_validation(true,'00000','BUILDING');
    }

    function validar_USERNAME() {
        if(!$this->longitud_minima($this->username,3)) {
            return $this->rellena_validation(false,'USRNM_SHRT','BUILDING'); // Nombre de usuario debe tener más de 3 caracteres.
        }

        if(!$this->longitud_maxima($this->username,20)) {
            return $this->rellena_validation(false,'USRNM_LRG','BUILDING'); // Nombre de usuario debe tener menos de 20 caracteres.
        }

        if(!$this->es_alfanumerico($this->username)) {
            return $this->rellena_validation(false,'USRNM_ALF','BUILDING'); // Nombre de usuario sólo puede contener caracteres alfanuméricos.
        }

        return $this->rellena_validation(true,'00000','BUILDING'); // Validación OK.
    }

    function validar_NOMBRE() {
        if(!$this->longitud_minima($this->nombre,3)) {
            return $this->rellena_validation(false,'BLD_NAM_SHRT','BUILDING');
        }

        if(!$this->longitud_maxima($this->nombre,60)) {
            return $this->rellena_validation(false,'BLD_NAM_LRG','BUILDING');
        }

        if(!$this->solo_letras_numeros_espacios_acentos($this->nombre)) {
            return $this->rellena_validation(false,'BLD_NAM_FRMT','BUILDING');
        }

        return $this->rellena_validation(true,'00000','BUILDING');
    }

    function validar_CALLE() {
        if(!$this->longitud_minima($this->calle,8)) {
            return $this->rellena_validation(false,'CALLE_SHRT','BUILDING');
        }

        if(!$this->longitud_maxima($this->calle,60)) {
            return $this->rellena_validation(false,'CALLE_LRG','BUILDING');
        }

        if(!$this->solo_letras_numeros_espacios_acentos($this->calle)) {
            return $this->rellena_validation(false,'CALLE_FRMT','BUILDING');
        }

        return $this->rellena_validation(true,'00000','BUILDING');
    }

    function validar_CIUDAD() {
        if(!$this->longitud_minima($this->ciudad,3)) {
            return $this->rellena_validation(false,'CIUDAD_SHRT','BUILDING');
        }

        if(!$this->longitud_maxima($this->ciudad,40)) {
            return $this->rellena_validation(false,'CIUDAD_LRG','BUILDING');
        }

        if(!$this->solo_letras_espacios($this->ciudad)) {
            return $this->rellena_validation(false,'CIUDAD_FRMT','BUILDING');
        }

        return $this->rellena_validation(true,'00000','BUILDING');
    }

    function validar_PROVINCIA() {
        if(!$this->longitud_minima($this->provincia,3)) {
            return $this->rellena_validation(false,'PROV_SHRT','BUILDING');
        }

        if(!$this->longitud_maxima($this->provincia,40)) {
            return $this->rellena_validation(false,'PROV_LRG','BUILDING');
        }

        if(!$this->solo_letras_espacios($this->provincia)) {
            return $this->rellena_validation(false,'PROV_FRMT','BUILDING');
        }

        return $this->rellena_validation(true,'00000','BUILDING');
    }

    function validar_CODIGO_POSTAL() {
        if(!$this->no_vacio($this->codigo_postal)) {
            return $this->rellena_validation(false,'CP_EMPT','BUILDING');
        }

        if(!$this->es_numerico($this->codigo_postal)) {
            return $this->rellena_validation(false,'CP_NUMERIC','BUILDING');
        }

        if(!$this->exact_size($this->codigo_postal,5)) {
            return $this->rellena_validation(false,'CP_SIZE','BUILDING');
        }

        return $this->rellena_validation(true,'00000','BUILDING');
    }

    function validar_TELEFONO() {
        if(!$this->no_vacio($this->telefono)) {
            return $this->rellena_validation(false,'TLF_EMPT','BUILDING'); // Teléfono no puede ser vacío
        }

        if(!$this->formato_telefono($this->telefono)) {
            return $this->rellena_validation(false,'TLF_FRMT','BUILDING'); // Formato teléfono incorrecto.
        }

        return $this->rellena_validation(true,'00000','BUILDING'); // Validación Ok.
    }

    function validar_FAX() {
        if(!$this->no_vacio($this->telefono)) {
            return $this->rellena_validation(false,'FAX_EMPT','BUILDING');
        }

        if(!$this->formato_telefono($this->telefono)) {
            return $this->rellena_validation(false,'FAX_FRMT','BUILDING');
        }

        return $this->rellena_validation(true,'00000','BUILDING');
    }

    function validar_FOTO_EDIFICIO() {
        if(!$this->extension_imagen('foto_edificio')) {
            return $this->rellena_validation(false,'BLD_PH_EXT','BUILDING'); // Extensión de fichero no permitida
        }

        /* if(!$this->max_tamanho_imagen('foto_perfil',100000)) {
             return $this->rellena_validation(false,'PRPH_LRG','USUARIO'); // Tamaño de imagen superior al 100kb
         } */

        if(!$this->formato_nombre_imagen('foto_edificio')) {
            return $this->rellena_validation(false, 'BLD_PH_FRMT', 'BUILDING'); // Formato de nombre incorrecto (sólo letras, números y guiones)
        }

        return $this->rellena_validation(true,'00000','BUILDING'); // Validación OK
    }

}
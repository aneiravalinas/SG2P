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

        if($this->foto_edificio != '') {
            $validacion = $this->validar_FOTO_EDIFICIO();
        }

        return $validacion;
    }

    function validar_atributos_search() {
        $validacion = array('ok' => true, 'code' => '00000', 'resource' => 'EDIFICIO');

        if($this->edificio_id != '') {
            $validacion = $this->validar_EDIFICIO_ID();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        if($this->username != '') {
            $validacion = $this->validar_USERNAME();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        if($this->nombre != '') {
            $validacion = $this->validar_NOMBRE();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        if($this->calle != '') {
            $validacion = $this->validar_CALLE();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        if($this->ciudad != '') {
            $validacion = $this->validar_CIUDAD();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        if($this->provincia != '') {
            $validacion = $this->validar_PROVINCIA();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        if($this->codigo_postal != '') {
            $validacion = $this->validar_CODIGO_POSTAL_SEARCH();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        if($this->telefono != '') {
            $validacion = $this->validar_TELEFONO_SEARCH();
        }

        return $validacion;
    }

    function validar_atributos_edit() {
        $validacion = $this->validar_EDIFICIO_ID();
        if(!$validacion['ok']) {
            return $validacion;
        }

        return $this->validar_atributos_add();
    }

    function validar_EDIFICIO_ID() {
        if(!$this->no_vacio($this->edificio_id)) {
            return $this->rellena_validation(false,'BLD_ID_EMPT','EDIFICIO');
        }

        if(!$this->es_numerico($this->edificio_id)) {
            return $this->rellena_validation(false,'BLD_ID_NOT_NUMERIC','EDIFICIO');
        }

        return $this->rellena_validation(true,'00000','EDIFICIO');
    }

    function validar_USERNAME() {
        if(!$this->longitud_minima($this->username,3)) {
            return $this->rellena_validation(false,'MANG_SHRT','EDIFICIO'); // Nombre de usuario debe tener más de 3 caracteres.
        }

        if(!$this->longitud_maxima($this->username,20)) {
            return $this->rellena_validation(false,'MANG_LRG','EDIFICIO'); // Nombre de usuario debe tener menos de 20 caracteres.
        }

        if(!$this->es_alfanumerico($this->username)) {
            return $this->rellena_validation(false,'MANG_ALF','EDIFICIO'); // Nombre de usuario sólo puede contener caracteres alfanuméricos.
        }

        return $this->rellena_validation(true,'00000','EDIFICIO'); // Validación OK.
    }

    function validar_NOMBRE() {
        if(!$this->longitud_minima($this->nombre,3)) {
            return $this->rellena_validation(false,'BLD_NAM_SHRT','EDIFICIO');
        }

        if(!$this->longitud_maxima($this->nombre,60)) {
            return $this->rellena_validation(false,'BLD_NAM_LRG','EDIFICIO');
        }

        if(!$this->solo_letras_numeros_espacios_acentos($this->nombre)) {
            return $this->rellena_validation(false,'BLD_NAM_FRMT','EDIFICIO');
        }

        return $this->rellena_validation(true,'00000','EDIFICIO');
    }

    function validar_CALLE() {
        if(!$this->longitud_minima($this->calle,8)) {
            return $this->rellena_validation(false,'CALLE_SHRT','EDIFICIO');
        }

        if(!$this->longitud_maxima($this->calle,60)) {
            return $this->rellena_validation(false,'CALLE_LRG','EDIFICIO');
        }

        if(!$this->solo_letras_numeros_espacios_acentos($this->calle)) {
            return $this->rellena_validation(false,'CALLE_FRMT','EDIFICIO');
        }

        return $this->rellena_validation(true,'00000','EDIFICIO');
    }

    function validar_CIUDAD() {
        if(!$this->longitud_minima($this->ciudad,3)) {
            return $this->rellena_validation(false,'CIUDAD_SHRT','EDIFICIO');
        }

        if(!$this->longitud_maxima($this->ciudad,40)) {
            return $this->rellena_validation(false,'CIUDAD_LRG','EDIFICIO');
        }

        if(!$this->solo_letras_espacios($this->ciudad)) {
            return $this->rellena_validation(false,'CIUDAD_FRMT','EDIFICIO');
        }

        return $this->rellena_validation(true,'00000','EDIFICIO');
    }

    function validar_PROVINCIA() {
        if(!$this->longitud_minima($this->provincia,3)) {
            return $this->rellena_validation(false,'PROV_SHRT','EDIFICIO');
        }

        if(!$this->longitud_maxima($this->provincia,40)) {
            return $this->rellena_validation(false,'PROV_LRG','EDIFICIO');
        }

        if(!$this->solo_letras_espacios($this->provincia)) {
            return $this->rellena_validation(false,'PROV_FRMT','EDIFICIO');
        }

        return $this->rellena_validation(true,'00000','EDIFICIO');
    }

    function validar_CODIGO_POSTAL() {
        if(!$this->no_vacio($this->codigo_postal)) {
            return $this->rellena_validation(false,'CP_EMPT','EDIFICIO');
        }

        if(!$this->es_numerico($this->codigo_postal)) {
            return $this->rellena_validation(false,'CP_NUMERIC','EDIFICIO');
        }

        if(!$this->exact_size($this->codigo_postal,5)) {
            return $this->rellena_validation(false,'CP_SIZE','EDIFICIO');
        }

        return $this->rellena_validation(true,'00000','EDIFICIO');
    }

    function validar_CODIGO_POSTAL_SEARCH() {
        if(!$this->es_numerico($this->codigo_postal)) {
            return $this->rellena_validation(false,'CP_NUMERIC','EDIFICIO');
        }

        if($this->longitud_maxima($this->codigo_postal,5)) {
            return $this->rellena_validation(false,'CP_MAX_SIZE','EDIFICIO');
        }

        return $this->rellena_validation(true,'00000','EDIFICIO');
    }

    function validar_TELEFONO() {
        if(!$this->no_vacio($this->telefono)) {
            return $this->rellena_validation(false,'TLF_EMPT','EDIFICIO'); // Teléfono no puede ser vacío
        }

        if(!$this->formato_telefono($this->telefono)) {
            return $this->rellena_validation(false,'TLF_FRMT','EDIFICIO'); // Formato teléfono incorrecto.
        }

        return $this->rellena_validation(true,'00000','EDIFICIO'); // Validación Ok.
    }

    function validar_TELEFONO_SEARCH() {
        if(!$this->longitud_maxima($this->telefono,9)) {
            return $this->rellena_validation(false,'TLF_MAX_SIZE','EDIFICIO');
        }

        if(!$this->es_numerico($this->telefono)) {
            return $this->rellena_validation(false,'TLF_WITH_LETTERS','EDIFICIO');
        }

        return $this->rellena_validation(true,'00000','EDIFICIO');
    }


    function validar_FOTO_EDIFICIO() {
        if(!$this->extension_imagen('foto_edificio')) {
            return $this->rellena_validation(false,'BLD_PH_EXT','EDIFICIO'); // Extensión de fichero no permitida
        }

        /* if(!$this->max_tamanho_imagen('foto_perfil',100000)) {
             return $this->rellena_validation(false,'PRPH_LRG','USUARIO'); // Tamaño de imagen superior al 100kb
         } */

        if(!$this->formato_nombre_imagen('foto_edificio')) {
            return $this->rellena_validation(false, 'BLD_PH_FRMT', 'EDIFICIO'); // Formato de nombre incorrecto (sólo letras, números y guiones)
        }

        return $this->rellena_validation(true,'00000','EDIFICIO'); // Validación OK
    }

}
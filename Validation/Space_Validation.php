<?php

include_once 'Validator.php';

class Space_Validation extends Validator {
    var $espacio_id;
    var $planta_id;
    var $nombre;
    var $descripcion;
    var $foto_espacio;

    function __construct() {

    }

    function validar_atributos_search() {
        $validacion = $this->rellena_validation(true,'00000','ESPACIO');
        if($this->espacio_id != '') {
            $validacion = $this->validar_ESPACIO_ID();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        if($this->nombre != '') {
            $validacion = $this->validar_NOMBRE();
        }

        return $validacion;
    }

    function validar_atributos() {
        $validacion = $this->validar_NOMBRE();
        if(!$validacion['ok']) {
            return $validacion;
        }

        $validacion = $this->validar_DESCRIPCION();
        if(!$validacion['ok']) {
            return $validacion;
        }

        if($this->foto_espacio != '') {
            $validacion = $this->validar_FOTO_ESPACIO();
        }

        return $validacion;
    }


    function validar_ESPACIO_ID() {
        if(!$this->no_vacio($this->espacio_id)) {
            return $this->rellena_validation(false,'SPC_ID_EMPT','ESPACIO');
        }

        if(!$this->es_numerico($this->espacio_id)) {
            return $this->rellena_validation(false,'SPC_ID_NOT_NUMERIC','ESPACIO');
        }

        return $this->rellena_validation(true,'00000','ESPACIO');
    }


    function validar_PLANTA_ID() {
        if(!$this->no_vacio($this->planta_id)) {
            return $this->rellena_validation(false,'FLR_ID_EMPT','ESPACIO');
        }

        if(!$this->es_numerico($this->planta_id)) {
            return $this->rellena_validation(false,'FLR_ID_NOT_NUMERIC','ESPACIO');
        }

        return $this->rellena_validation(true,'00000','ESPACIO');
    }

    function validar_NOMBRE() {
        if(!$this->longitud_minima($this->nombre,3)) {
            return $this->rellena_validation(false,'SPC_NAM_SHRT','ESPACIO');
        }

        if(!$this->longitud_maxima($this->nombre,40)) {
            return $this->rellena_validation(false,'SPC_NAM_LRG','ESPACIO');
        }

        if(!$this->solo_letras_numeros_espacios_acentos($this->nombre)) {
            return $this->rellena_validation(false,'SPC_NAM_FRMT','ESPACIO');
        }

        return $this->rellena_validation(true,'00000','ESPACIO');
    }

    function validar_DESCRIPCION() {
        if(!$this->no_vacio($this->descripcion)) {
            return $this->rellena_validation(false,'DESC_EMPTY','ESPACIO');
        }

        if(!$this->comprobar_textos($this->descripcion)) {
            return $this->rellena_validation(false,'DESC_FRMT','ESPACIO');
        }

        return $this->rellena_validation(true,'00000','ESPACIO');
    }

    function validar_FOTO_ESPACIO() {
        if(!$this->extension_imagen('foto_espacio')) {
            return $this->rellena_validation(false,'SPC_PH_EXT','ESPACIO'); // Extensión de fichero no permitida
        }

        if(!$this->formato_nombre_imagen('foto_espacio')) {
            return $this->rellena_validation(false, 'SPC_PH_FRMT', 'ESPACIO'); // Formato de nombre incorrecto (sólo letras, números y guiones)
        }

        return $this->rellena_validation(true,'00000','ESPACIO'); // Validación OK
    }


}
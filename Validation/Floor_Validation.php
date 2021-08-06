<?php

include_once 'Validator.php';

class Floor_Validation extends Validator {
    var $planta_id;
    var $edificio_id;
    var $nombre;
    var $num_planta;
    var $descripcion;
    var $foto_planta;

    function __construct() {

    }


    function validar_atributos() {
        $validacion = $this->validar_NOMBRE();
        if(!$validacion['ok']) {
            return $validacion;
        }

        $validacion = $this->validar_NUM_PLANTA();
        if(!$validacion['ok']) {
            return $validacion;
        }

        $validacion = $this->validar_DESCRIPCION();
        if(!$validacion['ok']) {
            return $validacion;
        }

        if($this->foto_planta != '') {
            $validacion = $this->validar_FOTO_PLANTA();
        }

        return $validacion;
    }

    function validar_atributos_search() {
        $validacion = $this->rellena_validation(true,'00000','PLANTA');

        if($this->planta_id != '') {
            $validacion = $this->validar_PLANTA_ID();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        if($this->nombre != '') {
            $validacion = $this->validar_NOMBRE();
            if($validacion['ok']) {
                return $validacion;
            }
        }

        if($this->num_planta != '') {
            $validacion = $this->validar_NUM_PLANTA();
        }

        return $validacion;

    }

    function validar_PLANTA_ID() {
        if(!$this->no_vacio($this->planta_id)) {
            return $this->rellena_validation(false,'FLR_ID_EMPT','PLANTA');
        }

        if(!$this->es_numerico($this->planta_id)) {
            return $this->rellena_validation(false,'FLR_ID_NOT_NUMERIC','PLANTA');
        }

        return $this->rellena_validation(true,'00000','PLANTA');
    }

    function validar_EDIFICIO_ID() {
        if(!$this->no_vacio($this->edificio_id)) {
            return $this->rellena_validation(false,'BLD_ID_EMPT','PLANTA');
        }

        if(!$this->es_numerico($this->edificio_id)) {
            return $this->rellena_validation(false,'BLD_ID_NOT_NUMERIC','PLANTA');
        }

        return $this->rellena_validation(true,'00000','PLANTA');
    }

    function validar_NOMBRE() {
        if(!$this->longitud_minima($this->nombre,3)) {
            return $this->rellena_validation(false,'FLR_NAM_SHRT','PLANTA');
        }

        if(!$this->longitud_maxima($this->nombre,40)) {
            return $this->rellena_validation(false,'FLR_NAM_LRG','PLANTA');
        }

        if(!$this->solo_letras_numeros_espacios_acentos($this->nombre)) {
            return $this->rellena_validation(false,'FLR_NAM_FRMT','PLANTA');
        }

        return $this->rellena_validation(true,'00000','PLANTA');
    }

    function validar_NUM_PLANTA() {
        if(!$this->no_vacio($this->num_planta)) {
            return $this->rellena_validation(false,'NUM_FLOOR_EMPT','PLANTA');
        }

        if(!$this->longitud_maxima($this->num_planta,3)) {
            return $this->rellena_validation(false,'NUM_FLOOR_LRG','PLANTA');
        }

        if(!$this->es_numerico($this->num_planta)) {
            return $this->rellena_validation(false,'NUM_FLOOR_NOT_NUMERIC','PLANTA');
        }

        return $this->rellena_validation(true,'00000','PLANTA');
    }

    function validar_DESCRIPCION() {
        if(!$this->no_vacio($this->descripcion)) {
            return $this->rellena_validation(false,'DESC_EMPTY','PLANTA');
        }

        if(!$this->comprobar_textos($this->descripcion)) {
            return $this->rellena_validation(false,'DESC_FRMT','PLANTA');
        }

        return $this->rellena_validation(true,'00000','PLANTA');
    }

    function validar_FOTO_PLANTA() {
        if(!$this->extension_imagen('foto_planta')) {
            return $this->rellena_validation(false,'FLR_PH_EXT','PLANTA'); // Extensión de fichero no permitida
        }

        if(!$this->formato_nombre_imagen('foto_planta')) {
            return $this->rellena_validation(false, 'FLR_PH_FRMT', 'PLANTA'); // Formato de nombre incorrecto (sólo letras, números y guiones)
        }

        return $this->rellena_validation(true,'00000','PLANTA'); // Validación OK
    }
}
<?php

include_once 'Validator.php';

class Formation_Validation extends Validator {
    var $edificio_formacion_id;
    var $edificio_id;
    var $formacion_id;
    var $estado;
    var $fecha_planificacion;
    var $url_recurso;
    var $destinatarios;
    var $nombre_edificio;
    var $buildings = array();
    const states = array('pendiente','cumplimentado','vencido');

    function __construct() {
    }


    function validar_atributos_search() {
        $validacion = $this->rellena_validation(true, '00000', 'IMP_FORMAT');
        if($this->edificio_formacion_id != '') {
            $validacion = $this->validar_EDIFICIO_FORMACION_ID();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        if($this->estado != '') {
            $validacion = $this->validar_ESTADO();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        if($this->fecha_planificacion != '') {
            $validacion = $this->validar_FECHA_PLANIFICACION();
        }

        return $validacion;
    }

    function validar_atributos_search_implements() {
        $validacion = $this->validar_atributos_search();
        if(!$validacion['ok']) {
            return $validacion;
        }

        if($this->edificio_id != '') {
            $validacion = $this->validar_EDIFICIO_ID();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        if($this->nombre_edificio != '') {
            $validacion = $this->validar_NOMBRE_EDIFICIO();
        }

        return $validacion;
    }

    function validar_format_and_building() {
        $validacion = $this->validar_FORMACION_ID();
        if(!$validacion['ok']) {
            return $validacion;
        }

        return $this->validar_EDIFICIO_ID();
    }

    function validar_atributos_add() {
        $validacion = $this->validar_FORMACION_ID();
        if(!$validacion['ok']) {
            return $validacion;
        }

        return $this->validar_BUILDINGS();
    }

    function validar_EDIFICIO_FORMACION_ID() {
        if(!$this->no_vacio($this->edificio_formacion_id)) {
            return $this->rellena_validation(false, 'IMPFORMAT_ID_EMPT', 'IMP_FORMAT');
        }

        if(!$this->es_numerico($this->edificio_formacion_id)) {
            return $this->rellena_validation(false, 'IMPFORMAT_ID_NOT_NUMERIC', 'IMP_FORMAT');
        }

        return $this->rellena_validation(true, '00000', 'IMP_FORMAT');
    }

    function validar_EDIFICIO_ID() {
        if(!$this->no_vacio($this->edificio_id)) {
            return $this->rellena_validation(false,'BLD_ID_EMPT','IMP_FORMAT');
        }

        if(!$this->es_numerico($this->edificio_id)) {
            return $this->rellena_validation(false,'BLD_ID_NOT_NUMERIC','IMP_FORMAT');
        }

        return $this->rellena_validation(true,'00000','IMP_FORMAT');
    }

    function validar_FORMACION_ID() {
        if(!$this->no_vacio($this->formacion_id)) {
            return $this->rellena_validation(false,'DFFRMT_ID_EMPT','IMP_FORMAT');
        }

        if(!$this->es_numerico($this->formacion_id)) {
            return $this->rellena_validation(false,'DEFFRMT_ID_NOT_NUMERIC','IMP_FORMAT');
        }

        return $this->rellena_validation(true,'00000','IMP_FORMAT');
    }

    function validar_ESTADO() {
        if(!$this->no_vacio($this->estado)) {
            return $this->rellena_validation(false,'STATE_EMPT','IMP_FORMAT');
        }

        if(!$this->en_valores($this->estado, self::states)) {
            return $this->rellena_validation(false,'STATE_KO','IMP_FORMAT');
        }

        return $this->rellena_validation(true,'00000','IMP_FORMAT');
    }

    function validar_FECHA_PLANIFICACION() {
        if(!$this->no_vacio($this->fecha_planificacion)) {
            return $this->rellena_validation(false, 'PLANNING_DATE_EMPT', 'IMP_FORMAT');
        }

        if(!$this->validar_fecha($this->fecha_planificacion)) {
            return $this->rellena_validation(false, 'PLANNING_DATE_KO', 'IMP_FORMAT');
        }

        if(!$this->validar_fecha_futura($this->fecha_planificacion)) {
            return $this->rellena_validation(false, 'PLANNING_DATE_PAST','IMP_FORMAT');
        }

        return $this->rellena_validation(true, '00000', 'IMP_FORMAT');
    }

    function validar_NOMBRE_EDIFICIO() {
        if(!$this->longitud_minima($this->nombre_edificio,3)) {
            return $this->rellena_validation(false,'BLD_NAM_SHRT','IMP_FORMAT');
        }

        if(!$this->longitud_maxima($this->nombre_edificio,60)) {
            return $this->rellena_validation(false,'BLD_NAM_LRG','IMP_FORMAT');
        }

        if(!$this->solo_letras_numeros_espacios_acentos($this->nombre_edificio)) {
            return $this->rellena_validation(false,'BLD_NAM_FRMT','IMP_FORMAT');
        }

        return $this->rellena_validation(true,'00000','IMP_FORMAT');
    }

    function validar_DESTINATARIOS() {
        if(!$this->no_vacio($this->destinatarios)) {
            return $this->rellena_validation(false, 'RECIPIENTS_EMPT', 'IMP_FORMAT');
        }

        if(!$this->longitud_maxima($this->destinatarios, 80)) {
            return $this->rellena_validation(false, 'RECIPIENTS_LRG', 'IMP_FORMAT');
        }

        if(!$this->comprobar_textos($this->destinatarios)) {
            return $this->rellena_validation(false, 'RECIPIENTS_FRMT', 'IMP_FORMAT');
        }

        return $this->rellena_validation(true, '00000', 'IMP_FORMAT');
    }

    function validar_URL_RECURSO() {
        if(!$this->validar_url($this->url_recurso)) {
            return $this->rellena_validation(false, 'URL_FRMT', 'IMP_FORMAT');
        }

        return $this->rellena_validation(true, '00000', 'IMP_FORMAT');
    }

    function validar_BUILDINGS() {
        if(empty($this->buildings)) {
            return $this->rellena_validation(false, 'BLD_ID_EMPT', 'IMP_FORMAT');
        }

        foreach($this->buildings as $building) {
            $this->edificio_id = $building;
            $validacion = $this->validar_EDIFICIO_ID();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        return $this->rellena_validation(true, '00000', 'IMP_FORMAT');
    }
}
<?php

include_once 'Cumplimentation_Validation.php';

class Sim_Format_Validation extends Cumplimentation_Validation {
    var $fecha_planificacion;
    var $fecha_planificacion_inicio;
    var $fecha_planificacion_fin;
    var $url_recurso;
    var $destinatarios;

    function __construct(){
    }

    function validar_atributos_search() {
        $validacion = $this->validar_atributos_search_portal();
        if(!$validacion['ok']) {
            return $validacion;
        }

        return parent::validar_atributos_search();

    }

    function validar_atributos_search_portal() {
        $validacion = $this->rellena_validation(true, '00000', 'SIM_FORMAT');
        if($this->fecha_planificacion_inicio != '') {
            $validacion = $this->validar_FECHA_PLANIFICACION_INICIO();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        if($this->fecha_planificacion_fin != '') {
            $validacion = $this->validar_FECHA_PLANIFICACION_FIN();
        }

        return $validacion;
    }

    function validar_atributos_searchCompletions() {
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

    function validar_atributos_implement() {
        if($this->url_recurso != '') {
            $validacion = $this->validar_URL_RECURSO();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        $validacion = $this->validar_FECHA_PLANIFICACION();
        if(!$validacion['ok']) {
            return $validacion;
        }

        return $this->validar_DESTINATARIOS();
    }

    function validar_FECHA_PLANIFICACION() {
        if(!$this->no_vacio($this->fecha_planificacion)) {
            return $this->rellena_validation(false, 'PLANNING_DATE_EMPT', 'SIM_FORMAT');
        }

        if(!$this->validar_fecha($this->fecha_planificacion)) {
            return $this->rellena_validation(false, 'PLANNING_DATE_KO', 'SIM_FORMAT');
        }

        if(!$this->validar_fecha_futura($this->fecha_planificacion)) {
            return $this->rellena_validation(false, 'PLANNING_DATE_PAST','SIM_FORMAT');
        }

        return $this->rellena_validation(true, '00000', 'SIM_FORMAT');
    }

    function validar_FECHA_PLANIFICACION_INICIO() {
        if(!$this->validar_fecha($this->fecha_planificacion_inicio)) {
            return $this->rellena_validation(false, 'START_PLANNING_DATE_KO', 'SIM_FORMAT');
        }

        return $this->rellena_validation(true, '00000', 'SIM_FORMAT');
    }

    function validar_FECHA_PLANIFICACION_FIN() {
        if(!$this->validar_fecha($this->fecha_planificacion_fin)) {
            return $this->rellena_validation(false, 'END_PLANNING_DATE_KO', 'SIM_FORMAT');
        }

        return $this->rellena_validation(true, '00000', 'SIM_FORMAT');
    }

    function validar_DESTINATARIOS() {
        if(!$this->no_vacio($this->destinatarios)) {
            return $this->rellena_validation(false, 'RECIPIENTS_EMPT', 'SIM_FORMAT');
        }

        if(!$this->longitud_maxima($this->destinatarios, 200)) {
            return $this->rellena_validation(false, 'RECIPIENTS_LRG', 'SIM_FORMAT');
        }

        if(!$this->comprobar_textos($this->destinatarios)) {
            return $this->rellena_validation(false, 'RECIPIENTS_FRMT', 'SIM_FORMAT');
        }

        return $this->rellena_validation(true, '00000', 'SIM_FORMAT');
    }

    function validar_URL_RECURSO() {
        if(!$this->longitud_maxima($this->url_recurso, 200)) {
            return $this->rellena_validation(false, 'URL_LRG', 'SIM_FORMAT');
        }

        if(!$this->validar_url($this->url_recurso)) {
            return $this->rellena_validation(false, 'URL_FRMT', 'SIM_FORMAT');
        }

        return $this->rellena_validation(true, '00000', 'SIM_FORMAT');
    }
}
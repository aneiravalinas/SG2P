<?php

include_once 'Validator.php';

class Simulacrum_Validation extends Validator {
    var $edificio_simulacro_id;
    var $edificio_id;
    var $simulacro_id;
    var $estado;
    var $fecha_planificacion;
    var $fecha_vencimiento;
    var $url_recurso;
    var $destinatarios;
    var $nombre_edificio;
    var $buildings = array();
    const states = array('pendiente','cumplimentado','vencido');

    function __construct() {
    }

    function validar_atributos_search(){
        $validacion = $this->rellena_validation(true, '00000', 'IMP_SIM');
        if($this->edificio_simulacro_id != '') {
            $validacion = $this->validar_EDIFICIO_SIMULACRO_ID();
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

        if($this->fecha_vencimiento != '') {
            $validacion = $this->validar_FECHA_VENCIMIENTO();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        if($this->fecha_planificacion != '') {
            $validacion = $this->validar_FECHA_PLANIFICACION_SEARCH();
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

    function validar_atributos_search_portal() {
        $validacion = $this->rellena_validation(true, '00000', 'IMP_SIM');

        if($this->fecha_planificacion != '') {
            $validacion = $this->validar_FECHA_PLANIFICACION_SEARCH();
        }

        return $validacion;
    }

    function validar_sim_and_building() {
        $validacion = $this->validar_SIMULACRO_ID();
        if(!$validacion['ok']) {
            return $validacion;
        }

        return $this->validar_EDIFICIO_ID();
    }

    function validar_atributos_add() {
        $validacion = $this->validar_SIMULACRO_ID();
        if(!$validacion['ok']) {
            return $validacion;
        }

        return $this->validar_BUILDINGS();
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

    function validar_EDIFICIO_SIMULACRO_ID() {
        if(!$this->no_vacio($this->edificio_simulacro_id)) {
            return $this->rellena_validation(false, 'IMPSIM_ID_EMPT', 'IMP_SIM');
        }

        if(!$this->es_numerico($this->edificio_simulacro_id)) {
            return $this->rellena_validation(false, 'IMPSIM_ID_NOT_NUMERIC', 'IMP_SIM');
        }

        return $this->rellena_validation(true, '00000', 'IMP_SIM');
    }

    function validar_EDIFICIO_ID() {
        if(!$this->no_vacio($this->edificio_id)) {
            return $this->rellena_validation(false,'BLD_ID_EMPT','IMP_SIM');
        }

        if(!$this->es_numerico($this->edificio_id)) {
            return $this->rellena_validation(false,'BLD_ID_NOT_NUMERIC','IMP_SIM');
        }

        return $this->rellena_validation(true,'00000','IMP_SIM');
    }

    function validar_SIMULACRO_ID() {
        if(!$this->no_vacio($this->simulacro_id)) {
            return $this->rellena_validation(false, 'DFSIM_ID_EMPT', 'IMP_SIM');
        }

        if(!$this->es_numerico($this->simulacro_id)) {
            return $this->rellena_validation(false, 'DFSIM_ID_NOT_NUMERIC', 'IMP_SIM');
        }

        return $this->rellena_validation(true, '00000', 'IMP_SIM');
    }

    function validar_ESTADO() {
        if(!$this->no_vacio($this->estado)) {
            return $this->rellena_validation(false,'STATE_EMPT','IMP_SIM');
        }

        if(!$this->en_valores($this->estado, self::states)) {
            return $this->rellena_validation(false,'STATE_KO','IMP_SIM');
        }

        return $this->rellena_validation(true,'00000','IMP_SIM');
    }

    function validar_ESTADO_PORTAL() {
        if(!$this->en_valores($this->estado, array('pendiente', 'cumplimentado'))) {
            return $this->rellena_validation(false,'STATE_KO','IMP_SIM');
        }

        return $this->rellena_validation(true, 'STATE_OK', 'IMP_SIM');
    }

    function validar_FECHA_PLANIFICACION() {
        if(!$this->no_vacio($this->fecha_planificacion)) {
            return $this->rellena_validation(false, 'PLANNING_DATE_EMPT', 'IMP_SIM');
        }

        $validacion = $this->validar_FECHA_PLANIFICACION_SEARCH();
        if(!$validacion['ok']) {
            return $validacion;
        }

        if(!$this->validar_fecha_futura($this->fecha_planificacion)) {
            return $this->rellena_validation(false, 'PLANNING_DATE_PAST','IMP_SIM');
        }

        return $this->rellena_validation(true, '00000', 'IMP_SIM');
    }

    function validar_FECHA_PLANIFICACION_SEARCH() {
        if(!$this->validar_fecha($this->fecha_planificacion)) {
            return $this->rellena_validation(false, 'PLANNING_DATE_KO', 'IMP_SIM');
        }

        return $this->rellena_validation(true, '00000', 'IMP_SIM');
    }

    function validar_FECHA_VENCIMIENTO() {
        if(!$this->validar_fecha($this->fecha_vencimiento)) {
            return $this->rellena_validation(false, 'DATEEXPIRE_KO','IMP_SIM');
        }

        return $this->rellena_validation(true, '00000', 'IMP_SIM');
    }

    function validar_NOMBRE_EDIFICIO() {
        if(!$this->longitud_minima($this->nombre_edificio,3)) {
            return $this->rellena_validation(false,'BLD_NAM_SHRT','IMP_SIM');
        }

        if(!$this->longitud_maxima($this->nombre_edificio,60)) {
            return $this->rellena_validation(false,'BLD_NAM_LRG','IMP_SIM');
        }

        if(!$this->solo_letras_numeros_espacios_acentos($this->nombre_edificio)) {
            return $this->rellena_validation(false,'BLD_NAM_FRMT','IMP_SIM');
        }

        return $this->rellena_validation(true,'00000','IMP_SIM');
    }

    function validar_DESTINATARIOS() {
        if(!$this->no_vacio($this->destinatarios)) {
            return $this->rellena_validation(false, 'RECIPIENTS_EMPT', 'IMP_SIM');
        }

        if(!$this->longitud_maxima($this->destinatarios, 200)) {
            return $this->rellena_validation(false, 'RECIPIENTS_LRG', 'IMP_SIM');
        }

        if(!$this->comprobar_textos($this->destinatarios)) {
            return $this->rellena_validation(false, 'RECIPIENTS_FRMT', 'IMP_SIM');
        }

        return $this->rellena_validation(true, '00000', 'IMP_SIM');
    }

    function validar_URL_RECURSO() {
        if(!$this->longitud_maxima($this->url_recurso, 200)) {
            return $this->rellena_validation(false, 'URL_LRG', 'IMP_SIM');
        }

        if(!$this->validar_url($this->url_recurso)) {
            return $this->rellena_validation(false, 'URL_FRMT', 'IMP_SIM');
        }

        return $this->rellena_validation(true, '00000', 'IMP_SIM');
    }

    function validar_BUILDINGS() {
        if(empty($this->buildings)) {
            return $this->rellena_validation(false, 'BLD_ID_EMPT', 'IMP_SIM');
        }

        foreach($this->buildings as $building) {
            $this->edificio_id = $building;
            $validacion = $this->validar_EDIFICIO_ID();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        return $this->rellena_validation(true, '00000', 'IMP_SIM');
    }
}
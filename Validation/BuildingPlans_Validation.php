<?php

include_once 'Validator.php';

class BuildingPlans_Validation extends Validator {
    var $edificio_id;
    var $plan_id;
    var $fecha_asignacion;
    var $fecha_cumplimentacion;
    var $fecha_vencimiento;
    var $estado;
    var $nombre_edificio;
    const states = array('pendiente','cumplimentado','vencido');

    function __construct() {

    }

    function validar_atributos_search() {
        $validacion = $this->rellena_validation(true,'00000','BLD_PLAN');
        if($this->edificio_id != '') {
            $validacion = $this->validar_EDIFICIO_ID();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        if($this->fecha_asignacion != '') {
            $validacion = $this->validar_FECHA_ASIGNACION();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        if($this->fecha_cumplimentacion != '') {
            $validacion = $this->validar_FECHA_CUMPLIMENTACION();
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

        if($this->estado != '') {
            $validacion = $this->validar_ESTADO();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        if($this->nombre_edificio != '') {
            $validacion = $this->validar_NOMBRE_EDIFICIO();
        }

        return $validacion;
    }

    function validar_EDIFICIO_ID() {
        if(!$this->no_vacio($this->edificio_id)) {
            return $this->rellena_validation(false,'BLD_ID_EMPT','BLD_PLAN');
        }

        if(!$this->es_numerico($this->edificio_id)) {
            return $this->rellena_validation(false,'BLD_ID_NOT_NUMERIC','BLD_PLAN');
        }

        return $this->rellena_validation(true,'00000','BLD_PLAN');
    }

    function validar_PLAN_ID() {
        if(!$this->no_vacio($this->plan_id)) {
            return $this->rellena_validation(false, 'DFPLAN_ID_EMPT', 'BLD_PLAN');
        }

        if(!$this->es_numerico($this->plan_id)) {
            return $this->rellena_validation(false, 'DFPLAN_ID_NOT_NUMERIC', 'BLD_PLAN');
        }

        return $this->rellena_validation(true,'00000','BLD_PLAN');
    }

    function validar_FECHA_ASIGNACION() {
        if(!$this->validar_fecha($this->fecha_asignacion)) {
            return $this->rellena_validation(false,'BLDPLAN_DATEASSIGN_KO','BLD_PLAN');
        }

        return $this->rellena_validation(true,'00000','BLD_PLAN');
    }

    function validar_FECHA_CUMPLIMENTACION() {
        if(!$this->validar_fecha($this->fecha_cumplimentacion)) {
            return $this->rellena_validation(false,'BLDPLAN_DATECOMP_KO','BLD_PLAN');
        }

        return $this->rellena_validation(true,'00000','BLD_PLAN');
    }

    function validar_FECHA_VENCIMIENTO() {
        if(!$this->validar_fecha($this->fecha_vencimiento)) {
            return $this->rellena_validation(false, 'DATEEXPIRE_KO','BLD_PLAN');
        }

        return $this->rellena_validation(true, '00000', 'BLD_PLAN');
    }

    function validar_ESTADO() {
        if(!$this->en_valores($this->estado, self::states)) {
            return $this->rellena_validation(false,'BLDPLAN_STATE_KO','BLD_PLAN');
        }

        return $this->rellena_validation(true,'00000','BLD_PLAN');
    }

    function validar_NOMBRE_EDIFICIO() {
        if(!$this->longitud_minima($this->nombre_edificio,3)) {
            return $this->rellena_validation(false,'BLD_NAM_SHRT','BLD_PLAN');
        }

        if(!$this->longitud_maxima($this->nombre_edificio,60)) {
            return $this->rellena_validation(false,'BLD_NAM_LRG','BLD_PLAN');
        }

        if(!$this->solo_letras_numeros_espacios_acentos($this->nombre_edificio)) {
            return $this->rellena_validation(false,'BLD_NAM_FRMT','BLD_PLAN');
        }

        return $this->rellena_validation(true,'00000','BLD_PLAN');
    }
}
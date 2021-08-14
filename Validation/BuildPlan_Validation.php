<?php

include_once 'Validator.php';

class BuildPlan_Validation extends Validator {

    var $edificio_id;
    var $plan_id;
    var $fecha_asignacion;
    var $fecha_implementacion;
    var $estado;
    const states = array('pendiente','implementado','vencido');

    function __construct() {
    }

    function validar_atributos_add() {
        return $this->validar_EDIFICIO_ID();
    }

    function validar_atributos_edit() {
        $validacion = $this->validar_EDIFICIO_ID();
        if(!$validacion['ok']) {
            return $validacion;
        }

        return $this->validar_ESTADO();
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

        if($this->fecha_implementacion != '') {
            $validacion = $this->validar_FECHA_IMPLEMENTACION();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        if($this->estado != '') {
            $validacion = $this->validar_ESTADO();
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

    function validar_FECHA_IMPLEMENTACION() {
        if(!$this->validar_fecha($this->fecha_implementacion)) {
            return $this->rellena_validation(false,'BLDPLAN_DATEIMPL_KO','BLD_PLAN');
        }

        return $this->rellena_validation(true,'00000','BLD_PLAN');
    }

    function validar_ESTADO() {
        if(!$this->no_vacio($this->estado)) {
            return $this->rellena_validation(false,'BLDPLAN_STATE_EMPT','BLD_PLAN');
        }

        if(!$this->en_valores($this->estado, self::states)) {
            return $this->rellena_validation(false,'BLDPLAN_STATE_KO','BLD_PLAN');
        }
    }
}
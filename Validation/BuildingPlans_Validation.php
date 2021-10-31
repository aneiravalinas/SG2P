<?php

include_once 'Validator.php';

class BuildingPlans_Validation extends Validator {
    var $edificio_id;
    var $plan_id;
    var $fecha_asignacion;
    var $fecha_asignacion_inicio;
    var $fecha_asignacion_fin;
    var $fecha_cumplimentacion;
    var $fecha_cumplimentacion_inicio;
    var $fecha_cumplimentacion_fin;
    var $fecha_vencimiento;
    var $fecha_vencimiento_inicio;
    var $fecha_vencimiento_fin;
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

        if($this->estado != '') {
            $validacion = $this->validar_ESTADO();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        if($this->nombre_edificio != '') {
            $validacion = $this->validar_NOMBRE_EDIFICIO();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        if($this->fecha_asignacion_inicio != '') {
            $validacion = $this->validar_FECHA_ASIGNACION_INICIO();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        if($this->fecha_asignacion_fin != '') {
            $validacion = $this->validar_FECHA_ASIGNACION_FIN();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        if($this->fecha_cumplimentacion_inicio != '') {
            $validacion = $this->validar_FECHA_CUMPLIMENTACION_INICIO();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        if($this->fecha_cumplimentacion_fin != '') {
            $validacion = $this->validar_FECHA_CUMPLIMENTACION_FIN();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        if($this->fecha_vencimiento_inicio != '') {
            $validacion = $this->validar_FECHA_VENCIMIENTO_INICIO();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        if($this->fecha_vencimiento_fin != '') {
            $validacion = $this->validar_FECHA_VENCIMIENTO_FIN();
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

    function validar_ESTADO() {
        if(!$this->en_valores($this->estado, self::states)) {
            return $this->rellena_validation(false,'BLDPLAN_STATE_KO','BLD_PLAN');
        }

        return $this->rellena_validation(true,'00000','BLD_PLAN');
    }

    function validar_NOMBRE_EDIFICIO() {
        if(!$this->longitud_maxima($this->nombre_edificio,60)) {
            return $this->rellena_validation(false,'BLD_NAM_LRG','BLD_PLAN');
        }

        if(!$this->solo_letras_numeros_espacios_acentos($this->nombre_edificio)) {
            return $this->rellena_validation(false,'BLD_NAM_FRMT','BLD_PLAN');
        }

        return $this->rellena_validation(true,'00000','BLD_PLAN');
    }

    function validar_FECHA_CUMPLIMENTACION_INICIO() {
        if(!$this->validar_fecha($this->fecha_cumplimentacion_inicio)) {
            return $this->rellena_validation(false, 'START_DATECOMP_KO', 'BLD_PLAN');
        }

        return $this->rellena_validation(true, '00000', 'BLD_PLAN');
    }

    function validar_FECHA_CUMPLIMENTACION_FIN() {
        if(!$this->validar_fecha($this->fecha_cumplimentacion_fin)) {
            return $this->rellena_validation(false, 'END_DATECOMP_KO', 'BLD_PLAN');
        }

        return $this->rellena_validation(true, '00000', 'BLD_PLAN');
    }

    function validar_FECHA_VENCIMIENTO_INICIO() {
        if(!$this->validar_fecha($this->fecha_vencimiento_inicio)) {
            return $this->rellena_validation(false, 'START_DATEEXPIRE_KO', 'BLD_PLAN');
        }

        return $this->rellena_validation(true, '00000', 'BLD_PLAN');
    }

    function validar_FECHA_VENCIMIENTO_FIN() {
        if(!$this->validar_fecha($this->fecha_vencimiento_fin)) {
            return $this->rellena_validation(false, 'END_DATEEXPIRE_KO', 'BLD_PLAN');
        }

        return $this->rellena_validation(true, '00000', 'BLD_PLAN');
    }

    function validar_FECHA_ASIGNACION_INICIO() {
        if(!$this->validar_fecha($this->fecha_asignacion_inicio)) {
            return $this->rellena_validation(false, 'START_DATEASSIGN_KO', 'BLD_PLAN');
        }

        return $this->rellena_validation(true, '00000', 'BLD_PLAN');
    }

    function validar_FECHA_ASIGNACION_FIN() {
        if(!$this->validar_fecha($this->fecha_asignacion_fin)) {
            return $this->rellena_validation(false, 'END_DATEASSIGN_KO', 'BLD_PLAN');
        }

        return $this->rellena_validation(true, '00000', 'BLD_PLAN');
    }
}
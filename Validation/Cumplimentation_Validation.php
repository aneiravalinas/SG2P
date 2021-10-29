<?php

include_once 'Validator.php';

class Cumplimentation_Validation extends Validator {
    var $cumplimentacion_id;
    var $estado;
    var $edificio_id;
    var $nombre_edificio;
    var $fecha_cumplimentacion;
    var $fecha_cumplimentacion_inicio;
    var $fecha_cumplimentacion_fin;
    var $fecha_vencimiento;
    var $fecha_vencimiento_inicio;
    var $fecha_vencimiento_fin;
    var $buildings = array();
    const states = array('pendiente','cumplimentado','vencido');

    function __construct() {
    }


    function validar_atributos_search() {
        $validacion = $this->rellena_validation(true, '00000', 'CUMPLIMENTATION');
        if($this->cumplimentacion_id != '') {
            $validacion = $this->validar_CUMPLIMENTACION_ID();
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

    function validar_CUMPLIMENTACION_ID() {
        if(!$this->no_vacio($this->cumplimentacion_id)) {
            return $this->rellena_validation(false, 'CUMP_ID_EMPT', 'CUMPLIMENTATION');
        }

        if(!$this->es_numerico($this->cumplimentacion_id)) {
            return $this->rellena_validation(false, 'CUMP_ID_NOT_NUMERIC', 'CUMPLIMENTATION');
        }

        return $this->rellena_validation(true, '00000', 'CUMPLIMENTATION');
    }

    function validar_EDIFICIO_ID() {
        if(!$this->no_vacio($this->edificio_id)) {
            return $this->rellena_validation(false,'BLD_ID_EMPT','CUMPLIMENTATION');
        }

        if(!$this->es_numerico($this->edificio_id)) {
            return $this->rellena_validation(false,'BLD_ID_NOT_NUMERIC','CUMPLIMENTATION');
        }

        return $this->rellena_validation(true,'00000','CUMPLIMENTATION');
    }

    function validar_ESTADO() {
        if(!$this->en_valores($this->estado, self::states)) {
            return $this->rellena_validation(false,'STATE_KO','CUMPLIMENTATION');
        }

        return $this->rellena_validation(true,'00000','CUMPLIMENTATION');
    }

    function validar_NOMBRE_EDIFICIO() {
        if(!$this->longitud_minima($this->nombre_edificio,3)) {
            return $this->rellena_validation(false,'BLD_NAM_SHRT','CUMPLIMENTATION');
        }

        if(!$this->longitud_maxima($this->nombre_edificio,60)) {
            return $this->rellena_validation(false,'BLD_NAM_LRG','CUMPLIMENTATION');
        }

        if(!$this->solo_letras_numeros_espacios_acentos($this->nombre_edificio)) {
            return $this->rellena_validation(false,'BLD_NAM_FRMT','CUMPLIMENTATION');
        }

        return $this->rellena_validation(true,'00000','CUMPLIMENTATION');
    }

    function validar_FECHA_CUMPLIMENTACION_INICIO() {
        if(!$this->validar_fecha($this->fecha_cumplimentacion_inicio)) {
            return $this->rellena_validation(false, 'START_DATECOMP_KO', 'CUMPLIMENTATION');
        }

        return $this->rellena_validation(true, '00000', 'CUMPLIMENTATION');
    }

    function validar_FECHA_CUMPLIMENTACION_FIN() {
        if(!$this->validar_fecha($this->fecha_cumplimentacion_fin)) {
            return $this->rellena_validation(false, 'END_DATECOMP_KO', 'CUMPLIMENTATION');
        }

        return $this->rellena_validation(true, '00000', 'CUMPLIMENTATION');
    }

    function validar_FECHA_VENCIMIENTO_INICIO() {
        if(!$this->validar_fecha($this->fecha_vencimiento_inicio)) {
            return $this->rellena_validation(false, 'START_DATEEXPIRE_KO', 'CUMPLIMENTATION');
        }

        return $this->rellena_validation(true, '00000', 'CUMPLIMENTATION');
    }

    function validar_FECHA_VENCIMIENTO_FIN() {
        if(!$this->validar_fecha($this->fecha_vencimiento_fin)) {
            return $this->rellena_validation(false, 'END_DATEEXPIRE_KO', 'CUMPLIMENTATION');
        }

        return $this->rellena_validation(true, '00000', 'CUMPLIMENTATION');
    }

    function validar_BUILDINGS() {
        if(empty($this->buildings)) {
            return $this->rellena_validation(false, 'BLD_ID_EMPT', 'CUMPLIMENTATION');
        }

        foreach($this->buildings as $building) {
            $this->edificio_id = $building;
            $validacion = $this->validar_EDIFICIO_ID();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        return $this->rellena_validation(true, '00000', 'CUMPLIMENTATION');
    }

}
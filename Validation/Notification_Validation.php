<?php

include_once 'Validator.php';

class Notification_Validation extends Validator {
    var $id_notificacion;
    var $username;
    var $edificio_id;
    var $plan_id;
    var $leido;
    var $fecha;
    var $fecha_inicio;
    var $fecha_fin;
    var $mensaje;

    function __construct() {
    }

    function validar_atributos_search() {
        $validation = $this->rellena_validation(true, '00000', 'NOTIFICATION');
        if($this->edificio_id != '') {
            $validation = $this->validar_EDIFICIO_ID();
            if(!$validation['ok']) {
                return $validation;
            }
        }

        if($this->plan_id != '') {
            $validation = $this->validar_PLAN_ID();
            if(!$validation['ok']) {
                return $validation;
            }
        }

        if($this->leido != '') {
            $validation = $this->validar_LEIDO();
            if(!$validation['ok']) {
                return $validation;
            }
        }

        if($this->fecha_inicio != '') {
            $validation = $this->validar_FECHA_INICIO();
            if(!$validation['ok']) {
                return $validation;
            }
        }

        if($this->fecha_fin != '') {
            $validation = $this->validar_FECHA_FIN();
        }

        return $validation;
    }

    function validar_ID_NOTIFICACION() {
        if(!$this->no_vacio($this->id_notificacion)) {
            return $this->rellena_validation(false, 'NTFID_EMPT', 'NOTIFICACION');
        }

        if(!$this->es_numerico($this->id_notificacion)) {
            return $this->rellena_validation(false, 'NTFID_NOT_NUMERIC', 'NOTIFICACION');
        }

        return $this->rellena_validation(true, '00000', 'NOTIFICACION');
    }

    function validar_USERNAME() {
        if(!$this->longitud_minima($this->username,3)) {
            return $this->rellena_validation(false,'USRNM_SHRT','NOTIFICATION');
        }

        if(!$this->longitud_maxima($this->username,20)) {
            return $this->rellena_validation(false,'USRNM_LRG','NOTIFICATION');
        }

        if(!$this->es_alfanumerico($this->username)) {
            return $this->rellena_validation(false,'USRNM_ALF','NOTIFICATION');
        }

        return $this->rellena_validation(true,'00000','NOTIFICATION');
    }


    function validar_FECHA_INICIO() {
        if(!$this->validar_fecha($this->fecha_inicio)) {
            return $this->rellena_validation(false, 'START_DATE_KO','NOTIFICATION');
        }

        return $this->rellena_validation(true, '00000', 'NOTIFICATION');
    }

    function validar_FECHA_FIN() {
        if(!$this->validar_fecha($this->fecha_fin)) {
            return $this->rellena_validation(false, 'END_DATE_KO', 'NOTIFICATION');
        }

        return $this->rellena_validation(true, '00000', 'NOTIFICATION');
    }

    function validar_LEIDO() {
        if(!$this->en_valores($this->leido, array('yes', 'no'))) {
            return $this->rellena_validation(false, 'READ_KO', 'NOTIFICATION');
        }

        return $this->rellena_validation(true, '00000', 'NOTIFICATION');
    }

    function validar_EDIFICIO_ID() {
        if(!$this->no_vacio($this->edificio_id)) {
            return $this->rellena_validation(false,'BLD_ID_EMPT','NOTIFICATION');
        }

        if(!$this->es_numerico($this->edificio_id)) {
            return $this->rellena_validation(false,'BLD_ID_NOT_NUMERIC','NOTIFICATION');
        }

        return $this->rellena_validation(true,'00000','NOTIFICATION');
    }

    function validar_PLAN_ID() {
        if(!$this->no_vacio($this->plan_id)) {
            return $this->rellena_validation(false, 'DFPLAN_ID_EMPT', 'NOTIFICATION');
        }

        if(!$this->es_numerico($this->plan_id)) {
            return $this->rellena_validation(false, 'DFPLAN_ID_NOT_NUMERIC', 'NOTIFICATION');
        }

        return $this->rellena_validation(true,'00000','NOTIFICATION');
    }
}
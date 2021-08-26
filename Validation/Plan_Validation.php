<?php

include_once 'BuildingPlans_Validation.php';

class Plan_Validation extends BuildingPlans_Validation {
    var $nombre_plan;

    function __construct() {

    }

    function validar_atributos_search()
    {
        $validacion =  parent::validar_atributos_search();
        if(!$validacion['ok']) {
            return $validacion;
        }

        if($this->plan_id != '') {
            $validacion = $this->validar_PLAN_ID();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        if($this->nombre_plan != '') {
            $validacion = $this->validar_NOMBRE_PLAN();
        }

        return $validacion;
    }

    function validar_atributos_seek() {
        $validacion = $this->validar_EDIFICIO_ID();
        if(!$validacion['ok']) {
            return $validacion;
        }

        return $this->validar_PLAN_ID();
    }

    function validar_atributos_search_portal() {
        $validacion = $this->validar_EDIFICIO_ID();
        if(!$validacion['ok']) {
            return $validacion;
        }

        if($this->nombre_plan != '') {
           $validacion = $this->validar_NOMBRE_PLAN();
        }

        return $validacion;
    }

    function validar_NOMBRE_PLAN() {
        if(!$this->longitud_minima($this->nombre_plan, 5)) {
            return $this->rellena_validation(false, 'DFPLAN_NAM_SHRT', 'BLD_PLAN');
        }

        if(!$this->longitud_maxima($this->nombre_plan,60)) {
            return $this->rellena_validation(false, 'DEFPLAN_NAM_LRG', 'BLD_PLAN');
        }

        if(!$this->solo_alfanumerico_espacios_guiones($this->nombre_plan)) {
            return $this->rellena_validation(false, 'DEFPLAN_NAM_FRMT', 'BLD_PLAN');
        }

        return $this->rellena_validation(true, '00000', 'BLD_PLAN');
    }


}
<?php

include_once 'BuildingPlans_Validation.php';

class BuildPlan_Validation extends BuildingPlans_Validation {

    var $buildings = array();

    function __construct() {
    }

    function validar_BUILDINGS() {
        if(empty($this->buildings)) {
            return $this->rellena_validation(false,'BLD_ID_EMPT','BLD_PLAN');
        }

        $validacion = $this->rellena_validation(true,'00000','BLD_PLAN');
        foreach($this->buildings as $building) {
            $this->edificio_id = $building;
            $validacion = $this->validar_EDIFICIO_ID();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        return $validacion;
    }

}
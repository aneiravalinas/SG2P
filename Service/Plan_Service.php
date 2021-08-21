<?php

include_once './Validation/Plan_Validation.php';
include_once './Model/BuildPlan_Model.php';

class Plan_Service extends Plan_Validation {
    var $atributos;
    var $bldPlan_entity;

    function __construct() {
        $this->atributos = array('edificio_id','plan_id','fecha_asignacion','fecha_implementacion','estado','nombre_edificio','nombre_plan');
        $this->bldPlan_entity = new BuildPlan_Model();
        $this->fill_fields();
    }

    function fill_fields() {
        foreach($this->atributos as $atributo) {
            if(isset($_POST[$atributo])) {
                $this->$atributo = $_POST[$atributo];
            } else {
                $this->$atributo = '';
            }
        }
    }


}
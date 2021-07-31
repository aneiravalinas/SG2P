<?php

include_once './Model/Abstract_Model.php';

class Build_Plan_Model extends Abstract_Model {
    var $atributos;
    var $edificio_id;
    var $plan_id;
    var $fecha_asignacion;
    var $fecha_implementacion;
    var $estado;

    function __construct() {
        $this->atributos = array('edificio_id','plan_id','fecha_asignacion','fecha_impementacion','estado');
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

    function ADD() {
        // TODO: Implement ADD() method.
    }

    function EDIT() {
        // TODO: Implement EDIT() method.
    }

    function DELETE() {
        // TODO: Implement DELETE() method.
    }

    function SEARCH() {
        // TODO: Implement SEARCH() method.
    }

    function seek() {
        // TODO: Implement seek() method.
    }

    function searchByBuildingID() {
        $this->query = "
            SELECT * FROM EDIFICIO_PLAN
            WHERE edificio_id = '$this->edificio_id';
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }


}
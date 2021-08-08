<?php

include_once './Model/Abstract_Model.php';

class DefProc_Model extends Abstract_Model {
    var $atributos;
    var $procedimiento_id;
    var $plan_id;
    var $nombre;
    var $descripcion;

    function __construct() {
        $this->atributos = array('procedimiento_id','plan_id','nombre','descripcion');
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

    function searchByPlan() {
        $this->query = "
            SELECT * FROM PROCEDIMIENTO
            WHERE plan_id = '$this->plan_id'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

}
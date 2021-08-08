<?php

include_once './Model/Abstract_Model.php';

class DefDoc_Model extends Abstract_Model {
    var $atributos;
    var $documento_id;
    var $plan_id;
    var $nombre;
    var $descripcion;
    var $visible;

    function __construct() {
        $this->atributos = array('documento_id','plan_id','nombre','decripcion','visible');
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
            SELECT * FROM DOCUMENTO
            WHERE plan_id = '$this->plan_id'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

}
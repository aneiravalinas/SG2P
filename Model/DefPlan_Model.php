<?php

include_once './Model/Abstract_Model.php';

class DefPlan_Model extends Abstract_Model {
    var $atributos;
    var $plan_id;
    var $nombre;
    var $descripcion;

    function __construct() {
        $this->atributos = array('plan_id', 'nombre', 'descripcion');
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
        $this->query = "
            INSERT INTO PLAN (
                nombre,
                descripcion
            ) VALUES (
                '$this->nombre',
                '$this->descripcion'
            );    
        ";

        $this->execute_single_query();
        $this->plan_id = $this->id_autoincrement;
        return $this->feedback;
    }

    function EDIT() {
        // TODO: Implement EDIT() method.
    }

    function DELETE() {
        // TODO: Implement DELETE() method.
    }

    function SEARCH() {
        $this->query = "
            SELECT * 
            FROM PLAN
            WHERE
                plan_id LIKE '%" . $this->plan_id . "%' AND
                nombre LIKE '%" . $this->nombre . "%'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function seek() {
        $this->query = "
            SELECT * FROM PLAN
            WHERE plan_id = '$this->plan_id'
        ";

        $this->get_one_result_from_query();
        return $this->feedback;
    }

    function seekNamePlan() {
        $this->query = "
            SELECT * FROM PLAN
            WHERE nombre = '$this->nombre'
        ";

        $this->get_one_result_from_query();
        return $this->feedback;
    }
}
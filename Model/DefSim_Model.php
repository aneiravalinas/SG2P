<?php

include_once './Model/Abstract_Model.php';

class DefSim_Model extends Abstract_Model {
    var $atributos;
    var $simulacro_id;
    var $plan_id;
    var $nombre;
    var $descripcion;

    function __construct() {
        $this->atributos = array('simulacro_id','plan_id','nombre','descripcion');
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
            INSERT INTO SIMULACRO
                (
                 plan_id,
                 nombre,
                 descripcion
                ) VALUES (
                '$this->plan_id',
                '$this->nombre',
                '$this->descripcion'
                );
        ";

        $this->execute_single_query();
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
            SELECT * FROM SIMULACRO
            WHERE
                plan_id = '$this->plan_id' AND
                simulacro_id LIKE '%" . $this->simulacro_id . "%' AND
                nombre LIKE '%" . $this->nombre . "%'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function seek() {
        // TODO: Implement seek() method.
    }

    function searchByPlan() {
        $this->query = "
            SELECT * FROM SIMULACRO
            WHERE plan_id = '$this->plan_id'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function searchByName() {
        $this->query = "
            SELECT * FROM SIMULACRO
            WHERE
                plan_id = '$this->plan_id' AND
                nombre = '$this->nombre'
        ";

        $this->get_one_result_from_query();
        return $this->feedback;
    }

}
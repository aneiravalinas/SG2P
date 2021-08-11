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
        $this->query = "
            INSERT INTO PROCEDIMIENTO
                (nombre,
                 descripcion,
                 plan_id
                ) VALUES (
                 '$this->nombre',
                 '$this->descripcion',
                 '$this->plan_id'
            );
        ";

        $this->execute_single_query();
        $this->procedimiento_id = $this->id_autoincrement;
        return $this->feedback;
    }

    function EDIT() {
        $this->query = "UPDATE PROCEDIMIENTO SET " .
            ($this->nombre == '' ? "" : "nombre = '$this->nombre', ") .
            ($this->descripcion == '' ? "" : "descripcion = '$this->descripcion'") .
            " WHERE procedimiento_id = '$this->procedimiento_id'";

        $this->execute_single_query();
        return $this->feedback;
    }

    function DELETE() {
        $this->query = "
            DELETE FROM PROCEDIMIENTO
            WHERE procedimiento_id = '$this->procedimiento_id'
        ";

        $this->execute_single_query();
        return $this->feedback;
    }

    function SEARCH() {
        $this->query = "
            SELECT * FROM PROCEDIMIENTO
            WHERE
                plan_id = '$this->plan_id' AND
                procedimiento_id LIKE '%" . $this->procedimiento_id . "%' AND
                nombre LIKE '%" . $this->nombre . "%'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function seek() {
        $this->query = "
            SELECT * FROM PROCEDIMIENTO
            WHERE procedimiento_id = '$this->procedimiento_id'
        ";

        $this->get_one_result_from_query();
        return $this->feedback;
    }

    function seekByProcName() {
        $this->query = "
            SELECT * FROM PROCEDIMIENTO
            WHERE
                nombre = '$this->nombre' AND
                plan_id = '$this->plan_id'
        ";

        $this->get_one_result_from_query();
        return $this->feedback;
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
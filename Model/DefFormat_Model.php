<?php

include_once './Model/Abstract_Model.php';

class DefFormat_Model extends Abstract_Model {
    var $atributos;
    var $formacion_id;
    var $plan_id;
    var $nombre;
    var $descripcion;

    function __construct() {
        $this->atributos = array('formacion_id','plan_id','nombre','descripcion');
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
            INSERT INTO FORMACION
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
        $this->formacion_id = $this->id_autoincrement;
        return $this->feedback;
    }

    function EDIT() {
        $this->query = "UPDATE FORMACION SET " .
            ($this->nombre == '' ? "" : "nombre = '$this->nombre', ") .
            ($this->descripcion == '' ? "" : "descripcion = '$this->descripcion'") .
            " WHERE formacion_id = '$this->formacion_id'";

        $this->execute_single_query();
        return $this->feedback;
    }

    function DELETE() {
        $this->query = "
            DELETE FROM FORMACION
            WHERE formacion_id = '$this->formacion_id'
        ";

        $this->execute_single_query();
        return $this->feedback;
    }

    function SEARCH() {
        $this->query = "
            SELECT * FROM FORMACION
            WHERE
                plan_id = '$this->plan_id' AND 
                nombre LIKE '%" . $this->nombre . "%' AND
                formacion_id LIKE '%" . $this->formacion_id . "%'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function seek() {
        $this->query = "
            SELECT * FROM FORMACION
            WHERE formacion_id = '$this->formacion_id'
        ";

        $this->get_one_result_from_query();
        return $this->feedback;
    }

    function searchByPlan() {
        $this->query = "
            SELECT * FROM FORMACION
            WHERE plan_id = '$this->plan_id'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function searchByName() {
        $this->query = "
            SELECT * FROM FORMACION
            WHERE
                nombre = '$this->nombre' AND
                plan_id = '$this->plan_id'
        ";

        $this->get_one_result_from_query();
        return $this->feedback;
    }

}
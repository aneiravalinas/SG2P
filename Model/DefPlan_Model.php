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

    // Añade la definición de un plan.
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

    // Modifica la información de un plan por ID.
    function EDIT() {
        $this->query = "UPDATE PLAN SET " .
            ($this->nombre == '' ? "" : "nombre = '$this->nombre', ") .
            ($this->descripcion == '' ? "" : "descripcion = '$this->descripcion'") .
            " WHERE plan_id = '$this->plan_id'";

        $this->execute_single_query();
        return $this->feedback;
    }

    // Elimina la definición de un plan por ID.
    function DELETE() {
        $this->query = "
            DELETE FROM PLAN
            WHERE plan_id = '$this->plan_id'
        ";

        $this->execute_single_query();
        return $this->feedback;
    }

    // Recupera información de planes filtrando por ID de plan o por nombre.
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

    // Recupera la información de un Plan por ID.
    function seek() {
        $this->query = "
            SELECT * FROM PLAN
            WHERE plan_id = '$this->plan_id'
        ";

        $this->get_one_result_from_query();
        return $this->feedback;
    }

    // Recupera planes con un nombre en específico.
    function seekNamePlan() {
        $this->query = "
            SELECT * FROM PLAN
            WHERE nombre = '$this->nombre'
        ";

        $this->get_one_result_from_query();
        return $this->feedback;
    }
}
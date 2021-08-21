<?php

include_once './Model/Abstract_Model.php';

class BuildPlan_Model extends Abstract_Model {
    var $atributos;
    var $edificio_id;
    var $plan_id;
    var $fecha_asignacion;
    var $fecha_implementacion;
    var $estado;
    var $nombre_edificio;

    function __construct() {
        $this->atributos = array('edificio_id','plan_id','fecha_asignacion','fecha_impementacion','estado','nombre_edificio');
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
            INSERT INTO EDIFICIO_PLAN
            (
                edificio_id,
                plan_id,
                fecha_asignacion,
                fecha_implementacion,
                estado
            ) VALUES (
                '$this->edificio_id',
                '$this->plan_id',
                '$this->fecha_asignacion',
                '$this->fecha_implementacion',
                '$this->estado'
            );
        ";

        $this->execute_single_query();
        return $this->feedback;
    }

    function EDIT() {
        $this->query = "UPDATE EDIFICIO_PLAN SET " .
            ($this->fecha_implementacion == '' ? "" : "fecha_implementacion = '$this->fecha_implementacion', ") .
            ($this->estado == '' ? "" : "estado = '$this->estado'") .
            " WHERE 
                edificio_id = '$this->edificio_id' AND
                plan_id = '$this->plan_id'";

        $this->execute_single_query();
        return $this->feedback;
    }

    function DELETE() {
        $this->query = "
            DELETE FROM EDIFICIO_PLAN
            WHERE 
                  edificio_id = '$this->edificio_id' AND
                  plan_id = '$this->plan_id'
        ";

        $this->execute_single_query();
        return $this->feedback;
    }

    function SEARCH() {
        $this->query = "
            SELECT EDIFICIO_PLAN.*, EDIFICIO.nombre AS nombre_edificio
            FROM EDIFICIO_PLAN
            INNER JOIN EDIFICIO
            ON EDIFICIO_PLAN.edificio_id = EDIFICIO.edificio_id
            WHERE plan_id = '$this->plan_id' AND
                  estado LIKE '%" . $this->estado . "%' AND
                  fecha_asignacion LIKE '%" . $this->fecha_asignacion . "%' AND
                  fecha_implementacion LIKE '%" . $this->fecha_implementacion . "%' AND
                  EDIFICIO.nombre LIKE '%" . $this->nombre_edificio . "%'
            ORDER BY estado, edificio_id
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function seek() {
        $this->query = "
            SELECT * FROM EDIFICIO_PLAN
            WHERE 
                edificio_id = '$this->edificio_id' AND
                plan_id = '$this->plan_id'
        ";

        $this->get_one_result_from_query();
        return $this->feedback;
    }

    function searchByBuildingID() {
        $this->query = "
            SELECT * FROM EDIFICIO_PLAN
            WHERE edificio_id = '$this->edificio_id';
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function searchBuildingsCandidates() {
        $this->query = "
            SELECT * FROM EDIFICIO
            WHERE edificio_id NOT IN (
                SELECT edificio_id
                FROM EDIFICIO_PLAN
                WHERE plan_id = '$this->plan_id'
            )
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function searchActivesByPlanID() {
        $this->query = "
            SELECT * FROM EDIFICIO_PLAN
            WHERE 
                  plan_id = '$this->plan_id' AND
                  estado != 'vencido'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }


    function setAttributes($atributos) {
        foreach($this->atributos as $atributo) {
            if(isset($atributos[$atributo])) {
                $this->$atributo = $atributos[$atributo];
            }
        }
    }

}
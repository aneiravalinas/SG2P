<?php

include_once './Model/Abstract_Model.php';

class DefRoute_Model extends Abstract_Model {
    var $atributos;
    var $ruta_id;
    var $plan_id;
    var $nombre;
    var $descripcion;

    function __construct() {
        $this->atributos = array('ruta_id','plan_id','nombre','descripcion');
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
            INSERT INTO RUTA
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
        $this->ruta_id = $this->id_autoincrement;
        return $this->feedback;
    }

    function EDIT() {
        $this->query = "UPDATE RUTA SET " .
            ($this->nombre == '' ? "" : "nombre = '$this->nombre', ") .
            ($this->descripcion == '' ? "" : "descripcion = '$this->descripcion'") .
            " WHERE ruta_id = '$this->ruta_id'";

        $this->execute_single_query();
        return $this->feedback;
    }

    function DELETE() {
        $this->query = "
            DELETE FROM RUTA
            WHERE ruta_id = '$this->ruta_id'
        ";

        $this->execute_single_query();
        return $this->feedback;
    }

    function SEARCH() {
        $this->query = "
            SELECT * FROM RUTA
            WHERE
                plan_id = '$this->plan_id' AND
                ruta_id LIKE '%" . $this->ruta_id . "%' AND
                nombre LIKE '%" . $this->nombre . "%'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function seek() {
        $this->query = "
            SELECT * FROM RUTA
            WHERE ruta_id = '$this->ruta_id'
        ";

        $this->get_one_result_from_query();
        return $this->feedback;
    }

    function searchByPlan() {
        $this->query = "
            SELECT * FROM RUTA
            WHERE 
                  plan_id = '$this->plan_id'     
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function searchByRouteName() {
        $this->query = "
            SELECT * FROM RUTA
            WHERE 
                  plan_id = '$this->plan_id' AND 
                  nombre = '$this->nombre'
                  
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    // Recupera las definiciones de rutas de un determinado plan que tengan cumplimentaciones en alguna de las plantas del edificio que se pasa como parámetro.
    function searchBuildingPlanRoutes($edificio_id) {
        $this->query = "
            SELECT * FROM RUTA
            WHERE
                plan_id = '$this->plan_id' AND
                ruta_id IN (
                    SELECT PLANTA_RUTA.ruta_id
                    FROM PLANTA_RUTA
                    INNER JOIN PLANTA
                        ON PLANTA_RUTA.planta_id = PLANTA.planta_id
                    WHERE PLANTA.edificio_id = '$edificio_id'   
                )
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

}
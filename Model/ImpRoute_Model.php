<?php

include_once './Model/Abstract_Model.php';

class ImpRoute_Model extends Abstract_Model {

    var $atributos;
    var $planta_ruta_id;
    var $planta_id;
    var $ruta_id;
    var $estado;
    var $fecha_cumplimentacion;
    var $nombre_doc;

    function __construct() {
        $this->atributos = array('planta_ruta_id','planta_id','ruta_id','estado','fecha_cumplimentacion','nombre_doc');
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
            INSERT INTO PLANTA_RUTA 
            (
                planta_id,
                ruta_id,
                estado,
                fecha_cumplimentacion,
                nombre_doc
            ) VALUES (
                '$this->planta_id',
                '$this->ruta_id',
                '$this->estado',
                '$this->fecha_cumplimentacion',
                '$this->nombre_doc'
            );
        ";

        $this->execute_single_query();
        $this->planta_ruta_id = $this->id_autoincrement;
        return $this->feedback;
    }

    function EDIT() {
        $this->query = "UPDATE PLANTA_RUTA SET " .
            ($this->fecha_cumplimentacion == '' ? "" : "fecha_cumplimentacion = '$this->fecha_cumplimentacion', ") .
            ($this->nombre_doc == '' ? "" : "nombre_doc = '$this->nombre_doc', ") .
            ($this->estado == '' ? "" : "estado = '$this->estado'") .
            " WHERE planta_ruta_id = '$this->planta_ruta_id'";

        $this->execute_single_query();
        return $this->feedback;
    }

    function DELETE() {
        $this->query = "
            DELETE FROM PLANTA_RUTA
            WHERE
                planta_ruta_id = '$this->planta_ruta_id'
        ";

        $this->execute_single_query();
        return $this->feedback;
    }

    function SEARCH() {
        // TODO: Implement SEARCH() method.
    }

    function seek() {
        // TODO: Implement seek() method.
    }

    function searchByPlantaID() {
        $this->query = "
            SELECT * FROM PLANTA_RUTA
            WHERE planta_id = '$this->planta_id'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function searchByRouteID() {
        $this->query = "
            SELECT * FROM PLANTA_RUTA
            WHERE ruta_id = '$this->ruta_id'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function searchRoutesFloors() {
        $this->query = "
            SELECT * FROM PLANTA_RUTA
            WHERE
                planta_id = '$this->planta_id' AND
                ruta_id = '$this->ruta_id'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function searchRoutesBuildings($edificio_id) {
        $this->query = "
            SELECT PLANTA_RUTA.*
            FROM PLANTA_RUTA
            INNER JOIN PLANTA
                ON PLANTA_RUTA.planta_id = PLANTA.planta_id
            WHERE ruta_id = '$this->ruta_id' AND
                  PLANTA.edificio_id = '$edificio_id'
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
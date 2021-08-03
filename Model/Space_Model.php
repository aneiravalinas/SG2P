<?php

include_once './Model/Abstract_Model.php';

class Space_Model extends Abstract_Model {

    var $atributos;
    var $espacio_id;
    var $planta_id;
    var $nombre;
    var $descripcion;
    var $foto_espacio;

    function __construct() {
        $this->atributos = array('espacio_id','planta_id','nombre','descripcion','foto_espacio');
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
            INSERT INTO ESPACIO (
                            planta_id,
                            nombre,
                            descripcion,
                            foto_espacio
                ) VALUES (
                          '$this->planta_id',
                          '$this->nombre',
                          '$this->descripcion',
                          '$this->foto_espacio'
                );
        ";

        $this->execute_single_query();
        return $this->feedback;
    }

    function EDIT() {
        $this->query = "UPDATE ESPACIO SET " .
            ($this->nombre == '' ? "" : "nombre = '$this->nombre', ") .
            ($this->foto_espacio == '' ? "" : "foto_espacio = '$this->foto_espacio', ") .
            ($this->descripcion == '' ? "" : "descripcion = '$this->descripcion'") .
            " WHERE espacio_id = '$this->espacio_id'";

        $this->execute_single_query();
        return $this->feedback;
    }

    function DELETE() {
        $this->query = "
            DELETE FROM ESPACIO
            WHERE espacio_id = '$this->espacio_id'
        ";

        $this->execute_single_query();
        return $this->feedback;
    }

    function SEARCH() {
        $this->query = "
            SELECT * FROM ESPACIO
            WHERE
                espacio_id LIKE '%" . $this->espacio_id . "%' AND
                nombre LIKE '%" . $this->nombre . "%' AND
                planta_id = '$this->planta_id'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function seek() {
        $this->query = "
            SELECT * FROM ESPACIO
            WHERE espacio_id = '$this->espacio_id'
        ";

        $this->get_one_result_from_query();
        return $this->feedback;
    }

    function searchByPlantaID() {
        $this->query = "
            SELECT * FROM ESPACIO
            WHERE planta_id = '$this->planta_id'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function seekNameSpace() {
        $this->query = "
            SELECT * FROM ESPACIO
            WHERE
                nombre = '$this->nombre' AND
                planta_id = '$this->planta_id'
        ";

        $this->get_one_result_from_query();
        return $this->feedback;
    }
}
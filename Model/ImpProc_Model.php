<?php

include_once 'Abstract_Model.php';

class ImpProc_Model extends Abstract_Model {
    var $atributos;
    var $edificio_procedimiento_id;
    var $edificio_id;
    var $procedimiento_id;
    var $estado;
    var $fecha_cumplimentacion;
    var $nombre_doc;

    function __construct() {
        $this->atributos = array('edificio_procedimiento_id','edificio_id','procedimiento_id','estado','fecha_cumplimentacion','nombre_doc');
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
            INSERT INTO EDIFICIO_PROCEDIMIENTO 
            (
                edificio_id,
                procedimiento_id,
                estado,
                fecha_cumplimentacion,
                nombre_doc
            ) VALUES (
                '$this->edificio_id',
                '$this->procedimiento_id',
                '$this->estado',
                '$this->fecha_cumplimentacion',
                '$this->nombre_doc'
            );
        ";

        $this->execute_single_query();
        $this->edificio_procedimiento_id = $this->id_autoincrement;
        return $this->feedback;
    }

    function EDIT() {
        $this->query = "UPDATE EDIFICIO_PROCEDIMIENTO SET " .
            ($this->fecha_cumplimentacion == '' ? "" : "fecha_cumplimentacion = '$this->fecha_cumplimentacion', ") .
            ($this->nombre_doc == '' ? "" : "nombre_doc = '$this->nombre_doc', ") .
            ($this->estado == '' ? "" : "estado = '$this->estado'") .
            " WHERE edificio_procedimiento_id = '$this->edificio_procedimiento_id'";

        $this->execute_single_query();
        return $this->feedback;
    }

    function DELETE() {
        $this->query = "
            DELETE FROM EDIFICIO_PROCEDIMIENTO
            WHERE
                edificio_procedimiento_id = '$this->edificio_procedimiento_id'
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

    function searchByProcID() {
        $this->query = "
            SELECT * FROM EDIFICIO_PROCEDIMIENTO
            WHERE procedimiento_id = '$this->procedimiento_id'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function searchProcsBuildings() {
        $this->query = "
            SELECT * FROM EDIFICIO_PROCEDIMIENTO
            WHERE 
                edificio_id = '$this->edificio_id' AND
                procedimiento_id = '$this->procedimiento_id'
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
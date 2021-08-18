<?php

include_once './Model/Abstract_Model.php';

class ImpRoute_Model extends Abstract_Model {

    var $atributos;
    var $planta_ruta_id;
    var $planta_id;
    var $ruta_id;
    var $estado;
    var $fecha_implementacion;
    var $nombre_doc;

    function __construct() {
        $this->atributos = array('planta_ruta_id','planta_id','ruta_id','estado','fecha_implementacion','nombre_doc');
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
                fecha_implementacion,
                nombre_doc
            ) VALUES (
                '$this->planta_id',
                '$this->ruta_id',
                '$this->estado',
                '$this->fecha_implementacion',
                '$this->nombre_doc'
            );
        ";

        $this->execute_single_query();
        $this->planta_ruta_id = $this->id_autoincrement;
        return $this->feedback;
    }

    function EDIT() {
        // TODO: Implement EDIT() method.
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

    function setAttributes($atributos) {
        foreach($this->atributos as $atributo) {
            if(isset($atributos[$atributo])) {
                $this->$atributo = $atributos[$atributo];
            }
        }
    }

}
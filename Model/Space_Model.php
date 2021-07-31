<?php

include_once './Model/Abstract_Model.php';

class Space_Model extends Abstract_Model {

    var $atributos;
    var $espacio_id;
    var $planta_id;
    var $nombre;
    var $dimensiones;
    var $descripcion;
    var $foto_espacio;

    function __construct() {
        $this->atributos = array('espacio_id','planta_id','nombre','dimensiones','descripcion','foto_espacio');
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
        // TODO: Implement ADD() method.
    }

    function EDIT() {
        // TODO: Implement EDIT() method.
    }

    function DELETE() {
        // TODO: Implement DELETE() method.
    }

    function SEARCH() {
        // TODO: Implement SEARCH() method.
    }

    function seek() {
        // TODO: Implement seek() method.
    }

    function searchByPlantaID() {
        $this->query = "
            SELECT * FROM ESPACIO
            WHERE 'planta_id' = '$this->planta_id';
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }


}
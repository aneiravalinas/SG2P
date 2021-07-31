<?php

include_once './Model/Abstract_Model.php';

class Impl_Route_Model extends Abstract_Model {

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
            SELECT * FROM PLANTA_RUTA
            WHERE planta_id = '$this->planta_id';
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

}
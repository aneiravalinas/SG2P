<?php

include_once 'Abstract_Model.php';

class ImpSim_Model extends Abstract_Model {
    var $atributos;
    var $edificio_simulacro_id;
    var $edificio_id;
    var $simulacro_id;
    var $estado;
    var $fecha_planificacion;
    var $url_recurso;
    var $destinatarios;
    var $resultado;

    function __construct() {
        $this->atributos = array('edificio_simulacro_id','simulacro_id','edificio_id','estado','fecha_planificacion','url_recurso','destinatarios','resultado');
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

    function searchBySimID() {
        $this->query = "
            SELECT * FROM EDIFICIO_SIMULACRO
            WHERE simulacro_id = '$this->simulacro_id'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }


}
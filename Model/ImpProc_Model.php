<?php

include_once 'Abstract_Model.php';

class ImpProc_Model extends Abstract_Model {
    var $atributos;
    var $edificio_procedimiento_id;
    var $edificio_id;
    var $procedimiento_id;
    var $estado;
    var $fecha_implementacion;
    var $nombre_doc;

    function __construct() {
        $this->atributos = array('edificio_procedimiento_id','edificio_id','procedimiento_id','etado','fecha_implementacion','nombre_doc');
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

    function searchByProcID() {
        $this->query = "
            SELECT * FROM EDIFICIO_PROCEDIMIENTO
            WHERE procedimiento_id = '$this->procedimiento_id'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

}
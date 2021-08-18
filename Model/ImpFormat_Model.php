<?php

include_once 'Abstract_Model.php';

class ImpFormat_Model extends Abstract_Model {
    var $atributos;
    var $edificio_formacion_id;
    var $edificio_id;
    var $formacion_id;
    var $estado;
    var $fecha_planificacion;
    var $url_recurso;
    var $destinatarios;

    function __construct() {
        $this->atributos = array('edificio_formacion_id','edificio_id','formacion_id','estado','fecha_planificacion','url_recurso','destinatarios');
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
            INSERT INTO EDIFICIO_FORMACION
            (
             edificio_id,
             formacion_id,
             estado,
             fecha_planificacion,
             url_recurso,
             destinatarios
            ) VALUES (
             '$this->edificio_id',
             '$this->formacion_id',
             '$this->estado',
             '$this->fecha_planificacion',
             '$this->url_recurso',
             '$this->destinatarios'
            );
        ";

        $this->execute_single_query();
        $this->edificio_formacion_id = $this->id_autoincrement;
        return $this->feedback;
    }

    function EDIT() {
        // TODO: Implement EDIT() method.
    }

    function DELETE() {
        $this->query = "
            DELETE FROM EDIFICIO_FORMACION
            WHERE
                edificio_formacion_id = '$this->edificio_formacion_id'
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

    function searchByFormatID() {
        $this->query = "
            SELECT * FROM EDIFICIO_FORMACION
            WHERE formacion_id = '$this->formacion_id'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function searchFormatsBuildings() {
        $this->query = "
            SELECT * FROM EDIFICIO_FORMACION
            WHERE
                edificio_id = '$this->edificio_id' AND
                formacion_id = '$this->formacion_id'
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
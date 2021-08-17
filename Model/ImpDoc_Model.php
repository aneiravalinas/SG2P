<?php

include_once './Model/Abstract_Model.php';

class ImpDoc_Model extends Abstract_Model {
    var $atributos;
    var $edificio_documento_id;
    var $edificio_id;
    var $documento_id;
    var $estado;
    var $fecha_implementacion;
    var $nombre_doc;

    function __construct() {
        $this->atributos = array('edificio_documento_id','edificio_id','documento_id','estado','fecha_implementacion','nombre_doc');
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
            INSERT INTO EDIFICIO_DOCUMENTO
            (
             edificio_id,
             documento_id,
             estado,
             fecha_implementacion,
             nombre_doc
            ) VALUES (
            '$this->edificio_id',
            '$this->documento_id',
            '$this->estado',
            '$this->fecha_implementacion',
            '$this->nombre_doc'
            );
        ";

        $this->execute_single_query();
        $this->edificio_documento_id = $this->id_autoincrement;
        return $this->feedback;
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

    function searchByDocID() {
        $this->query = "
            SELECT * FROM EDIFICIO_DOCUMENTO
            WHERE documento_id = '$this->documento_id'
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
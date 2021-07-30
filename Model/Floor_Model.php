<?php

include_once './Model/Abstract_Model.php';

class Floor_Model extends Abstract_Model {

    var $atributos;
    var $planta_id;
    var $edificio_id;
    var $nombre;
    var $num_planta;
    var $descripcion;
    var $foto_planta;

    function __construct() {
        $this->atributos = array('planta_id','edificio_id','nombre','num_planta','descripcion','foto_planta');
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
            INSERT INTO PLANTA (
                            edificio_id,
                            nombre,
                            num_planta,
                            descripcion,
                            foto_planta
                ) VALUES (
                          '$this->edificio_id',
                          '$this->nombre',
                          '$this->num_planta',
                          '$this->descripcion',
                          '$this->foto_planta'
                );
        ";

        $this->execute_single_query();
        return $this->feedback;
    }

    function EDIT() {
        // TODO: Implement EDIT() method.
    }

    function DELETE() {
        // TODO: Implement DELETE() method.
    }

    function SEARCH() {
        $this->query = "
            SELECT *
            FROM PLANTA
            WHERE
                planta_id LIKE '%" . $this->planta_id . "%' AND
                edificio_id = '$this->edificio_id' AND
                num_planta LIKE '%" . $this->num_planta . "%' AND
                nombre LIKE '%" . $this->nombre . "%'";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function seek() {
        // TODO: Implement seek() method.
    }

    function seekNumPlanta() {
        $this->query = "
            SELECT *
            FROM PLANTA
            WHERE
                num_planta = '$this->num_planta' AND
                edificio_id = '$this->edificio_id'
        ";

        $this->get_one_result_from_query();
        return $this->feedback;
    }


}